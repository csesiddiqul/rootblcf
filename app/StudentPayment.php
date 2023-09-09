<?php

namespace App;

use App\Model;

class StudentPayment extends Model
{
    protected $fillable = ['school_id', 'student_id', 'trans_number', 'stripe_charge', 'trans_id', 'trans_date', 'fee_pay', 'trans_type', 'trans_status', 'amount', 'stripe_fee', 'currency', 'card_type'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
}
