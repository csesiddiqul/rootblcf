<?php

namespace App;


use Carbon\Carbon;

class AccountReport extends Model
{
    protected $fillable = ['school_id', 'financialYear_id', 'head_id', 'ledger_id', 'op_balance', 'cl_balance', 'op_date', 'cl_date'];

    public function school()
    {
        return $this->belongsTo('App\School', 'school_id', 'id');
    }

    public function financialYear()
    {
        return $this->belongsTo('App\FinancialYear', 'financialYear_id', 'id');
    }

    public function account_sector()
    {
        return $this->belongsTo('App\AccountSector', 'head_id', 'id');
    }

    public function ledger()
    {
        return $this->belongsTo('App\Ledger', 'ledger_id', 'id');
    }

    public function dailyCalculations()
    {
        $school_id = school('id');
        $heads = AccountSector::bySchool($school_id)->where('type', 'income')->get();
        foreach ($heads as $head) {
            $credit = 0;
            $carbon_yesterday = Carbon::yesterday();
            $yesterday = $carbon_yesterday->format('Y-m-d');
            $payment = Payment::bySchool($school_id)->whereHas('paymentDetail', function ($q) use ($head) {
                $q->whereHas('due', function ($subq) use ($head) {
                    $subq->whereHas('fee', function ($subq1) use ($head) {
                        $subq1->where('type', $head->id);
                    });
                });
            })->whereDate('trans_date', $yesterday)->get();
            if ($payment->count())
                $credit = $payment->sum('total') - $payment->sum('waiver');
            $account_report = self::bySchool($school_id)->where('head_id', $head->id)->orderByDesc('created_at')->first();
            $closing_balance = $credit + $account_report->op_balance;
            $account_report->update(['cl_balance' => $closing_balance, 'cl_date' => $yesterday]);
            $today = $carbon_yesterday->addDay(1)->format('Y-m-d');
            $financial_year = current_financial_year();
            if ($financial_year) {
                self::create([
                    'school_id' => $school_id,
                    'financialYear_id' => $financial_year->id,
                    'head_id' => $head->id,
                    'ledger_id' => $account_report->ledger_id,
                    'op_balance' => $closing_balance,
                    'op_date' => $today
                ]);
            }
        }
        $heads = AccountSector::bySchool($school_id)->where('type', 'expense')->get();
        foreach ($heads as $head) {
            $carbon_yesterday = Carbon::yesterday();
            $yesterday = $carbon_yesterday->format('Y-m-d');
            $debit = Expense::bySchool($school_id)->where('account_sector_id', $head->id)->whereDate('date', $yesterday)->sum('amount');
            $account_report = self::bySchool($school_id)->where('head_id', $head->id)->orderByDesc('created_at')->first();
            if ($account_report) {
                $closing_balance = $account_report->op_balance - $debit;
                $account_report->update(['cl_balance' => $closing_balance, 'cl_date' => $yesterday]);
                $today = $carbon_yesterday->addDay(1)->format('Y-m-d');
                $financial_year = current_financial_year();
                if ($financial_year) {
                    self::create([
                        'school_id' => $school_id,
                        'financialYear_id' => $financial_year->id,
                        'head_id' => $head->id,
                        'ledger_id' => $account_report->ledger_id,
                        'op_balance' => $closing_balance,
                        'op_date' => $today
                    ]);
                }
            }
        }
    }
}
