<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    protected $fillable = ['division_id', 'name', 'status'];

    public function division()
    {
        return $this->belongsTo('App\Division', 'division_id');
    }

    public function thana()
    {
        return $this->hasMany('App\Thana', 'id');
    }

    public function pluckDistrict($division_id)
    {
        $district = $this::whereDivision_id($division_id)->pluck('name', 'id')->sortBy('name')->map(function ($value) {
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
        return $district;
    }
}
