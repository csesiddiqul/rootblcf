<?php

namespace App;

use App\Model;

class Myclass extends Model
{
    protected $table = "classes";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class_number', 'group', 'school_id', 'status'
    ];

    /**
     * Get the school record associated with the user.
     */
    public function school()
    {
        return $this->belongsTo('App\School', 'school_id', 'id');
    }

    public function sections()
    {
        return $this->hasMany('App\Section', 'class_id', 'id');
    }

    public function fees()
    {
        return $this->hasMany('App\Fee', 'class_id', 'id');
    }

    public function admissions()
    {
        return $this->hasMany('App\Admission', 'class_id', 'id');
    }

    // public function exam()
    // {
    //     return $this->belongsTo('App\ExamForClass');
    // }

    public function books()
    {
        return $this->hasMany('App\Book', 'class_id', 'id');
    }
}
