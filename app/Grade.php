<?php

namespace App;

use App\Model;
use Illuminate\Support\Facades\Auth;

class Grade extends Model
{
    /**
     * Get the course record associated with the user.
     */
    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function course_config()
    {
        return $this->belongsTo(CourseConfig::class, 'course_id', 'id');
    }

    /**
     * Get the student record associated with the user.
     */
    public function student()
    {
        return $this->belongsTo(User::class,'student_id','id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the teacher record associated with the user.
     */
    public function teacher()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the exam name record associated with the exam.
     */
    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }

    public function gradeSystem()
    {
        return $this->belongsTo(Gradesystem::class, 'grade_system_name', 'id');
    }
}
