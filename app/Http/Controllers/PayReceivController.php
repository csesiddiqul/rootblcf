<?php

namespace App\Http\Controllers;

use App\Payment;
use App\PayReceiv;
use Illuminate\Http\Request;

class PayReceivController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payrecevs = PayReceiv::all();
        return view('accounts.notes.payable-receivables',compact('payrecevs'));
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

        $financialYear = active_financial_year();

        $pyreciv = new PayReceiv();
//        $pyreciv->pygroup =$request->py_group;
        $pyreciv->name = $request->name;
        $pyreciv->date = $request->date;
        $pyreciv->financialYear_id = $financialYear->id;
        $pyreciv->amount = $request->balance;

        $pyreciv->save();

        toast(transMsg('Create successfully.'), 'success')->focusCancel(true)->timerProgressBar();
        return back();



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PayReceiv  $payReceiv
     * @return \Illuminate\Http\Response
     */
    public function show(PayReceiv $payReceiv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PayReceiv  $payReceiv
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mypayredata =  PayReceiv::find($id);
        $payrecevs = PayReceiv::all();
        return view('accounts.notes.payable-receivables_edit',compact('mypayredata','payrecevs'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PayReceiv  $payReceiv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $financialYear = active_financial_year();
        $pyreciv = PayReceiv::find($id);
//        $pyreciv = new PayReceiv();
//        $pyreciv->pygroup =$request->py_group;
        $pyreciv->name = $request->name;
        $pyreciv->date = $request->date;
        $pyreciv->financialYear_id = $financialYear->id;
        $pyreciv->amount = $request->balance;

        $pyreciv->save();

        toast(transMsg('Create successfully.'), 'success')->focusCancel(true)->timerProgressBar();
        return redirect('accounts/pay_receive');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PayReceiv  $payReceiv
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayReceiv $payReceiv)
    {
        //
    }
}
