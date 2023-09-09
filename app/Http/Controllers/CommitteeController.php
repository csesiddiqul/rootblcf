<?php

namespace App\Http\Controllers;

use App\Committee;
use App\Country;
use App\Http\Controllers\Controller;
use App\Ledger;
use App\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $data['type'] = 1;
        $data['committee'] = Committee::bySchool(Auth::user()->school->id)->where('type', 1)->get();
        return view('committee.index', $data);
    }

    public function committee_list(){
//        return $data['financialYear_id'] = current_financial_year()->id;

        $data['type'] = 2;
        $school_id = Auth::user()->school_id;
        $data['committee'] = Committee::bySchool(Auth::user()->school->id)->get();
        $ledgers = Ledger::all();
        $memberships = Membership::orderBy('id', 'DESC')->get();
        return view('accounts.committee_list', $data,compact('ledgers','memberships'));

    }

    public function memberIndex()
    {
        $data['type'] = 2;
        $data['committee'] = Committee::bySchool(Auth::user()->school->id)->where('type', 2)->get();
        return view('committee.index', $data);
    }

    public function managementIndex()
    {
        $data['type'] = 3;
        $data['committee'] = Committee::bySchool(Auth::user()->school->id)->where('type', 3)->get();
        return view('committee.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['type'] = 1;
        $data['country'] = Country::pluck('name', 'id');
        return view('committee.create', $data);
    }

    public function memberCreate()
    {
        $data['type'] = 2;
        $data['country'] = Country::pluck('name', 'id');
        return view('committee.create', $data);
    }

    public function managementCreate()
    {
        $data['type'] = 3;
        $data['country'] = Country::pluck('name', 'id');
        return view('committee.create', $data);
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
            'type' => 'required|numeric|in:1,2,3',
            'name' => 'required|string',
            'mobile' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'nationality' => 'required|string',
        ]);
        $data = $request->except('_token');
        $data['school_id'] = auth()->user()->school_id;
        $data['dob'] = date('Y-m-d', strtotime($request['dob']));
        $data['startdate'] = date('Y-m-d', strtotime($request['startdate']));
        $data['enddate'] = date('Y-m-d', strtotime($request['enddate']));
        if (isset($request->url))
            $data['image'] = (!empty($request->url)) ? fileUpload($request->url, 'SC') : '';
        $tb = new Committee();
        $tb->fill($data);
        $tb->save();
        toast(transMsg('Created successfully'), 'success')->timerProgressBar();
        $typename = ($data['type'] == 1 ? 'committee' : ($data['type'] == 2 ? 'member' : 'management'));
        return redirect()->route('academic.' . $typename . '.index');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Committee $committee
     * @return \Illuminate\Http\Response
     */
    public function show(Committee $committee)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Committee $committee
     * @return \Illuminate\Http\Response
     */
    public function edit(Committee $committee)
    {
        $data['type'] = \request()->type;
        $data['country'] = Country::pluck('name', 'id');
        $data['committee'] = $committee;
        return view('committee.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Committee $committee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Committee $committee)
    {
        request()->validate([
            'type' => 'required|numeric|in:1,2,3',
            'name' => 'required|string',
            'mobile' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'nationality' => 'required|string',
        ]);
        $data = $request->except('_token', '_method');
        $data['dob'] = date('Y-m-d', strtotime($request['dob']));
        $data['startdate'] = date('Y-m-d', strtotime($request['startdate']));
        $data['enddate'] = date('Y-m-d', strtotime($request['enddate']));
        if (isset($request->url)) {
            unlinkS3File($committee->image);
            $data['image'] = (!empty($request->url)) ? fileUpload($request->url, 'SC') : $committee->image;
        }
        $committee->update($data);
        toast(transMsg('Updated successfully'), 'success')->timerProgressBar();
        $typename = ($data['type'] == 1 ? 'committee' : ($data['type'] == 2 ? 'member' : 'management'));
        return redirect()->route('academic.' . $typename . '.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Committee $committee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Committee $committee)
    {
        unlinkS3File($committee->image);
        $type = $committee->type;
        $committee->delete();
        toast(transMsg('Delete successfully'), 'success')->timerProgressBar();
        $typename = ($type == 1 ? 'committee' : ($type == 2 ? 'member' : 'management'));
        return redirect()->route('academic.' . $typename . '.index');
    }
}
