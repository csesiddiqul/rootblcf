<?php

namespace App\Http\Controllers;

use App\District;
use App\Division;
use App\Thana;
use Illuminate\Http\Request;

class ThanaController extends Controller
{
    public function index()
    {
        $data['thana'] = Thana::with('division')->with('district')->get();
        $data['pageTitle'] = 'Thana';
        return view('thana.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['division'] = Division::pluck('name', 'id');
        $data['district'] = District::pluck('name', 'id');
        $data['pageTitle'] = 'Thana Create';
        return view('thana.create', $data);
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
            'district_id' => 'required|integer',
            'name' => 'required|string',
            'status' => 'required|integer'
        ]);
        Thana::create($request->all());
        toast(transMsg('Thana created successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.thana.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Thana $thana
     * @return \Illuminate\Http\Response
     */
    public function show(Thana $thana)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Thana $thana
     * @return \Illuminate\Http\Response
     */
    public function edit(Thana $thana)
    {
        $data['division'] = Division::pluck('name', 'id');
        $data['district'] = District::pluck('name', 'id');
        $data['pageTitle'] = $thana->name;
        $data['thana'] = $thana;
        return view('thana.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Thana $thana
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thana $thana)
    {
        request()->validate([
            'division_id' => 'required|integer',
            'district_id' => 'required|integer',
            'name' => 'required|string',
            'status' => 'required|integer'
        ]);
        $thana->update($request->all());
        toast(transMsg('Thana updated successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.thana.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Thana $thana
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thana $thana)
    {
        $thana->delete();
        toast(transMsg('Thana Delete successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.thana.index');
    }
}
