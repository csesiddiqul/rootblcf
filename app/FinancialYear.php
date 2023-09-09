<?php

namespace App;


class FinancialYear extends Model
{
    protected $fillable = ['school_id', 'name', 'from_date', 'to_date', 'is_close', 'status'];

    public function school()
    {
        return $this->belongsTo('App\School', 'school_id', 'id');
    }

    public function account_report()
    {
        return $this->hasMany('App\FinancialYear', 'financialYear_id', 'id');
    }

    public function fee()
    {
        return $this->hasMany('App\Fee', 'financialYear_id', 'id');
    }

    public function expense()
    {
        return $this->hasMany(Expense::class, 'financialYear_id', 'id');
    }
}
