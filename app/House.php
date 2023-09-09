<?php

namespace App;

use App\Model;

class House extends Model
{
    protected $fillable = ['school_id', 'name', 'description', 'status'];

    public function studentInfo()
    {
        return $this->hasMany(StudentInfo::class, 'house_id', 'id');
    }
}
