<?php

namespace App;

use App\Model;

class AdmissionPayment extends Model
{
    protected $fillable = ['school_id', 'admission_id', 'trans_number', 'stripe_charge', 'trans_id', 'trans_date', 'fee_pay', 'trans_type', 'trans_status', 'amount', 'stripe_fee', 'currency', 'card_type'];

    public function admission()
    {
        return $this->belongsTo('App\Admission', 'admission_id', 'id');
    }
}
