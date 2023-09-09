<?php

namespace App\Http\Controllers;

use App\Set_notes;
use Illuminate\Http\Request;

class SetNotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 0;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $allnot = New Set_notes();
        $allnot->auditor1st =$request->audi_1;
        $allnot->auditor2st =$request->audi_2;
        $allnot->notes =$request->notes;
        $allnot->auditors_report =$request->auditorsr_report;

        $allnot->save();
        return back();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Set_notes  $set_notes
     * @return \Illuminate\Http\Response
     */
    public function show(Set_notes $set_notes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Set_notes  $set_notes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mynote = Set_notes::find($id);
        return view('accounts.notes.edit',compact('mynote'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Set_notes  $set_notes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $allnot = Set_notes::find($id);
        $allnot->auditor1st =$request->audi_1;
        $allnot->auditor2st =$request->audi_2;
        $allnot->treasurer =$request->treasurers;
        $allnot->notes =$request->notes;
        $allnot->auditors_report =$request->auditorsr_report;
        $allnot->save();
        toast(transMsg('Updated successfully.'), 'success')->focusCancel(true)->timerProgressBar();
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Set_notes  $set_notes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Set_notes $set_notes)
    {
        //
    }
}
