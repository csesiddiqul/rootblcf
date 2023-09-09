<?php

namespace App\Http\Controllers;

use App\Complain;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ComplainController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('admin')->except('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['complains'] = Complain::bySchool(Auth::user()->school->id)->get();
        return view('complain.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->back();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'contactnumber' => 'nullable|string',
            'description' => 'required|string|max:2000'
        ]);
        $name = $request->get('name');
        $email = $request->get('email');
        $contactnumber = $request->get('contactnumber');
        $description = $request->get('description');
        $complain = new Complain();
        $complain->school_id = school('id');
        $complain->name = filter_var($name, FILTER_SANITIZE_STRING);
        $complain->email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $complain->contactnumber = filter_var($contactnumber, FILTER_SANITIZE_STRING);
        $complain->description = filter_var($description, FILTER_SANITIZE_STRING);
        $complain->ip_address = $request->getClientIp();
        $complain->save();
        Mail::send('email.complain', ['complain' => $complain], function ($m) use ($complain) {
            if (school('id') == 14) {
                $email = ['mgsabur@gmail.com', 'milia_sabed@hotmail.com'];
            } else {
                $email = foqas_setting('email');
            }
            $subject = 'A Feedback has been received Time: ' . date('h:i a',strtotime($complain->created_at)). ' Date: '. date('d M, Y',strtotime($complain->created_at));
            $m->from(config('mail.from.address'), \school('name'));
            $m->to($email)->subject($subject);
          /*  $bccEmails = ['md@ipsitasoft.com'];
            $m->bcc($bccEmails)->subject($subject);*/
        });
        toast("Your message has been received, We'll get back to you shortly", 'success')->timerProgressBar();
        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $complain = Complain::find($id);
        if ($complain->school_id != Auth::user()->school_id) {
            return redirect()->back();
        }
        $data['complain'] = $complain;
        return view('complain.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $complain = Complain::find($id);
        if ($complain->school_id != Auth::user()->school_id) {
            return redirect()->back();
        }
        $data['complain'] = $complain;
        return view('complain.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $complain = Complain::find($id);
        if ($complain->school_id != Auth::user()->school_id) {
            return redirect()->back();
        }
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'contactnumber' => 'nullable|string',
            'description' => 'required|string|max:2000'
        ]);
        $complain->remark = filter_var($request->remark, FILTER_SANITIZE_STRING);
        $complain->save();
        toast('Complain Update successfully', 'success')->timerProgressBar();
        return redirect()->route('academic.complain.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $complain = Complain::find($id);
        if ($complain->school_id == Auth::user()->school_id) {
            $complain->delete();
        }
        toast('Complain Delete successfully', 'success')->timerProgressBar();
        return redirect()->route('academic.complain.index');
    }


}
