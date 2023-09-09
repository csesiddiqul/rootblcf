<?php

namespace App\Http\Controllers;

use App\AccountReport;
use App\EmployeePayroll;
use App\Expense;
use App\Fee;
use App\FinancialYear;
use App\Income;
use App\InternalTransfer;
use App\Ledger;
use App\AccountSector;
use App\Due;
use App\Membership;
use App\Myclass;
use App\PayReceiv;
use App\Set_notes;
use App\User;
use App\Payment;
use App\Section;
use App\PaymentDetail;
use Illuminate\Http\Request;
use App\Services\Account\AccountService;
use App\Http\Requests\Account\StoreSectorRequest;
use App\Http\Requests\Account\StoreLedgerRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    protected $accountService;

    public function __construct(AccountService $accountService)
    {
        parent::__construct();
        $this->accountService = $accountService;
    }

    public function sectors()
    {
        $sectors = $this->accountService->getSectorsBySchoolId();
        $ledgers = Ledger::bySchool(Auth::user()->school_id)->get()->groupBy('ac_group');
        $sector = [];
        $postUrl = url('/accounts/create-sector');
        return view('accounts.sector', compact('sectors', 'sector', 'postUrl', 'ledgers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeSector(StoreSectorRequest $request)
    {
        $this->accountService->storeSector($request->validated());
        toast(transMsg('Created successfully.'), 'success')->focusCancel(true)->timerProgressBar();
        return back();
    }



    public function studentPaymentList(){
        return view('accounts.student_payment.payment_list');
    }

    public function studentPaymentListSearch(Request $request){




        if ($request->isMethod('post')) {
            $this->validate($request, [
                'from' => 'required|date',
                'to' => 'required|date'
            ]);
        }

        $from = date('Y-m-d', strtotime($request->from));
        $to = date('Y-m-d', strtotime($request->to));



        $year =  date('Y');
        $data = Payment::with('student','section')->whereBetween('trans_date', [\Carbon\Carbon::parse($from)->format('Y-m-d'), \Carbon\Carbon::parse($to)->format('Y-m-d')])->where('trans_status','=','Paid')->get();
        $totalPay = $data->sum('total') - $data->sum('waiver');
        $year = 'Form '.$from .'- To '. $to ;

        return view('accounts.student_payment.payment_list',compact('data','year','totalPay'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editSector(AccountSector $sector)
    {
        $sectors = $this->accountService->getSectorsBySchoolId();
        $postUrl = route('accounts.sectors.update', ['sector' => $sector->id]);
        return view('accounts.sector', compact('sectors', 'sector', 'postUrl'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSector(Request $request, AccountSector $sector)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:account_sectors,name,' . $sector->id . ',id,school_id,' . Auth::user()->school_id,
            'type' => 'required|string'
        ]);
        $request = $request->except(['_token', '_method']);
        $this->accountService->updateSector($sector, $request);
        toast(transMsg('Updated successfully.'), 'success')->focusCancel(true)->timerProgressBar();
        return redirect('/accounts/sectors');
    }

    /**
     * Delete the specified resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @throws \Exception
     */
    public function deleteSector(AccountSector $sector)
    {
        $sector->delete();
        toast(transMsg('Deleted successfully.'), 'success')->focusCancel(true)->timerProgressBar();
        return redirect('/accounts/sectors');
    }

    public function sectorInfo($id)
    {
        $school_id = Auth::user()->school_id;
        $sector = AccountSector::bySchool($school_id)->findorFail($id);
        $results = AccountReport::bySchool($school_id)->where('head_id', $id)->orderBy('created_at')->get();
        $accountHeads = $this->accountSector->bySchool($school_id)->get()->groupBy('type');
        $closing_balance = 0;
        if ($sector->type == 'income') {
            $credit = Payment::bySchool($school_id)
                ->whereHas('paymentDetail', function ($q) use ($id) {
                    $q->whereHas('due', function ($subq) use ($id) {
                        $subq->whereHas('fee', function ($subq1) use ($id) {
                            $subq1->where('type', $id);
                        });
                    });
                })->whereDate('trans_date', date('Y-m-d'))->get();
            $closing_balance = $results[count($results) - 1]->op_balance + ($credit->sum('total') - $credit->sum('waiver'));
        } else {
            $debit = Expense::bySchool($school_id)->where('account_sector_id', $sector->id)->whereDate('date', date('Y-m-d'))->sum('amount');
            $closing_balance = $results[count($results) - 1]->op_balance - $debit;
        }
        return view('accounts.sectorInfo', compact('results', 'sector', 'closing_balance','accountHeads'));
    }

    public function ledger()
    {
        $ledgers = Ledger::bySchool(Auth::user()->school_id)->get()->groupBy('ac_group');
        $postUrl = route('accounts.ledger.store');
        return view('accounts.ledger', compact('ledgers', 'postUrl'));
    }

    public function storeLedger(StoreLedgerRequest $request)
    {

        $this->accountService->request = $request;
        $this->accountService->storeLedger();
        toast(transMsg('Created successfully.'), 'success')->focusCancel(true)->timerProgressBar();
        return redirect()->back();
    }

    public function ledgerInfo($id)
    {
        $ledger = Ledger::bySchool(Auth::user()->school_id)->findOrFail($id);

        $membership = Membership::where('ledger_id','=',$id)->get();

        $financialYear = active_financial_year();

        $TransfersCr = InternalTransfer::where('financialYear_id','=',$financialYear->id)
            ->where('ledger_id_credit','=',$id)
            ->selectRaw('ledger_id_credit, sum(internal_transfers.amount) as amountc')->get();

        $internalTransfersCr = $TransfersCr[0]->amountc;

        $TransfersDa = InternalTransfer::where('financialYear_id','=',$financialYear->id)
            ->where('ledger_id_david','=',$id)
            ->selectRaw('ledger_id_credit, sum(internal_transfers.amount) as amountda')->get();

        $internalTransfersDa = $TransfersDa[0]->amountda;

        $income = Income::where('incomes.financialYear_id', $financialYear->id)->where('ledger_id','=',$id)
            ->selectRaw('ledger_id, sum(incomes.amount) as amountin')->get();
        $incomeall = $income[0]->amountin;

        return view('accounts.ledgerInfo', compact('ledger','membership','internalTransfersCr','internalTransfersDa','incomeall'));
    }
    public function editLedger($id)
    {
        $ledger = Ledger::bySchool(Auth::user()->school_id)->findOrFail($id);
        $ledgers = Ledger::bySchool(Auth::user()->school_id)->get()->groupBy('ac_group');
        $postUrl = route('accounts.ledger.update', $ledger->id);
        return view('accounts.ledger', compact('ledger', 'ledgers', 'postUrl'));
    }

    public function updateLedger(StoreLedgerRequest $request, $id)
    {
        $request['id'] = $id;
        $this->accountService->request = $request;
        $this->accountService->updateLedger();
        toast(transMsg('Updated successfully.'), 'success')->focusCancel(true)->timerProgressBar();
        return redirect('accounts/ledger');
    }

    public function deleteLedger($id)
    {
        $result = Ledger::bySchool(Auth::user()->school_id)->findOrFail($id);
        if ($result->account_report->count() == 0) {
            $result->delete();
            toast(transMsg('Deleted successfully.'), 'success')->focusCancel(true)->timerProgressBar();
        }
        return redirect('accounts/ledger');
    }

    public function listExpense(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->accountService->request = $request;
            $this->accountService->account_type = 'expense';
            $data['expenses'] = $this->accountService->getExpensesByYear();
            $data['year'] = $request->year;
        } else {
            $this->accountService->account_type = 'expense';
            $data['expenses'] = $this->accountService->getExpensesByYear();
            $data['year'] = date('Y');
        }
        return $data;
        return view('accounts.expense-list', $data);
    }

    public function moneyreceipt(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'studentId' => 'required',
                // 'date' => 'required|date|after:yesterday',
                'date' => 'required|date'
            ]);
            $search = $request->studentId;
            $search_date = $request->date;
            $schoolid = 14;
            if($search != ''){
                $data = User::where('name','LIKE', "%$search%")->orwhere('student_code', 'LIKE', "$search")->get();
                $stdu = $data->where('school_id', '=' , 14);
                $stduntprment = $stdu->where('role', '=' ,'student');
                $allsc = DB::table('users')
                    ->join('sections','users.section_id','sections.id')
                    ->join('classes','sections.class_id','classes.id')
                    ->get();
                return view('accounts.money-receipt',compact('stduntprment','search_date','allsc'));
            }
        }
        return view('accounts.money-receipt');
    }

    public function updatedue(Request  $request , $id){
        $allf =  $request->fees_id;
        for($i = 0; $i< count($allf); $i++){
            $deu = Fee::find($request->fees_id[$i]);
            $deu->amount = $request->amount[$i];
            $deu->save();
        }

//
//        return $request->fees_id;
//
//
////        $request->fees_id[0];
//
//        $deu = Fee::find($request->fees_id[0]);
//
//        $deu->amount = $request->amount[0];
//
//        $deu->save();

        $date = date('y-m-d');

        return \Redirect::route('accounts.ledger.searchdata',[$id,$date]);


    }




    public function delete_due($deu_id,$fee_id){
        $duedata =   Due::find($deu_id);
        $feedata =   Fee::find($fee_id);
        $feedata->delete();
        $duedata->delete();
        return back();
    }

    public function editdeu($id,$mydate)
    {

        if ($id && $mydate){
            $data['fees'] = $this->fee->bySchool(auth()->user()->school_id)->orderBy('created_at', 'DESC')->get();
            $student_code = trim($id);
            $school_id = Auth::user()->school_id;
            $data['dues'] = Due::with('class', 'section')
                ->join('users', 'users.id', 'dues.student_id')
                ->join('fees', 'fees.id', 'dues.fee_id')
                ->join('account_sectors', 'account_sectors.id', 'fees.type')
                ->leftJoin('payment_details', 'dues.id', 'payment_details.due_id')
                ->select('dues.id', 'dues.school_id', 'dues.user_id', 'dues.class_id', 'dues.section_id', 'dues.student_id', 'dues.fee_id', 'dues.status', 'fees.amount', 'fees.type', 'fees.date as created_at', 'users.name', 'users.student_code', 'account_sectors.name as account_sectors', \DB::raw('sum(payment_details.amount) as paid'), \DB::raw('sum(payment_details.waiver) as waiver'), \DB::raw('fees.amount- CASE WHEN payment_details.amount IS NULL THEN 0 ELSE (sum(payment_details.amount)+sum(payment_details.waiver)) END  as due'))
                ->where('dues.school_id', $school_id)
                ->where('dues.status', 1)
                ->where('users.student_code', $student_code)->groupBy('dues.id');
            $data['dues'] = DBConnection()->table(DB::raw("({$data['dues']->toSql()}) as data"))->mergeBindings($data['dues']->getQuery())->where("due", "!=", 0)->get();
            $data['student_code'] = $student_code;
            $data['date'] = $mydate;
            $data['ledgers'] = Ledger::bySchool($school_id)->get()->groupBy('ac_group');
            //return dd($data);
            view()->share($data);
        }
        return view('fees.singale_deu_edit');
    }



    public function searchdata($id,$mydate)
    {

        if ($id && $mydate){
            $data['fees'] = $this->fee->bySchool(auth()->user()->school_id)->orderBy('created_at', 'DESC')->get();
            $student_code = trim($id);
            $school_id = Auth::user()->school_id;
            $data['dues'] = Due::with('class', 'section')
                ->join('users', 'users.id', 'dues.student_id')
                ->join('fees', 'fees.id', 'dues.fee_id')
                ->join('account_sectors', 'account_sectors.id', 'fees.type')
                ->leftJoin('payment_details', 'dues.id', 'payment_details.due_id')
                ->select('dues.id', 'dues.school_id', 'dues.user_id', 'dues.class_id', 'dues.section_id', 'dues.student_id', 'dues.fee_id', 'dues.status', 'fees.amount', 'fees.type', 'fees.date as created_at', 'users.name', 'users.student_code', 'account_sectors.name as account_sectors', \DB::raw('sum(payment_details.amount) as paid'), \DB::raw('sum(payment_details.waiver) as waiver'), \DB::raw('fees.amount- CASE WHEN payment_details.amount IS NULL THEN 0 ELSE (sum(payment_details.amount)+sum(payment_details.waiver)) END  as due'))
                ->where('dues.school_id', $school_id)
                ->where('dues.status', 1)
                ->where('users.student_code', $student_code)->groupBy('dues.id');
            $data['dues'] = DBConnection()->table(DB::raw("({$data['dues']->toSql()}) as data"))->mergeBindings($data['dues']->getQuery())->where("due", "!=", 0)->get();
            $data['student_code'] = $student_code;
            $data['date'] = $mydate;
            $data['ledgers'] = Ledger::bySchool($school_id)->get()->groupBy('ac_group');
            //return dd($data);
            view()->share($data);
        }
        return view('accounts.search_lis');
    }

    public function moneyreceived(Request $request, $student_code)
    {




        $this->validate($request, [
            'type' => 'required|array|distinct',
            'amount' => 'required|array',
            'waiver' => 'nullable|array',
            'date' => 'required|date',
            'ledger_id' => 'required|numeric'
        ]);
        if ((count($request->amount) !== count($request->waiver)) || (count($request->amount) !== count($request->type)) || (count($request->type) !== count($request->waiver))) {
            return abort(500);
        }

        // return $request->all();
        $student = (new User())->getUser(false, $student_code);
        if (empty($student))
            return redirect()->back();

        $type = $request->type;
        $month = 0;
        $old_month = $month_des = $last_month = '';
        $dues = Fee::whereHas('due', function ($q) use ($type) {
            $q->whereIn('id', $type);
        })->orderBy('date')->get();

        $last_key = count($dues);

        foreach ($dues as $key => $due) {
            if ($due->account_sector->id == 8) {
                $new_month = date('m', strtotime($due->date));
                if ($new_month != $old_month) {
                    $month++;
                    $old_month = $new_month;
                }
                if ($key + 1 == $last_key)
                    $last_month = date('M Y', strtotime($due->date));
            }
        }

        foreach ($dues as $due) {
            $tuitionHead = str_replace(' ', '', strtolower($due->account_sector->name));
            if ($tuitionHead == 'tuitionfees' || $tuitionHead == 'tuitionfee' || $tuitionHead == 'tuitionad') {
                if (count($request->type) == 1) {
                    $month_des .= date('M Y', strtotime($due->date));
                } else {
                    $month_des .= date('M Y', strtotime($due->date)) . '-' . $last_month;
                }
                break;
            }
        }
        $payment["school_id"] = Auth::user()->school_id;
        $payment["user_id"] = Auth::user()->id;
        $payment["student_id"] = $student->id;
        $payment["reciept_number"] = renderTransaction();
        $payment["trans_status"] = 'Paid';
        $payment["trans_date"] = date('Y-m-d', strtotime($request->date));
        // $total = $waiver = 0;
        /*for ($i = 0; $i < count($type); $i++) {
            $total += $request->amount[$i];
            $waiver += $request->waiver[$i];
        }*/
        $payment["total"] = array_sum($request->amount);
        if (!empty($request->waiver)) {
            $payment["waiver"] = array_sum($request->waiver) ?? 0;
        } else {
            $payment["waiver"] = 0;
        }
        $payment["payment_type"] = 1;
        $payment["ledger_id"] = $request->ledger_id;
        $payment["remark"] = $request->remark;
        $payment = Payment::create($payment);
        $ledger = Ledger::find($request->ledger_id);
        $ledger->update(['current_balance' => ($ledger->current_balance + ($payment["total"] - $payment["waiver"]))]);
        for ($i = 0; $i < count($type); $i++) {
            $already_paid_amount = $request->amount[$i];
            $due = Due::find($type[$i]);
            foreach ($due->paymentDetail as $already_paid) {
                $already_paid_amount += $already_paid->amount + $already_paid->waiver;
            }


            $paymentDetail['due_id'] = $type[$i];
            $paymentDetail['amount'] = $request->amount[$i] - $request->waiver[$i] ?? 0;
            $paymentDetail['waiver'] = $request->waiver[$i] ?? 0;
            $paymentDetail['payment_id'] = $payment->id;
            $tuitionHead = str_replace(' ', '', strtolower($due->fee->account_sector->name));
//            $tuitionHead = 'tuitionfees';
            if ($tuitionHead == 'tuitionfees' || $tuitionHead == 'tuitionfee' ||$tuitionHead == 'tuitionad' ) {
                $paymentDetail['month'] = $month;
                $paymentDetail['month_des'] = $month_des;
            }else{
                $paymentDetail['month'] = NULL;
                $paymentDetail['month_des'] = NULL;
            }



            $paymentDetail['updated_at'] = now();
            $paymentDetails[] = $paymentDetail;
            if ($due->fee->amount == $already_paid_amount)
                $due->update(['status' => 2]);
        }




        PaymentDetail::insert($paymentDetails);

        return redirect()->route('invoice', $payment->reciept_number);
    }

    public function invoice(Request $request, $receipt_number)
    {
        if (Auth::guest()) {
            if (!session('invoice_show'))
                return redirect()->route('pay_online');
        }
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'accountant') {
            $invoice = Payment::bySchool(school('id'))->where('reciept_number', $receipt_number)->first();
            if (empty($invoice)) {
                toast(transMsg('Receipt Number not found'), 'info')->timerProgressBar();
                return redirect()->route('home');
            }
            $invoiceType = ["Student's Copy", "School Copy", "Bank Copy"];
            $invoiceTemplate = foqas_setting('invoice_template');
            session()->forget('invoice_show');
            return view('accounts.invoice.invoice' . $invoiceTemplate, compact('invoice', 'invoiceType'));
        }
        return redirect()->back();
    }

    public function feereport(Request $request)
    {
        $school_id = Auth::user()->school_id;
        $data['pluckSection'] = (new Section())->getSection(true, true, true, 'classes.name')->prepend('All', 'all');
        $data['head'] = AccountSector::where('type', 'income')->bySchool($school_id)->pluck('name', 'id')->prepend('All', 'all');
        if ($request->isMethod('post')) {
            $data["report"] = AccountSector::where('account_sectors.school_id', $school_id)
                ->leftJoin('fees', 'account_sectors.id', 'fees.type')
                ->leftJoin('dues', 'fees.id', 'dues.fee_id')
                ->leftJoin('payment_details', function ($q) use ($request) {
                    $q->on('payment_details.due_id', 'dues.id')
                        ->leftJoin('payments', 'payment_details.payment_id', 'payments.id')
                        ->whereBetween(DB::raw('date(payments.trans_date)'), [date('Y-m-d', strtotime($request->from)), date('Y-m-d', strtotime($request->to))])
                        ->selectRaw('count(payment_details.id) as pdid');
                })
                ->selectRaw('account_sectors.name, sum(payment_details.waiver) as waiver,sum(payment_details.amount) as amount, sum(fees.amount) as fee, fees.id')
                ->whereBetween(DB::raw('date(fees.date)'), [date('Y-m-d', strtotime($request->from)), date('Y-m-d', strtotime($request->to))])
                ->groupBy('account_sectors.id')->get();

        }
        //return $data;

        $data['from'] = $request->from;
        $data['to'] = $request->to;

        return view('accounts.feereport', $data);
    }

    public function postExpense(Request $request)
    {
        $this->accountService->request = $request;
        $this->accountService->account_type = 'expense';
        $expenses = $this->accountService->getAccountsByYear();

        return view('accounts.expense-list', compact('expenses'));
    }

    public function duereport(Request $request)
    {
        $school_id = Auth::user()->school->id;
        $data['pluckSection'] = (new Section())->getSection(true, true, true, 'classes.name');
        $data['head'] = AccountSector::where('type', 'income')->bySchool($school_id)->pluck('name', 'id')->prepend('All', 'all');

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'section' => 'required|string',
                'type' => 'required|string',
                'from' => 'required|date',
                'to' => 'required|date|after_or_equal:from'
            ], [
                'to.after_or_equal' => 'The To date must be a date after or equal to From date'
            ]);
            $data['from'] = $from = $request->from;
            $data['to'] = $to = $request->to;
            $data['type'] = $type = $request->type;
            $data['section'] = $section = $request->section;
            $from = date('Y-m-d', strtotime($from));
            $to = date('Y-m-d', strtotime($to));
            $financialYear = active_financial_year();
            if ($request->type == 'all') {
                $heads = AccountSector::bySchool($school_id)->whereType('income')->pluck('id')->toArray();
            } else {
                $heads = AccountSector::bySchool($school_id)->whereType('income')->whereId($type)->pluck('id')->toArray();
            }
            $data['dues'] = Due::where([['dues.school_id', $school_id], ['dues.section_id', $section]])->whereIn('dues.status', [1, 2])
                ->leftjoin('fees', 'fees.id', 'dues.fee_id')
                ->leftjoin('account_sectors', 'account_sectors.id', 'fees.type')
                ->whereIn('account_sectors.id', $heads)
                ->where('fees.financialYear_id', $financialYear->id)
                ->whereBetween('fees.date', [$from, $to])
                ->select('dues.*', 'account_sectors.name', 'fees.type', 'fees.date')
                ->groupBy('account_sectors.name')->get();
        }
        return view('accounts.due-report', $data);
    }

    public function studentfeereport(Request $request)
    {

        $school_id = Auth::user()->school->id;
        $data['pluckSection'] = (new Section())->getSection(true, true, true, 'classes.name');
        $data['head'] = AccountSector::where('type', 'income')->bySchool($school_id)->pluck('name', 'id')->prepend('All', 'all');
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'section' => 'required|string',
                'student' => 'required|string',
                'type' => 'required|string',
                'from' => 'required|date',
                'to' => 'required|date|after_or_equal:from'
            ], [
                'to.after_or_equal' => 'The To date must be a date after or equal to From date'
            ]);
            $data['from'] = $from = $request->from;
            $data['to'] = $to = $request->to;
            $data['type'] = $type = $request->type;
            $data['student'] = $student = $request->student;
            $data['section'] = $section = $request->section;
            $from = date('Y-m-d H:i:s', strtotime($from));
            $to = date('Y-m-d 23:59:59', strtotime($to));
            $financialYear = active_financial_year();
            $data['pluckStudent'] = User::bySchool($school_id)->whereSection_id($section)->whereRole('student')->whereActive(1)->pluck('name', 'id');
            if ($request->type == 'all') {
                $heads = AccountSector::bySchool($school_id)->whereType('income')->pluck('id')->toArray();
            } else {
                $heads = AccountSector::bySchool($school_id)->whereType('income')->whereId($request->type)->pluck('id')->toArray();
            }

            $data['dues'] = Due::where([['dues.school_id', $school_id], ['dues.section_id', $request->section], ['dues.student_id', $student]])->whereIn('dues.status', [1, 2])
                ->leftjoin('fees', 'fees.id', 'dues.fee_id')
                ->leftjoin('account_sectors', 'account_sectors.id', 'fees.type')
                ->leftJoin('payment_details', function ($q) {
                    $q->on('dues.id', 'payment_details.due_id')
                        ->whereRaw('(CASE WHEN payment_details.amount IS NOT NULL THEN true ELSE false END)');
                })
                ->whereIn('account_sectors.id', $heads)
                ->where('fees.financialYear_id', $financialYear->id)
                ->whereBetween('fees.date', [$from, $to])
                ->select('dues.section_id', 'dues.student_id', 'dues.class_id', 'account_sectors.id', 'account_sectors.name', DB::raw('sum(fees.amount) as totalDue'), DB::raw('sum(payment_details.amount) as paid'), DB::raw('sum(payment_details.waiver) as waiver'), DB::raw('sum(fees.amount)- sum(payment_details.amount+payment_details.waiver)  as due'))
                ->groupBy('account_sectors.name')->get();
            //return $data;
        }


        return view('accounts.studentfeereport', $data);
    }
    
    // public function studentfeereport(Request $request)
    // {
    //     $school_id = Auth::user()->school->id;
    //     $data['pluckSection'] = (new Section())->getSection(true, true, true, 'classes.name');
    //     $data['head'] = AccountSector::where('type', 'income')->bySchool($school_id)->pluck('name', 'id')->prepend('All', 'all');
    //     if ($request->isMethod('post')) {
    //         $this->validate($request, [
    //             'section' => 'required|string',
    //             'student' => 'required|string',
    //             'type' => 'required|string',
    //             'from' => 'required|date',
    //             'to' => 'required|date|after_or_equal:from'
    //         ], [
    //             'to.after_or_equal' => 'The To date must be a date after or equal to From date'
    //         ]);
    //         $data['from'] = $from = $request->from;
    //         $data['to'] = $to = $request->to;
    //         $data['type'] = $type = $request->type;
    //         $data['student'] = $student = $request->student;
    //         $data['section'] = $section = $request->section;
    //         $from = date('Y-m-d H:i:s', strtotime($from));
    //         $to = date('Y-m-d 23:59:59', strtotime($to));
    //         $financialYear = active_financial_year();
    //         $data['pluckStudent'] = User::bySchool($school_id)->whereSection_id($section)->whereRole('student')->whereActive(1)->pluck('name', 'id');
    //         if ($request->type == 'all') {
    //             $heads = AccountSector::bySchool($school_id)->whereType('income')->pluck('id')->toArray();
    //         } else {
    //             $heads = AccountSector::bySchool($school_id)->whereType('income')->whereId($request->type)->pluck('id')->toArray();
    //         }

    //         $data['dues'] = Due::where([['dues.school_id', $school_id], ['dues.section_id', $request->section], ['dues.student_id', $student]])->whereIn('dues.status', [1, 2])
    //             ->leftjoin('fees', 'fees.id', 'dues.fee_id')
    //             ->leftjoin('account_sectors', 'account_sectors.id', 'fees.type')
    //             ->leftJoin('payment_details', function ($q) {
    //                 $q->on('dues.id', 'payment_details.due_id')
    //                     ->whereRaw('(CASE WHEN payment_details.amount IS NOT NULL THEN true ELSE false END)');
    //             })
    //             ->whereIn('account_sectors.id', $heads)
    //             ->where('fees.financialYear_id', $financialYear->id)
    //             ->whereBetween('fees.date', [$from, $to])
    //             ->select('dues.section_id', 'dues.student_id', 'dues.class_id', 'account_sectors.id', 'account_sectors.name', DB::raw('sum(DISTINCT fees.amount) as totalDue'), DB::raw('sum(payment_details.amount) as paid'), DB::raw('sum(payment_details.waiver) as waiver'), DB::raw('sum(DISTINCT fees.amount)- sum(payment_details.amount+payment_details.waiver)  as due'))
    //             ->groupBy('account_sectors.name')->get();
    //         //return $data;
    //     }


    //     return view('accounts.studentfeereport', $data);
    // }

    public function studentpaymentreport(Request $request)
    {


        $school_id = Auth::user()->school->id;
        $data['pluckSection'] = (new Section())->getSection(true, true, true, 'classes.name');
        $data['head'] = AccountSector::where('type', 'income')->bySchool($school_id)->pluck('name', 'id')->prepend('All', 'all');
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'section' => 'required|string',
                'student' => 'required|string',
                'type' => 'required|string',
                'from' => 'required|date',
                'to' => 'required|date|after_or_equal:from'
            ], [
                'to.after_or_equal' => 'The To date must be a date after or equal to From date'
            ]);
            $data['from'] = $from = $request->from;
            $data['to'] = $to = $request->to;
            $data['type'] = $type = $request->type;
            $data['student'] = $student = $request->student;
            $data['section'] = $section = $request->section;
            $from = date('Y-m-d H:i:s', strtotime($from));
            $to = date('Y-m-d 23:59:59', strtotime($to));
            $data['pluckStudent'] = User::bySchool($school_id)->whereSection_id($section)->whereRole('student')->whereActive(1)->pluck('name', 'id')->prepend('All', 'all');
            if ($student == 'all') {
                $students = User::bySchool($school_id)->whereRole('student')->whereActive(1)->whereSection_id($section)->pluck('id')->toArray();
            } else {
                $students = User::bySchool($school_id)->whereRole('student')->whereActive(1)->whereId($student)->whereSection_id($section)->pluck('id')->toArray();
            }
            if ($request->type == 'all') {
                $heads = AccountSector::where('account_sectors.school_id', $school_id)->where('account_sectors.type', 'income')
                    ->leftjoin('fees', 'account_sectors.id', 'fees.type')
                    ->leftjoin('dues', 'fees.id', 'dues.fee_id')
                    ->leftjoin('payment_details', 'dues.id', 'payment_details.due_id')
                    ->select('account_sectors.id', 'account_sectors.name')->groupBy('account_sectors.name')
                    ->get();
            } else {
                $heads = AccountSector::where('account_sectors.school_id', $school_id)->where('account_sectors.type', 'income')->where('account_sectors.id', $type)
                    ->leftjoin('fees', 'account_sectors.id', 'fees.type')
                    ->leftjoin('dues', 'fees.id', 'dues.fee_id')
                    ->leftjoin('payment_details', 'dues.id', 'payment_details.due_id')
                    ->select('account_sectors.id', 'account_sectors.name')->groupBy('account_sectors.name')
                    ->get();
            }
            $pluckHead = $heads->pluck('id')->toArray();
            $sql = self::stuPaymentQuery($students, $pluckHead, $from, $to);
            $sql->selectRaw("student.student_code as 'Student ID',student.name as 'Student Name',student.phone_number as 'Phone',payments.reciept_number as 'Money Receipt',date(payments.trans_date) as 'Payment Date'");
            foreach ($heads as $head) {
                $sql->selectRaw("GROUP_CONCAT(if(fees.type = '" . $head->id . "', (payment_details.amount+payment_details.waiver), null)) AS '" . $head->name . "'");
            }
            $sql->selectRaw("sum((payment_details.amount+payment_details.waiver)) as Receivable,sum(payment_details.waiver) as Waiver,sum(payment_details.amount) as Received,CASE WHEN payments.payment_type = 1 THEN 'Cash' ELSE (CASE WHEN payments.payment_type = 2 THEN 'SSLCommerz' ELSE (CASE WHEN payments.payment_type = 3 THEN 'Stripe' ELSE (CASE WHEN payments.payment_type = 4 THEN 'Paypal' ELSE NULL END) END) END) END as 'Payment Type',users.name as User")
                ->groupBy('dues.student_id', 'payment_details.payment_id')->orderBy('student.student_code');
            $data['payments'] = $sql->get();
            $totalSums = self::stuPaymentQuery($students, $pluckHead, $from, $to, true)
                ->selectRaw("account_sectors.name,SUM(payment_details.amount+payment_details.waiver) AS total")->groupBy('account_sectors.name')->orderBy('account_sectors.name')->get();
            $data['totalSums'] = $totalSums;
        }
        return view('accounts.studentpaymentreport', $data);
    }

    protected function stuPaymentQuery($students, $heads, $from, $to, $whereIn = false)
    {
        $school_id = Auth::user()->school->id;
        $financialYear = active_financial_year();
        $sql = DBConnection()->table('account_sectors')
            ->leftjoin('fees', 'account_sectors.id', 'fees.type')
            ->leftjoin('dues', 'fees.id', 'dues.fee_id')
            ->leftjoin('payment_details', function ($q) use ($from, $to, $students, $whereIn) {
                $q->on('dues.id', 'payment_details.due_id')
                    ->leftjoin('payments', 'payments.id', 'payment_details.payment_id')
                    ->leftjoin('users as student', 'payments.student_id', 'student.id')
                    ->leftjoin('users', 'payments.user_id', 'users.id')
                    ->whereBetween('payments.trans_date', [$from, $to]);
                if ($whereIn) {
                    $q->whereIn('payments.student_id', $students);
                }
            })
            ->where('fees.financialYear_id', $financialYear->id)
            ->where('account_sectors.school_id', $school_id)
            ->where('account_sectors.type', 'income');
        if ($heads)
            $sql->whereIn('account_sectors.id', $heads);
        if ($whereIn == false) {
            $sql->whereIn('payments.student_id', $students);
        }
        return $sql;
    }

    public function expensereport(Request $request)
    {
        $school_id = Auth::user()->school->id;
        $data = array();
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'from' => 'required|date',
                'to' => 'required|date|after_or_equal:from'
            ], [
                'to.after_or_equal' => 'The To date must be a date after or equal to From date'
            ]);
            $data['from'] = $from = $request->from;
            $data['to'] = $to = $request->to;
            $from = date('Y-m-d', strtotime($from));
            $to = date('Y-m-d', strtotime($to));
            $heads = self::ExpenseQuery($from, $to)->select('account_sectors.id', 'account_sectors.name')->orderBy('account_sectors.name')->get();
            $query = self::ExpenseQuery($from, $to)->selectRaw('DATE_FORMAT(expenses.date, "%d-%m-%Y") as Date');
            foreach ($heads as $head) {
                $query->selectRaw("GROUP_CONCAT(if(expenses.account_sector_id = '" . $head->id . "', expenses.amount, null)) AS '" . $head->name . "'");
            }
            $data['expenses'] = $query->orderBy('expenses.date')->groupByRaw('date(expenses.date)')->get();
            $data['totals'] = self::ExpenseQuery($from, $to)->selectRaw("SUM(expenses.amount) AS total")->groupBy('account_sectors.id')->orderBy('account_sectors.name')->get();
        }
        return view('accounts.expense-report', $data);
    }

    protected function ExpenseQuery($from, $to)
    {
        $school_id = Auth::user()->school_id;
        $financialYear = active_financial_year();
        $query = DBConnection()->table('account_sectors')
            ->join('expenses', 'expenses.account_sector_id', 'account_sectors.id')
            ->whereBetween('expenses.date', [$from, $to])->where('expenses.school_id', $school_id)
            ->where('expenses.financialYear_id', $financialYear->id)
            ->where('account_sectors.type', 'expense');
        return $query;
    }

    public function incomeexpense(Request $request)
    {
        $school_id = Auth::user()->school_id;
        $ledgers = Ledger::bySchool(Auth::user()->school_id)->get()->groupBy('ac_group');
//        $ledgers2 = Ledger::bySchool(Auth::user()->school_id)->get()->groupBy('ac_group');

        $data = array();
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'from' => 'required|date',
                'to' => 'required|date'
            ]);

            $from = date('Y-m-d', strtotime($request->from));
            $to = date('Y-m-d', strtotime($request->to));
            $financialYear = active_financial_year();
            $data['allIncPayEx'] = Ledger::with(['income' => function($inc) use ($from,$to,$financialYear){
                return $inc->whereBetween('date', [\Carbon\Carbon::parse($from)->format('Y-m-d'), \Carbon\Carbon::parse($to)->format('Y-m-d')])->where('incomes.financialYear_id', $financialYear->id);
            },'payment' => function($ex) use ($from,$to){
                return $ex->whereBetween('trans_date', [\Carbon\Carbon::parse($from)->format('Y-m-d'), \Carbon\Carbon::parse($to)->format('Y-m-d')])->where('payments.trans_status','=', 'Paid');
            },'expense' => function($ex) use ($from,$to,$financialYear){
                return $ex->whereBetween('date', [\Carbon\Carbon::parse($from)->format('Y-m-d'), \Carbon\Carbon::parse($to)->format('Y-m-d')])->where('expenses.financialYear_id', $financialYear->id);
            }])->get();


            $data['payresives'] = PayReceiv::whereBetween('date', [\Carbon\Carbon::parse($from)->format('Y-m-d'), \Carbon\Carbon::parse($to)->format('Y-m-d')])->where('financialYear_id','=',$financialYear->id)->get();

