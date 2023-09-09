<?php

namespace App;

use App\Model;

class Session extends Model
{
    protected $fillable = ['schoolyear', 'starttime', 'endtime', 'status', 'school_id'];

    public function studentInfo()
    {
        return $this->hasMany(StudentInfo::class, 'session', 'id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function exam()
    {
        return $this->hasMany('App\Exam', 'session_id', 'id');
    }
}
