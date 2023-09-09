<?php

namespace App\Services\Account;

use App\Income;
use App\Ledger;
use App\AccountReport;
use App\AccountSector;
use App\Expense;
use function auth;

// use App\Myclass;
// use App\Section;
// use App\User;
class AccountService
{

    public $account_type;
    public $request;

    public function getSectorsBySchoolId()
    {
        return AccountSector::where('school_id', auth()->user()->school_id)->get()->groupBy('type');
    }

    public function getAccountsBySchoolId()
    {
        return Ledger::where('school_id', auth()->user()->school_id)
            ->get()->groupBy('ac_group');
    }

    public function storeSector($storeData)
    {
        $school_id = auth()->user()->school_id;
        $sector = AccountSector::create([
            'name' => $storeData['name'],
            'type' => $storeData['type'],
            'school_id' => $school_id,
            'user_id' => auth()->id(),
        ]);
        $financial_year = current_financial_year();
        AccountReport::create([
            'school_id' => $school_id,
            'financialYear_id' => $financial_year->id,
            'head_id' => $sector->id,
            'ledger_id' => $storeData['ledger_id'],
            'op_balance' => $storeData['op_balance'],
            'op_date' => date('Y-m-d')
        ]);
        $ledger = Ledger::find($storeData['ledger_id']);
        $ledger->update(['current_balance' => ($ledger->current_balance + $storeData['op_balance'])]);
    }

    public function updateSector(AccountSector $accountSector, $updateData)
    {
        $accountSector->update($updateData);
    }

    // public function getClassIds(){
    //     return Myclass::where('school_id', \Auth::user()->school_id)
    //                         ->pluck('id');
    // }
    // public function getSectionsIds(){
    //     $classes = $this->getClassIds()->toArray();
    //     return Section::with('class')
    //                         ->whereIn('class_id', $classes)
    //                         ->get();
    // }
    // public function getStudentsBySectionIds(){
    //     $sections = $this->getSectionsIds();
    //     return User::whereIn('section_id',$sections->pluck('id')->toArray())
    //                       ->get();
    // }
    public function storeLedger()
    {
        $income = new Ledger();
        $income->name = $this->request->name;
        $income->ac_group = $this->request->ac_group;
        $income->current_balance = $this->request->current_balance ?? 0;
        $income->description = $this->request->description;
        $income->school_id = auth()->user()->school_id;
        $income->user_id = auth()->user()->id;
        $income->save();
    }

    public function getAccountsByYear()
    {
        return Ledger::where('school_id', auth()->user()->school_id)
            ->where('type', $this->account_type)
            ->whereYear('created_at', $this->request->year)
            ->get();
    }

    public function getExpensesByYear()
    {
        $financialYear = active_financial_year();
        return Expense::whereHas('accountSector', function ($q) {
            $q->where('type', $this->account_type);
        })
            ->where('school_id', auth()->user()->school_id)
            ->where('financialYear_id', $financialYear->id)
            ->whereYear('date', $this->request->year ?? date('Y'))
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function getIncomeByYear()
    {
        $financialYear = active_financial_year();
        return Income::whereHas('accountSector', function ($q) {
            $q->where('type', $this->account_type);
        })
            ->where('school_id', auth()->user()->school_id)
            ->where('financialYear_id', $financialYear->id)
            ->whereYear('date', $this->request->year ?? date('Y'))
            ->orderBy('created_at', 'DESC')
            ->get();
    }


    public function updateLedger()
    {
        $account = Ledger::find($this->request->id);
        $account->name = $this->request->name;
        $account->ac_group = $this->request->ac_group;
        $account->description = $this->request->description;
        $account->save();
    }
}
