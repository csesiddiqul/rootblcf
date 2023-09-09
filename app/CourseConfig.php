<?php

namespace App;

use App\Model;

class CourseConfig extends Model
{
    protected $table = 'course_configs';
    protected $fillable = ['school_id', 'session_id', 'class_id', 'section_id', 'course_id', 'teacher_id', 'exam_id', 'user_id', 'grade_system_name', 'quiz_count', 'assignment_count', 'ct_count', 'quiz_percent', 'attendance_percent', 'assignment_percent', 'ct_percent', 'final_exam_percent', 'practical_percent', 'att_fullmark', 'quiz_fullmark', 'a_fullmark', 'ct_fullmark', 'final_fullmark', 'practical_fullmark'];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(Myclass::class, 'class_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

    public function grade()
    {
        return $this->hasMany(Grade::class, 'course_id', 'id');
    }

    public function gradeSystem()
    {
        return $this->belongsTo(Gradesystem::class, 'grade_system_name', 'grade_system_name');
    }

    public function gradeSystemMany($id)
    {
        $course_config = self::find($id);
        $gradeSystem = Gradesystem::bySchool(school('id'))->where('grade_system_name', $course_config->grade_system_name)->get();
        return $gradeSystem;
    }


}
