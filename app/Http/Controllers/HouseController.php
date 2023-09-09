<?php

namespace App\Http\Controllers;

use App\House;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['houses'] = House::bySchool(Auth::user()->school->id)->get();
        return view('house.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('house.create');
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
            'name' => 'required|string',
            'status' => 'required|numeric',
        ]);
        $house = new House();
        $house->school_id = auth()->user()->school_id;
        $house->name = $request['name'];
        $house->description = $request['description'];
        $house->status = $request['status'];
        $house->save();
        toast(transMsg('Created successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.house.index');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\House $house
     * @return \Illuminate\Http\Response
     */
    public function show(House $house)
    {
        $data['house'] = $house;
        return view('house.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\House $house
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $house = House::bySchool(auth()->user()->school_id)->find($id);
        if (empty($house)) {
            return abort('404');
        }
        $data['house'] = $house;
        return view('house.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\House $house
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required|string',
            'status' => 'required|numeric',
        ]);
        $house = House::bySchool(auth()->user()->school_id)->find($id);
        if (empty($house)) {
            return abort('404');
        }
        $data = request()->except(['_token', '_method']);
        $house->update($data);
        toast(transMsg('Update successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.house.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\House $house
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $house = House::bySchool(auth()->user()->school_id)->find($id);
        if (empty($house)) {
            return abort('404');
        }
        $house->delete();
        toast(transMsg('Delete successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.house.index');
    }
}
