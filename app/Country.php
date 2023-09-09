<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    public function school()
    {
        return $this->hasOne('App\School', 'id');
    }

    public function state()
    {
        return $this->hasMany('App\State', 'id');
    }
}
