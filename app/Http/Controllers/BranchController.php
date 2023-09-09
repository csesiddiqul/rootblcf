<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests\SchoolRequest;
use App\Menu;
use App\School;
use App\Setting;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Statement;

class BranchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        if (branch_permission()) {
            $data['branchs'] = $this->school->whereParent_id(auth()->user()->school_id)->whereIn('status', [1, 2])->get();
            view()->share($data);
            return view('branch.index');
        }
        toast(transMsg('You do not have permission to access'), 'error')->timerProgressBar();
        return back();
    }

    public function create()
    {
        if (branch_permission()) {
            $data['country'] = Country::orderBy('name')->pluck('name', 'id');
            return view('branch.create', $data);
        }
        toast(transMsg('You do not have permission to access'), 'error')->timerProgressBar();
        return back();
    }

    public function store(SchoolRequest $request)
    {
        if (branch_permission()) {
            $school = (new School())->createNew($request->all());
            Setting::createNew($school->id);
            (new Menu())->insertMenusFirst($school->id);
            toast(transMsg('Branch created successfully.'), 'success')->timerProgressBar();
            return redirect()->back();
        }
        toast(transMsg('You do not have permission to access'), 'error')->timerProgressBar();
        return back();
    }

    public function edit($code)
    {
        $school = $this->school->whereCode($code)->first();
        if (empty($school))
            goto statement_break;
        $auth_user = auth()->user();
        if ($code == $auth_user->school->code && $auth_user->school->branch_per == 1 || $school->parent_id == $auth_user->school_id && $school->parent->branch_per == 1) {
            $data['country'] = Country::orderBy('name')->pluck('name', 'id');
            $data['school'] = $school;
            return view('branch.edit', $data);
        }
        statement_break:
        toast(transMsg('Branch not found.'), 'error')->timerProgressBar();
        return redirect()->back();
    }

    public function update(SchoolRequest $request, $id)
    {
        $school = $this->school->whereCode($id)->first();
        if (empty($school)) {
            toast(transMsg('Branch not found.'), 'error')->timerProgressBar();
            return redirect()->back();
        }
        $headID = auth()->user()->school_id;
        if ($school->parent_id != $headID || $school->id == $headID) {
            toast(transMsg('Branch not found.'), 'error')->timerProgressBar();
            return back();
        }
        $school->name = filter_var($request->name, FILTER_SANITIZE_STRING);
        $school->short_name = $request->short_name ?? getShortName($request->name);
        $school->established = filter_var($request->established, FILTER_SANITIZE_STRING);
        $school->about = filter_var($request->about, FILTER_SANITIZE_STRING);
        $school->medium = filter_var($request->medium, FILTER_SANITIZE_STRING);
        $school->address = filter_var($request->address, FILTER_SANITIZE_STRING);
        $school->branch_code = filter_var($request->branch_code, FILTER_SANITIZE_STRING);
        $school->country_id = $request->country_id;
        $school->state_id = $request->state_id;
        $school->status = $request->status == 1 ? 1 : 2;
        $school->save();
        toast(transMsg('Branch updated successfully.'), 'success')->timerProgressBar();
        return redirect()->route('academic.branch.index');
    }

    public function destroy($id)
    {
        if (branch_permission()) {
            $school = $this->school->whereCode($id)->first();
            if (empty($school)) {
                toast(transMsg('Branch not found.'), 'error')->timerProgressBar();
                return redirect()->back();
            }
            $school->status = 0;
            $school->save();
            toast(transMsg('Branch deleted successfully.'), 'success')->timerProgressBar();
            return redirect()->route('academic.branch.index');
        }
        toast(transMsg('You do not have permission to access.'), 'error')->timerProgressBar();
        return back();
    }

}
