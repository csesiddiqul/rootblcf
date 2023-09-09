<?php

namespace App;

use App\Model;

class ExamComment extends Model
{
    protected $fillable = ['school_id', 'exam_id', 'student_id', 'comment'];

    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }

    public function student()
    {
        return $this->belongsTo('App\User');
    }
}
