<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsHistory extends Model
{
    protected $fillable = [
        'school_id', 'sms_count', 'reset_date'
    ];
}
