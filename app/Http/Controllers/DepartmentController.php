<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource. designation
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['departments'] = $this->department->bySchool(auth()->user()->school_id)->get();
        return view('department.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('department.create');
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
            'department_name' => 'required|string|unique:departments,department_name,null,id,school_id,' . auth()->user()->school_id,
            'status' => 'required|numeric'
        ]);
        $data = request()->except(['_token', '_method']);
        $data['status'] = $request->status == 1 ? 1 : 2;
        $data['school_id'] = Auth::user()->school_id;
        $this->department->create($data);
        toast(transMsg('Created successfully.'), 'success')->timerProgressBar();
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
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['department'] = $department = $this->department->bySchool(auth()->user()->school_id)->find($id);
        if (empty($department)) {
            toast(transMsg('Department not found'), 'info')->timerProgressBar();
            return redirect()->back();
        }
        return view('department.edit', $data);
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
        $this->validate($request, [
            'department_name' => 'required|string|unique:departments,department_name,' . $id . ',id,school_id,' . auth()->user()->school_id,
            'status' => 'required|numeric'
        ]);

        $department = $this->department->bySchool(auth()->user()->school_id)->find($id);
        if (empty($department)) {
            toast(transMsg('Department not found'), 'info')->timerProgressBar();
            return redirect()->back();
        }
        $data = request()->except(['_token', '_method']);
        $data['status'] = $request->status == 1 ? 1 : 2;
        $department->fill($data)->save();
        toast(transMsg('Updated successfully.'), 'success')->timerProgressBar();
        return redirect()->route('academic.department.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = $this->department->bySchool(auth()->user()->school_id)->find($id);
        if (empty($department)) {
            toast(transMsg('Department not found'), 'info')->timerProgressBar();
            return redirect()->back();
        }
        $department->delete();
        toast(transMsg('Delete successfully.'), 'success')->timerProgressBar();
        return redirect()->route('academic.department.index');
    }
}
