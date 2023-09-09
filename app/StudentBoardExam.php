<?php

namespace App;

use App\Model;

class StudentBoardExam extends Model
{
    protected $table = 'student_board_exams';
    protected $fillable = ['group', 'roll','school_id','exam_name','student_id','registration','session','board','passing_year','institution_name','gpa','user_id','out_of_gpa'];

    /**
     * Get the student record associated with the user.
     */
    public function student()
    {
        return $this->belongsTo('App\User');
    }
}
