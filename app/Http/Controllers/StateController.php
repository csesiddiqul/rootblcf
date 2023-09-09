<?php

namespace App\Http\Controllers;

use App\State;
use App\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['state'] = State::with('country')->get();
        return view('state.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['country'] = Country::pluck('name', 'id');
        return view('state.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'country_id' => 'required|integer',
            'name' => 'required|string',
            'status' => 'required|integer'
        ]);
        State::create($request->all());
        toast(transMsg('State created successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.state.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        $data['country'] = Country::pluck('name', 'id');
        $data['state'] = $state;
        return view('state.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        request()->validate([
            'country_id' => 'required|integer',
            'name' => 'required|string',
            'status' => 'required|integer'
        ]);
        $state->update($request->all());
        toast(transMsg('State updated successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.state.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        $state->delete();
        toast(transMsg('State Delete successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.state.index');
    }
}
