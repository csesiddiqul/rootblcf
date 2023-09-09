<?php

namespace App\Http\Controllers;

use App\FinancialYear;
use Illuminate\Http\Request;

class FinancialYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $financial_years = FinancialYear::bySchool(school('id'))->get();
        $postUrl = route('accounts.financialyear.store');
        return view('accounts.financial_year', compact('financial_years', 'postUrl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:financial_years,name,null,id,school_id,' . school('id'),
            'from_date' => 'required|string',
            'to_date' => 'required|string',
            'status' => 'required|numeric|in:1,2',
        ]);
        $request['from_date'] = date('Y-m-d', strtotime($request->from_date));
        $request['to_date'] = date('Y-m-d', strtotime($request->to_date));
        $request['school_id'] = school('id');
        $request = $request->except(['_token', '_method']);
        $insert = FinancialYear::create($request);
        if ($request->status == 1) {
            FinancialYear::bySchool(school('id'))->where('id', '!=', $insert->id)->update(array('status' => 2));
        }
        toast(transMsg('Created successfully.'), 'success')->focusCancel(true)->timerProgressBar();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\FinancialYear $financialYear
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\FinancialYear $financialYear
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $financialYear = FinancialYear::bySchool(school('id'))->findOrFail($id);
        $financial_years = FinancialYear::bySchool(school('id'))->get();
        $postUrl = route('accounts.financialyear.update', $financialYear->id);
        return view('accounts.financial_year', compact('financial_years', 'financialYear', 'postUrl'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\FinancialYear $financialYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $financialYear = FinancialYear::bySchool(school('id'))->findOrFail($id);
        $this->validate($request, [
            'name' => 'required|string|unique:financial_years,name,' . $financialYear->id . ',id,school_id,' . school('id'),
            'from_date' => 'required|string',
            'to_date' => 'required|string',
            'status' => 'required|numeric|in:1,2',
        ]);
        $request['from_date'] = date('Y-m-d', strtotime($request->from_date));
        $request['to_date'] = date('Y-m-d', strtotime($request->to_date));
        $request['is_close'] = ($request->is_close == 1 ? 0 : $financialYear->is_close);
        $request = $request->except(['_token', '_method']);
        $financialYear->update($request);
        if ($request['status'] == 1) {
            FinancialYear::bySchool(school('id'))->where('id', '!=', $id)->update(array('status' => 2));
        }
        toast(transMsg('Update successfully.'), 'success')->focusCancel(true)->timerProgressBar();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\FinancialYear $financialYear
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FinancialYear::bySchool(school('id'))->findOrFail($id)->delete();
        toast(transMsg('Delete successfully.'), 'success')->focusCancel(true)->timerProgressBar();
        return redirect()->back();
    }
}
