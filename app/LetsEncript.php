<?php

namespace App;

use App\Model;

class LetsEncript extends Model
{
    protected $table = 'lets_encripts';
    protected $fillable = ['school_id', 'domain', 'initialIp', 'account_id', 'order_id', 'status'];

    public function school()
    {
        return $this->belongsTo('App\LetsEncript', 'school_id', 'id');
    }
}