//            $data['internalTransfers'] = InternalTransfer::whereBetween('date', [\Carbon\Carbon::parse($from)->format('Y-m-d'), \Carbon\Carbon::parse($to)->format('Y-m-d')])->where('financialYear_id','=',$financialYear->id)->get();
            $data['internalTransfersCr'] = InternalTransfer::where('financialYear_id','=',$financialYear->id)->
            selectRaw('ledger_id_credit, sum(internal_transfers.amount) as amountc')
                ->orderByDesc('amount')->groupBy('internal_transfers.ledger_id_credit')
                ->get();

            $data['internalTransfersDa'] = InternalTransfer::where('financialYear_id','=',$financialYear->id)
                ->selectRaw('ledger_id_david, sum(internal_transfers.amount) as amountd')
                ->orderByDesc('amount')->groupBy('internal_transfers.ledger_id_david')
                ->get();

            $data['memberfee'] = Membership::whereRaw(
                "(created_at >= ? AND updated_at <= ?)",
                [
                    $from ." 00:00:00",
                    $to ." 23:59:59"
                ]
            )->get();

//            $toatal = PaymentDetail::all();
//
//            return $toatal->sum('amount');












            $data["income"] = AccountSector::where('account_sectors.school_id', $school_id)->where('account_sectors.type', 'income')
                ->leftJoin('fees', 'account_sectors.id', 'fees.type')
                ->leftJoin('dues', 'fees.id', 'dues.fee_id')
                ->leftJoin('payment_details', function ($q) use ($request, $from, $to) {
                    $q->on('dues.id', 'payment_details.due_id')
                        ->join('payments', function ($subq) use ($request, $from, $to) {
                            $subq->on('payment_details.payment_id', 'payments.id')
                                ->whereBetween(DB::raw('date(payments.trans_date)'), [$from, $to]);
                        });
                })
                ->where('fees.financialYear_id', $financialYear->id)
                ->selectRaw('account_sectors.name,account_sectors.type, sum(payment_details.amount) as amount, account_sectors.id')
                ->orderByDesc('amount')->groupBy('account_sectors.id')
                ->get();

