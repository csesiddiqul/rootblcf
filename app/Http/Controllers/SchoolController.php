<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Country;
use App\Menu;
use App\Reseller;
use App\Setting;
use App\SmsHistory;
use App\User;
use App\School;
use App\Myclass;
use App\Section;
use App\Department;
use App\Subscription;
use Illuminate\Http\Request;
use App\Http\Requests\SchoolRequest;
use Illuminate\Support\Facades\Auth;
use Rogierw\RwAcme\Api;
use Rogierw\RwAcme\Endpoints\DomainValidation;
use Rogierw\RwAcme\Exceptions\DomainValidationException;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['schools'] = School::orderBy('created_at', 'desc')->get();
        $data['country'] = Country::orderBy('name')->pluck('name', 'id');
        return view('schools.index', $data);
    }

    public function subscription()
    {
        if (auth()->user()->subscription) {
            $data['subscriptions'] = Subscription::where('user_id', auth()->user()->id)->orderBy('rangeTo', 'desc')->get();
            return view('schools.subscription', $data);
        } else {
            return redirect('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SchoolRequest $request)
    {
        $school = School::create([
            'name' => $request->name,
            'short_name' => getShortName($request->name),
            'country_id' => $request->country_id,
            'established' => $request->established,
            'about' => $request->about ?? 'about',
            'medium' => $request->medium,
            'code' => generateSchoolCode(),
            'theme' => academy_theme()
        ]);
        Setting::createNew($school->id);
        (new Menu())->insertMenusFirst($school->id);
        toast(transMsg('Created successfully.'), 'success')->timerProgressBar();
        return redirect()->route('schools.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($school_code)
    {
        $admins = User::whereCode($school_code)->where('role', 'admin')->get();
        if (Auth::user()->role == 'admin') {
            return view('school.admin_index', compact('admins'));
        }
        return view('school.admin-list', compact('admins'));
    }

    public function edit(School $school)
    {
        $data['school'] = $school;
        $data['country'] = Country::orderBy('name')->pluck('name', 'id');
        $data['agents'] = User::selectRaw('student_code, CONCAT(name, "-", student_code) as name')->bySchool(auth()->user()->school_id)->where('active', '1')->role('agent')->orderBy('name', 'asc')->pluck('name', 'student_code');
        $data['reseller'] = Reseller::pluck('name', 'id');
        return view('schools.edit', $data);
    }

    public function update(Request $request, School $school)
    {
        if ($request->sms_count = 1) {
            $data['school_id'] = $school->id;
            $data['sms_count'] = $school->sms_count;
            $data['reset_date'] = $data['created_at'] = $data['updated_at'] = now();
            SmsHistory::insert($data);
        }
        $school->name = $request->name;
        $school->about = $request->about;
        $school->perStudent = $request->perStudent;
        $school->country_id = $request->country_id;
        $school->agentcode = $request->agentcode;
        $school->status = $request->status;
        $school->reseller_id = $request->reseller_id;
        $school->branch_per = $request->branch_per;
        $school->sms_count = ($request->sms_count == 1 ? 0 : $school->sms_count);
        $school->expense_edit = ($request->expense_edit == 1 ? 1 : 0);
        $school->save();
        $minutes = 60;// 24 hours = 1440 minutes
        \Cache::remember('school_change_master_' . $school->id, $minutes, function () {
            return true;
        });
        toast(transMsg('Updated successfully.'), 'success')->timerProgressBar();
        return redirect()->route('schools.index');
    }

    public function addDepartment(Request $request)
    {
        $request->validate([
            'department_name' => 'required|string|max:50',
        ]);
        $s = new Department;
        $s->school_id = Auth::user()->school_id;
        $s->department_name = $request->department_name;
        $s->save();
        toast(transMsg('Created successfully.'), 'success')->timerProgressBar();
        return back();
    }

    public function changeTheme(Request $request)
    {
        $tb = School::find($request->s);
        $tb->theme = $request->school_theme;
        $tb->save();
        return back();
    }

    public function setIgnoreSessions(Request $request)
    {
        $request->session()->put('ignoreSessions', $request->ignoreSessions);
        return response()->json([
            'data' => [
                'success' => "Setting saved"
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return back();
        // return (School::destroy($id))?response()->json([
        //   'status' => 'success'
        // ]):response()->json([
        //   'status' => 'error'
        // ]);
    }

    public function letsEncrypt()
    {
        $client = new Api('foqasgroup@gmail.com', __DIR__ . '/../../../public/__account/' . \school('code'));

        //Creating an account
        if (!$client->account()->exists()) {
            $account = $client->account()->create();
        }
        // Or get an existing account.
        $account = $client->account()->get();

        //Creating an order
        $order = $client->order()->new($account, [$_SERVER['HTTP_HOST']]);

        //Getting an order
        $order = $client->order()->get($order->id);

        //Getting the DCV status Domain validation
        $validationStatus = $client->domainValidation()->status($order);

        //Get the name and content for the validation file
        $validationData = $client->domainValidation()->getFileValidationData($validationStatus);

        //Start domain validation dns-01
        try {
            $client->domainValidation()->start($account, $validationStatus[0]);
        } catch (DomainValidationException $exception) {
            // The local HTTP challenge test has been failed...
        }

        //Generating a CSR
        $privateKey = \Rogierw\RwAcme\Support\OpenSsl::generatePrivateKey();
        $csr = \Rogierw\RwAcme\Support\OpenSsl::generateCsr(['example.com'], $privateKey);

        //Finalizing order
        if ($order->isReady() && $client->domainValidation()->challengeSucceeded($order, DomainValidation::TYPE_HTTP)) {
            $client->order()->finalize($order, $csr);
        }
        //Getting the actual certificate
        if ($order->isFinalized()) {
            $certificateBundle = $client->certificate()->getBundle($order);
        }
        //Revoke a certificate
        if ($order->isValid()) {
            $client->certificate()->revoke($certificateBundle->fullchain);
        }
        return dd($account);
        //https://acme-v02.api.letsencrypt.org/acme/acct/account_id
        //https://acme-v02.api.letsencrypt.org/acme/order/account_id/order_id
        //https://acme-v02.api.letsencrypt.org/acme/finalize/account_id/order_id
        //http://domain_name/.well-known/acme-challenge/filename
    }
}
