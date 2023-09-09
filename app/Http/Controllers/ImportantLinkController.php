<?php

namespace App\Http\Controllers;

use App\ImportantLink;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ImportantLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['importantLinks'] = ImportantLink::bySchool(Auth::user()->school->id)->get();
        return view('importantLink.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('importantLink.create');
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
           'link' => 'required|string',
           'status' => 'required|numeric',
        ]);
        $importantLink = new ImportantLink();
        $importantLink->school_id = auth()->user()->school_id;
        $importantLink->link = $request['link'];
        $importantLink->name = $request['name'];
        $importantLink->parioty = $request['parioty'];
        $importantLink->status = $request['status'];
        $importantLink->save();
        toast(transMsg('ImportantLink  Created successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.importantLink.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImportantLink  $importantLink
     * @return \Illuminate\Http\Response
     */
    public function show(ImportantLink $importantLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImportantLink  $importantLink
     * @return \Illuminate\Http\Response
     */
    public function edit(ImportantLink $importantLink)
    {
        $data['importantLink'] = $importantLink;
        return view('importantLink.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ImportantLink  $importantLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImportantLink $importantLink)
    {
        request()->validate([
            'link' => 'required|string',
            'status' => 'required|numeric',
        ]);
        $importantLink->school_id = auth()->user()->school_id;
        $importantLink->link = $request->link;
        $importantLink->name = $request->name;
        $importantLink->parioty = $request->parioty;
        $importantLink->status = $request->status;
        $importantLink->save();
        toast(transMsg('ImportantLink  Update successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.importantLink.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImportantLink  $importantLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImportantLink $importantLink)
    {
        $importantLink->delete();
        toast(transMsg('ImportantLink Delete successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.importantLink.index');

    }
}
