<?php

namespace App;

use App\Model;

class SchoolPayment extends Model
{
    protected $fillable = ['school_id', 'user_id', 'trans_number', 'stripe_charge', 'trans_id', 'trans_date', 'trans_type', 'trans_status', 'amount', 'stripe_fee', 'currency', 'card_type', 'purpose_id', 'agentcode', 'ref_number', 'month', 'rangeFrom', 'rangeTo', 'shareOf', 'percentTk', 'pStatus', 'tranCheque', 'sNote'];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function subscription()
    {
        return $this->hasMany('App\Subscription');
    }

    public function myfunctioncreate($data)
    {

    }
}
