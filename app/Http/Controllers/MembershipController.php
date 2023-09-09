<?php

namespace App\Http\Controllers;

use App\Committee;
use App\Membership;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use App\Ledger;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//       return renderTransactionMEM();

        $membership = new Membership();
        $membership->dona_name =  $request->donor;
        $membership->committees_id =  $request->committeeid;
        $membership->date = $request->date;
        $membership->year = $request->years;
        $membership->yearstart =   $request->yearstart;
        $membership->yearEnd =$request->yearEnd;
        $membership->subscription = $request->totalsub;
        $membership->registration = $request->registration;
        $membership->donation =  $request->donations;
        $membership->arrears = $request->arrears;
        $membership->grants = $request->grants;
        $membership->other = $request->other;
        $membership->amount = $request->totalamaountdet;
        $membership->remarks = $request->remarks;
        $membership->ledger_id = $request->ledger_id;
        $membership->member_reciept_number = renderTransactionMEM();
        $membership->save();

        $ledger = Ledger::find($request->ledger_id);
        $ledger->update(['current_balance' => ($ledger->current_balance + $request->totalamaountdet)]);

        toast(transMsg('Created successfully.'), 'success')->focusCancel(true)->timerProgressBar();
        return back();






    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $membar = Membership::find($id);
        $committee = Committee::all();
        return view('accounts.membership_show',compact('membar','committee'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function edit(Membership $membership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membership $membership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Membership $membership)
    {
        //
    }
}
