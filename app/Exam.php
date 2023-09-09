<?php

namespace App;

use App\Model;
use Illuminate\Support\Facades\Auth;

class Exam extends Model
{
    public function course_config()
    {
        return $this->hasMany(CourseConfig::class, 'exam_id', 'id');
    }

    public function attendance()
    {
        return $this->hasMany('App\attendance', 'exam_id', 'id');
    }

    public function courseAttendance()
    {
        return $this->hasMany('App\CourseAttendance', 'exam_id', 'id');
    }

    public function session()
    {
        return $this->belongsTo('App\Session', 'session_id', 'id');
    }

    public function getExam($active = false, $pluck = false, $sort = false, $sortBy = 'ASC')
    {
        $session = currentSession();
        $school_id = Auth::guest() ? school('id') : Auth::user()->school_id;
        $exam = self::bySchool($school_id)->where('session_id', $session->id);
        if ($active) {
            $exam = $exam->whereActive($active);
        }
        if ($sort) {
            $exam = $exam->orderBy($sort, $sortBy);
        }
        if ($pluck) {
            $exam = $exam->pluck('exam_name', 'id');
        } else {
            $exam = $exam->get();
        }
        return $exam;

    }
}
