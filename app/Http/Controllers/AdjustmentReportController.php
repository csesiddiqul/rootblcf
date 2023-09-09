<?php

namespace App\Http\Controllers;

use App\Adjustment_report;
use Illuminate\Http\Request;

class AdjustmentReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $financialYear = active_financial_year();
        $data['adjustments'] =  Adjustment_report::with(
          'accountSectornew',
          'accountSectorold',
          'ledgerold',
          'ledgernew'
        )->where('school_id', auth()->user()->school_id)
            ->where('financialYear_id', $financialYear->id)
            ->whereYear('new_date', $this->request->year ?? date('Y'))
            ->orderBy('created_at', 'DESC')
            ->get();




//        $data['expenses'] = $this->accountService->getExpensesByYear();
        if ($request->_token && $request->year)
            $data['year'] = $request->year;
        else
            $data['year'] = $request->year;


        return view('accounts.expense.adjustment_report', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Adjustment_report  $adjustment_report
     * @return \Illuminate\Http\Response
     */
    public function show(Adjustment_report $adjustment_report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Adjustment_report  $adjustment_report
     * @return \Illuminate\Http\Response
     */
    public function edit(Adjustment_report $adjustment_report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Adjustment_report  $adjustment_report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adjustment_report $adjustment_report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Adjustment_report  $adjustment_report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adjustment_report $adjustment_report)
    {
        //
    }
}
