<?php

namespace App;

use App\Model;

class CourseGroup extends Model
{
    protected $fillable = ['name', 'description', 'status', 'course', 'optional', 'countiAss', 'school_id'];

    public function course()
    {
        return $this->belongsTo('App\Course', 'course');
    }

    public function studentInfo()
    {
        return $this->hasMany(StudentInfo::class, 'coursegroup_id', 'id');
    }
}
