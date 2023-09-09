<?php

namespace App\Http\Controllers;

use App\AccountSector;
use App\InternalTransfer;
use App\Ledger;
use App\Membership;
use App\PayReceiv;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrialBalanceController extends Controller
{
    public function AllDataTrialBl(Request $request){




        $school_id = Auth::user()->school_id;

        $ledgers = Ledger::bySchool(Auth::user()->school_id)->get()->groupBy('ac_group');
//        $ledgers2 = Ledger::bySchool(Auth::user()->school_id)->get()->groupBy('ac_group');

        $data = array();


////        $from = '2022-04-01';
////        $to = '2023-04-30';
//        01-01-2022
//        2022-01-01

        $from = Carbon::parse($request->from)->format('Y-m-d');
        $to = Carbon::parse($request->to)->format('Y-m-d');;

        $financialYear = active_financial_year();



        $data['allIncPayEx'] =   Ledger::with(['income' => function($inc) use ($from,$to,$financialYear){

            return $inc->whereBetween('date', [\Carbon\Carbon::parse($from)->format('Y-m-d'), \Carbon\Carbon::parse($to)->format('Y-m-d')])->where('incomes.financialYear_id', $financialYear->id);
        },'payment' => function($ex) use ($from,$to){
            return $ex->whereBetween('trans_date', [\Carbon\Carbon::parse($from)->format('Y-m-d'), \Carbon\Carbon::parse($to)->format('Y-m-d')])->where('payments.trans_status','=', 'Paid');
        },'expense' => function($ex) use ($from,$to,$financialYear){
            return $ex->whereBetween('date', [\Carbon\Carbon::parse($from)->format('Y-m-d'), \Carbon\Carbon::parse($to)->format('Y-m-d')])->where('expenses.financialYear_id', $financialYear->id);
        }])->get();



        $data["incomes"] = AccountSector::where('account_sectors.school_id', $school_id)->where('account_sectors.type', 'income')
            ->leftJoin('fees', 'account_sectors.id', 'fees.type')
            ->leftJoin('dues', 'fees.id', 'dues.fee_id')
            ->leftJoin('payment_details', function ($q) use ($from, $to) {
                $q->on('dues.id', 'payment_details.due_id')
                    ->join('payments', function ($subq) use ($from, $to) {
                        $subq->on('payment_details.payment_id', 'payments.id')
                            ->whereBetween(DB::raw('date(payments.trans_date)'), [$from, $to]);
                    });
            })
            ->where('fees.financialYear_id', $financialYear->id)
            ->selectRaw('account_sectors.name,account_sectors.type, sum(payment_details.amount) as amount, account_sectors.id')
            ->orderByDesc('amount')->groupBy('account_sectors.id')
            ->get();


        $data["expense"] = AccountSector::where('account_sectors.school_id', $school_id)->selectRaw('sum(expenses.amount) as expensesAmount, account_sectors.name')
            ->leftJoin('expenses', function ($subq) use ($from, $to) {
                $subq->on('account_sectors.id', 'expenses.account_sector_id')
                    ->whereBetween(DB::raw('date(expenses.date)'), [$from, $to]);
            })
            ->where('expenses.financialYear_id', $financialYear->id)
            ->where('account_sectors.type', 'expense')
            ->groupBy('account_sectors.id')
            ->get();

        $data["incomepey"] = AccountSector::where('account_sectors.school_id', $school_id)->selectRaw('sum(incomes.amount) as incomeAmount, account_sectors.name')
            ->leftJoin('incomes', function ($subq) use ($from, $to) {
                $subq->on('account_sectors.id', 'incomes.account_sector_id')
                    ->whereBetween(DB::raw('date(incomes.date)'), [$from, $to]);
            })
            ->where('incomes.financialYear_id', $financialYear->id)
            ->where('account_sectors.type', 'income')
            ->groupBy('account_sectors.id')
            ->get();

        return view('accounts.trial_balance.trialBalance',$data);
    }
}
