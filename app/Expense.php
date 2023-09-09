<?php

namespace App;

class Expense extends Model
{
    protected $fillable = ['school_id', 'user_id', 'account_sector_id', 'financialYear_id', 'ledger_id', 'name', 'voucher_no', 'invoice_number', 'date', 'file', 'amount', 'description'];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function accountSector()
    {
        return $this->belongsTo(AccountSector::class, 'account_sector_id', 'id');
    }

    public function financialYear()
    {
        return $this->belongsTo(FinancialYear::class, 'financialYear_id', 'id');
    }

    public function ledger()
    {
        return $this->belongsTo(Ledger::class, 'ledger_id', 'id');
    }
}
