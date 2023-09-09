<?php

namespace App\Http\Controllers;

use App\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['designations'] = $this->designation->bySchool(auth()->user()->school_id)->get();
        return view('designation.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('designation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $school_id = auth()->user()->school_id;
        $this->validate($request, [
            'name' => 'required|string|unique:designations,name,null,id,school_id,' . $school_id,
            'status' => 'required|numeric'
        ]);
        $data = request()->except(['_token', '_method']);
        $data['status'] = ($request->status == 1 ? 1 : 2);
        $data['school_id'] = $school_id;
        $this->designation->create($data);
        toast(transMsg('Created successfully.'), 'success')->timerProgressBar();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Designation $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Designation $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        return view('designation.edit', compact('designation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Designation $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {
        $school_id = auth()->user()->school_id;
        $this->validate($request, [
            'name' => 'required|string|unique:designations,name,' . $designation->id . ',id,school_id,' . $school_id,
            'status' => 'required|numeric'
        ]);
        $data = request()->except(['_token', '_method']);
        $data['status'] = ($request->status == 1 ? 1 : 2);
        $designation->fill($data)->save();
        toast(transMsg('Updated successfully.'), 'success')->timerProgressBar();
        return redirect()->route('academic.designation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Designation $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        $designation->delete();
        toast(transMsg('Delete successfully.'), 'success')->timerProgressBar();
        return redirect()->route('academic.designation.index');
    }
}
