<?php

namespace App;

use App\Model;

class Attendance extends Model
{
    protected $fillable = ['school_id', 'student_id', 'date', 'user_id', 'exam_id', 'section_id', 'present','remark'];

    /**
     * Get the student record associated with the user.
     */
    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function student()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the section record associated with the attendance.
     */
    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    /**
     * Get the exam record associated with the attendance.
     */
    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'student_id', 'id');
    }
}
