<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    protected $table = 'resellers';
    protected $fillable = ['name', 'address', 'email', 'phone', 'ssl_store_id', 'ssl_store_pass', 'bkash_merchant_id', 'logo'];

    public function school()
    {
        return $this->hasMany(School::class, 'reseller_id', 'id');
    }
}
