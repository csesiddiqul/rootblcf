<?php

namespace App;

use App\Model;

class PaymentDetail extends Model
{
    protected $table = 'payment_details';
    protected $fillable = ['due_id', 'amount', 'waiver', 'payment_id', 'month', 'month_des'];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }

    public function due()
    {
        return $this->belongsTo(Due::class, 'due_id', 'id');
    }
}
