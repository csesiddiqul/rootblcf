<?php

namespace App\Http\Controllers;

use App\Income;
use Illuminate\Http\Request;
use App\AccountSector;
use App\Expense;
use App\Http\Controllers\Controller;
use App\Ledger;
use App\Services\Account\AccountService;
use Illuminate\Support\Facades\Auth;
class IncomeController extends Controller
{

    protected $accountService;

    public function __construct(AccountService $accountService)
    {
        parent::__construct();
        $this->accountService = $accountService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->accountService->request = $request;
        $this->accountService->account_type = 'income';
        $data['income'] = $this->accountService->getIncomeByYear();
        if ($request->_token && $request->year)
            $data['year'] = $request->year;
        else
            $data['year'] = date('Y');
        return view('accounts.income.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $school_id = Auth::user()->school_id;
         $sectors = AccountSector::orderBy('name', 'asc')->bySchool($school_id)->where('type', 'income')->pluck('name', 'id');
         $ledgers = Ledger::bySchool($school_id)->get()->groupBy('ac_group');
        return view('accounts.income.create', compact('sectors', 'ledgers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request, [
            'account_sector_id' => 'required|numeric',
            'ledger_id' => 'required|numeric',
            'name' => 'required|string',
            'invoice_number' => 'nullable|string',
            'file' => 'nullable|max:5000|mimes:png,jpeg,jpg,pdf',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string'
        ], [
            'account_sector_id.required' => 'The Expense Head is required',
            'ledger_id.required' => 'The Ledger is required',
        ]);

        $data = $request->except('_token');
        $data['school_id'] = auth()->user()->school_id;
        $data['financialYear_id'] = current_financial_year()->id;
        $data['user_id'] = auth()->user()->id;
          $data['date'] = date('Y-m-d', strtotime($data['date']));
        if ($request->hasFile('file'))
            $data['file'] = multiFileUpload($request->file('file'), 'Income');
      $income = Income::create($data);

        $voucher_no = str_pad($income->id, 5, '0', STR_PAD_LEFT);
        $voucher_no = date('Ym', strtotime($income->created_at)) .'-'.'B'. $voucher_no;
        $income->update(['voucher_no' => $voucher_no]);
        $ledger = Ledger::find($request->ledger_id);
        $ledger->update(['current_balance' => ($ledger->current_balance + $income->amount)]);
        toast(transMsg('Saved Successfully'), 'success')->timerProgressBar();
        return redirect()->route('accounts.income.voucher', $income->voucher_no);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {


        if (school('expense_edit') != 1)
            return redirect()->route('accounts.income.index');
        $school_id = Auth::user()->school_id;
        $sectors = AccountSector::orderBy('name', 'asc')->bySchool($school_id)->where('type', 'income')->pluck('name', 'id');
        $ledgers = Ledger::bySchool($school_id)->get()->groupBy('ac_group');
        return view('accounts.income.edit', compact('income', 'sectors', 'ledgers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        if (school('expense_edit') != 1)
            return redirect()->route('accounts.income.index');
        $this->validate($request, [
            'account_sector_id' => 'required|numeric',
            'ledger_id' => 'required|numeric',
            'name' => 'required|string',
            'invoice_number' => 'nullable|string',
            'file' => 'nullable|max:5000',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string'
        ], [
            'account_sector_id.required' => 'The Expense Head is required',
            'ledger_id.required' => 'The Ledger is required',
        ]);
        $data = $request->except('_token');
        $data['date'] = date('Y-m-d', strtotime($data['date']));
        if ($request->hasFile('file')) {
            unlinkS3File($income->file);
            $data['file'] = multiFileUpload($request->file('file'), 'Expense');
        }
        $income->update($data);
        toast(transMsg('Update Successfully'), 'success')->timerProgressBar();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        //
    }


    public function voucher($voucher_no)
    {

         $voucher = Income::where('voucher_no', $voucher_no)->first();
        if (empty($voucher))
            return abort('404');
        $voucherType = ['Payment Voucher', 'Payment Voucher'];
        return view('accounts.income.voucher', compact('voucher', 'voucherType'));
    }
}
