<?php

namespace App;

use App\Model;

class Department extends Model
{
    protected $table = 'departments';
    protected $fillable = ['school_id', 'department_name','status'];

    public function teachers()
    {
        return $this->hasMany('App\User', 'department_id','id');
    }
    public function students()
    {
        return $this->hasMany('App\User', 'department_id','id');
    }
}
