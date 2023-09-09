<?php

namespace App\Http\Controllers;

use App\PreAdmission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreAdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['preadmissions'] = PreAdmission::bySchool(Auth::user()->school->id)->get();
        $data['postUrl'] = route('academic.preadmission.store');
        return view('preadmission.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('academic.preadmission.index');
        //  return view('preadmission.create')->with('pageTitle', 'PreAdmission Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'year' => 'required|digits:4|integer|min:1900'
        ]);
        $school_id = auth()->user()->school_id ?? school('id');
        $tb = new PreAdmission();
        $tb->school_id = $school_id;
        $tb->year = $request->year;
        $tb->shift = $request->shift;
        $tb->status = ($request->status == 1) ? 1 : 2;
        $tb->save();
        if ($request->status == 1) {
            PreAdmission::where('id', '!=', $tb->id)->where('school_id', $school_id)->update(array('status' => 2));
        }
        toast(transMsg('Admission year Created successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.preadmission.index');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\PreAdmission $preAdmission
     * @return \Illuminate\Http\Response
     */
    public function show(PreAdmission $preAdmission)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\PreAdmission $preAdmission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $preAdmission = PreAdmission::find($id);
        $data['pageTitle'] = $preAdmission->name;
        $data['preAdmission'] = $preAdmission;
        $data['postUrl'] = route('academic.preadmission.update', $preAdmission->id);
        $data['preadmissions'] = PreAdmission::bySchool(Auth::user()->school->id)->paginate(25);
        return view('preadmission.index', $data);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\PreAdmission $preAdmission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'year' => 'required|digits:4|integer|min:1900'
        ]);
        $school_id = auth()->user()->school_id ?? school('id');
        $preAdmission = PreAdmission::find($id);
        $preAdmission->school_id = $school_id;
        $preAdmission->year = $request->year;
        $preAdmission->shift = $request->shift;
        $preAdmission->status = ($request->status == 1) ? 1 : 2;
        $preAdmission->save();
        if ($request->status == 1) {
            PreAdmission::where('id', '!=', $id)->where('school_id', $school_id)->update(array('status' => 2));
        }
        toast(transMsg('Admission year updated successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.preadmission.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\PreAdmission $preAdmission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $preAdmission = PreAdmission::find($id);
        $preAdmission->delete();
        toast(transMsg('Admission year Delete successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.preadmission.index');
    }
}
