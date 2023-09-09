<?php

namespace App;

class AccountSector extends Model
{

    protected $table = 'account_sectors';
    protected $fillable = ['name', 'type', 'school_id', 'user_id'];

    public function school()
    {
        return $this->belongsTo('App\School', 'school_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function fees()
    {
        return $this->hasMany('App\Fee', 'type');
    }

    public function expense()
    {
        return $this->hasMany(Expense::class, 'account_sector_id', 'id');
    }

    public function financial_year()
    {
        return $this->hasMany('App\AccountReport', 'head_id', 'id');
    }
}