//            return $income->sum('amount');




            $data["expense"] = AccountSector::where('account_sectors.school_id', $school_id)->selectRaw('sum(expenses.amount) as expensesAmount, account_sectors.name')
                ->leftJoin('expenses', function ($subq) use ($request, $from, $to) {
                    $subq->on('account_sectors.id', 'expenses.account_sector_id')
                        ->whereBetween(DB::raw('date(expenses.date)'), [$from, $to]);
                })
                ->where('expenses.financialYear_id', $financialYear->id)
                ->where('account_sectors.type', 'expense')
                ->groupBy('account_sectors.id')
                ->get();
            $data['from'] = $request->from;
            $data['to'] = $request->to;

            $data["incomepey"] = AccountSector::where('account_sectors.school_id', $school_id)->selectRaw('sum(incomes.amount) as incomeAmount, account_sectors.name')
                ->leftJoin('incomes', function ($subq) use ($request, $from, $to) {
                    $subq->on('account_sectors.id', 'incomes.account_sector_id')
                        ->whereBetween(DB::raw('date(incomes.date)'), [$from, $to]);
                })
                ->where('incomes.financialYear_id', $financialYear->id)
                ->where('account_sectors.type', 'income')
                ->groupBy('account_sectors.id')
                ->get();
//            $totalincomepay->sum('incomeAmount');
            $data['from'] = $request->from;
            $data['to'] = $request->to;
        }

        $data['setnotes'] = Set_notes::find(1);

        return view('accounts.income-expense', $data,compact('ledgers'));
    }

    public function ac_statement()
    {
        $user = $this->user->find(\auth()->user()->id);
        if (empty($user))
            return abort('404');

        return view('students.ac_statement', compact('user'));
    }

    public function monthlyreport(Request $request)
    {
        $school_id = Auth::user()->school->id;
        $data['pluckSection'] = (new Section())->getSection(true, true, true, 'classes.name');
        $data['head'] = AccountSector::where('type', 'income')->bySchool($school_id)->pluck('name', 'id')->prepend('All', 'all');
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'section' => 'required|string',
                'student' => 'required|string',
                'year' => 'required|digits:4|integer|min:1900',
            ]);
            $data['year'] = $year = $request->year;
            $data['student'] = $student = $request->student;
            $data['section'] = $section = $request->section;
            $students = User::bySchool($school_id)->student()->active()->whereSection_id($section);
            $data['pluckStudent'] = $students->pluck('name', 'id')->prepend('All', 'all');
            if ($student != 'all') {
                $students = $students->whereId($student);
            }
            $students = $students->pluck('id')->toArray();
            $data['from'] = $from = date($year . '-01-01');
            $data['to'] = $to = date($year . '-12-31');
            $sql = self::stuPaymentQuery($students, false, $from, $to);
            $sql->selectRaw("student.student_code as 'Student ID',student.name as 'Student Name',student.phone_number as 'Phone',student.id as 'Total Due',SUM(payment_details.amount+payment_details.waiver) AS 'Total Paid'");
            $data['payments'] = $sql->groupBy('student.student_code')->orderBy('student.student_code')->get();
        }
        return view('accounts.monthlyreport', $data);
    }
}
