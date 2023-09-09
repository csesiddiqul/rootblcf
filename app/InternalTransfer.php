<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternalTransfer extends Model
{
    protected $fillable = ['school_id', 'user_id', 'account_sector_id', 'financialYear_id', 'ledger_id', 'ledger_id_credit','ledger_id_david', 'voucher_no', 'date',  'amount', 'description'];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function financialYear()
    {
        return $this->belongsTo(FinancialYear::class, 'financialYear_id', 'id');
    }

    public function ledgerCredit()
    {
        return $this->belongsTo(Ledger::class, 'ledger_id_credit', 'id');
    }

    public function ledgerDebit()
    {
        return $this->belongsTo(Ledger::class, 'ledger_id_david', 'id');
    }
}
