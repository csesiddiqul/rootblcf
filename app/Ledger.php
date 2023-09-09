<?php

namespace App;


class Ledger extends Model
{
    protected $table = 'ledgers';
    protected $fillable = ['name', 'ac_group', 'description', 'school_id', 'user_id', 'current_balance'];

    public function school()
    {
        return $this->belongsTo('App\School', 'school_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function account_report()
    {
        return $this->hasMany('App\AccountReport', 'ledger_id', 'id');
    }

    public function payment()
    {
        return $this->hasMany(Payment::class, 'ledger_id', 'id');
    }

    public function income()
    {
        return $this->hasMany(Income::class, 'ledger_id', 'id');
    }

    public function expense()
    {
        return $this->hasMany(Expense::class, 'ledger_id', 'id');
    }
}
