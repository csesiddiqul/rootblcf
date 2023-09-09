<?php

namespace App;

use App\Model;

class Subscription extends Model
{
    protected $fillable = ['user_id','school_id', 'school_payment_id', 'month', 'quantity', 'price', 'rangeFrom', 'rangeTo'];

    public function schoolPayment()
    {
        return $this->belongsTo(SchoolPayment::class, 'school_payment_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
