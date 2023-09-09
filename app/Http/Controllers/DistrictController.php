<?php

namespace App\Http\Controllers;

use App\District;
use App\Division;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $data['district'] = District::with('division')->get();
        $data['pageTitle'] = 'District';
        return view('district.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['division'] = Division::pluck('name', 'id');
        $data['pageTitle'] = 'District Create';
        return view('district.create', $data);
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
            'division_id' => 'required|integer',
            'name' => 'required|string',
            'status' => 'required|integer'
        ]);
        District::create($request->all());
        toast(transMsg('District created successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.district.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\District $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
       return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\District $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        $data['division'] = Division::pluck('name', 'id');
        $data['pageTitle'] = $district->name;
        $data['district'] = $district;
        return view('district.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\District $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        request()->validate([
            'division_id' => 'required|integer',
            'name' => 'required|string',
            'status' => 'required|integer'
        ]);
        $district->update($request->all());
        toast(transMsg('District updated successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.district.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\District $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        $district->delete();
        toast(transMsg('District Delete successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.district.index');
    }
}
