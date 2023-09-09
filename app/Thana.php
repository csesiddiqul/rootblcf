<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    protected $table = 'thanas';
    protected $fillable = ['division_id','district_id','name','status'];

    public function division()
    {
        return $this->belongsTo('App\Division','division_id');
    }

    public function district()
    {
        return $this->belongsTo('App\District','district_id');
    }
    public function pluckThana($district_id)
    {
        $thanas = $this::whereDistrict_id($district_id)->pluck('name', 'id')->sortBy('name')->map(function ($value) {
            $localLang = session('localLang');
            if ($localLang == 'bn') {
                if ($value == 'Dhaka') {
                    return trans($value, [], $localLang);
                } else {
                    return transMsg($value);
                }
            } elseif ($localLang == 'en') {
                return $value;
            } else {
                return transMsg($value);
            }
        });
        return $thanas;
    }
}
