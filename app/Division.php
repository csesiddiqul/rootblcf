<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table = 'divisions';
    protected $fillable = ['name', 'status'];

    public function district()
    {
        return $this->hasMany('App\District', 'id');
    }

    public function thana()
    {
        return $this->hasMany('App\Thana', 'id');
    }

    public function pluckDivision()
    {
        $division = $this::pluck('name', 'id')->sortBy('name')->map(function ($value) {
            $localLang = session('localLang') ?? localLang();
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
        return $division;
    }
}
