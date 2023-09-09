<?php

namespace App\Http\Controllers;

use App\AccountSector;
use App\Adjustment_report;
use App\Expense;
use App\Http\Controllers\Controller;
use App\Ledger;
use App\Services\Account\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
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
        $this->accountService->account_type = 'expense';
        $data['expenses'] = $this->accountService->getExpensesByYear();
        if ($request->_token && $request->year)
            $data['year'] = $request->year;
        else
            $data['year'] = date('Y');
        return view('accounts.expense.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $school_id = Auth::user()->school_id;
        $sectors = AccountSector::bySchool($school_id)->where('type', 'expense')->pluck('name', 'id');
        $ledgers = Ledger::bySchool($school_id)->get()->groupBy('ac_group');
        return view('accounts.expense.create', compact('sectors', 'ledgers'));
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
            'account_sector_id' => 'required|numeric',
            'ledger_id' => 'required|numeric',
            'name' => 'required|string',
            'invoice_number' => 'nullable|string',
            'file' => 'nullable',
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
            $data['file'] = multiFileUpload($request->file('file'), 'Expense');
        $expense = Expense::create($data);
        $voucher_no = str_pad($expense->id, 5, '0', STR_PAD_LEFT);
        $voucher_no = date('Ym', strtotime($expense->created_at)) .'-'. $voucher_no;
        $expense->update(['voucher_no' => $voucher_no]);
        $ledger = Ledger::find($request->ledger_id);
        $ledger->update(['current_balance' => ($ledger->current_balance - $expense->amount)]);
        toast(transMsg('Saved Successfully'), 'success')->timerProgressBar();

        return redirect()->route('accounts.expense.voucher', $expense->voucher_no);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Expense $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Expense $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        if (school('expense_edit') != 1)
            return redirect()->route('accounts.expense.index');
        $school_id = Auth::user()->school_id;
        $sectors = AccountSector::bySchool($school_id)->where('type', 'expense')->pluck('name', 'id');
        $ledgers = Ledger::bySchool($school_id)->get()->groupBy('ac_group');
        return view('accounts.expense.edit', compact('expense', 'sectors', 'ledgers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Expense $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {

//        return $expense;

        if (school('expense_edit') != 1)
            return redirect()->route('accounts.expense.index');
        $this->validate($request, [
            'account_sector_id' => 'required|numeric',
            'ledger_id' => 'required|numeric',
            'name' => 'required|string',
            'invoice_number' => 'nullable|string',
            'file' => 'nullable',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string'
        ], [
            'account_sector_id.required' => 'The Expense Head is required',
            'ledger_id.required' => 'The Ledger is required',
        ]);

        $adjusReport = new Adjustment_report();
        $adjusReport->old_ledger = $expense->ledger_id;
        $adjusReport->old_amount =$expense->amount;
        $adjusReport->old_account_sector_id =$expense->account_sector_id;
        $adjusReport->old_name =$expense->name;
        $adjusReport->old_date =$expense->date;
        $adjusReport->old_user_id =$expense->user_id;
        $adjusReport->new_ledger =$request->ledger_id;
        $adjusReport->new_amount =$request->amount;
        $adjusReport->new_account_sector_id =$request->account_sector_id;
        $adjusReport->new_name =$request->name;
        $adjusReport->new_date =date('Y-m-d',strtotime($request->date));
        $adjusReport->new_user_id =Auth::user()->id;
        $adjusReport->voucher_no =$expense->voucher_no;
        $adjusReport->financialYear_id =$expense->financialYear_id;
        $adjusReport->school_id =$expense->school_id;

        $adjusReport->save();

        $ledger = Ledger::find($expense->ledger_id);
        $ledger->update(['current_balance' => ($ledger->current_balance + $expense->amount)]);

        $data = $request->except('_token');
        $ledger = Ledger::find($request->ledger_id);
        $ledger->update(['current_balance' => ($ledger->current_balance - $request->amount)]);

        $data['date'] = date('Y-m-d', strtotime($data['date']));
        if ($request->hasFile('file')) {
            unlinkS3File($expense->file);
            $data['file'] = multiFileUpload($request->file('file'), 'Expense');
        }

       $expense->update($data);

        toast(transMsg('Update Successfully'), 'success')->timerProgressBar();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Expense $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        return redirect()->route('accounts.expense.index');
        $expense->delete();
        toast(transMsg('Deleted Successfully.'), 'success')->timerProgressBar();
        return redirect()->route('accounts.expense.index');
    }

    public function voucher($voucher_no)
    {
        $voucher = Expense::bySchool(\auth()->user()->school_id)->where('voucher_no', $voucher_no)->first();
        if (empty($voucher))
            return abort('404');
        $voucherType = ['Payment Voucher', 'Payment Voucher'];
        return view('accounts.expense.voucher', compact('voucher', 'voucherType'));
    }
}
