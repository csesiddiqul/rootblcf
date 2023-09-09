<?php

namespace App;

use App\Model;

class StudentInfo extends Model
{
    protected $table = 'student_infos';
    protected $fillable = ['student_id', 'coursegroup_id'];

    /**
     * Get the student record associated with the user.
     */
    public function student()
    {
        return $this->belongsTo('App\User', 'student_id', 'id');
    }

    public function sessions()
    {
        return $this->belongsTo(Session::class, 'session', 'id');
    }

    public function course_group()
    {
        return $this->belongsTo(CourseGroup::class, 'coursegroup_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function house()
    {
        return $this->belongsTo(House::class, 'house_id', 'id');
    }

    public function thana()
    {
        return $this->belongsTo(Thana::class, 'present_thana', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'present_district', 'id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'present_division', 'id');
    }

    public function p_thana()
    {
        return $this->belongsTo(Thana::class, 'permanent_thana', 'id');
    }

    public function p_district()
    {
        return $this->belongsTo(District::class, 'permanent_district', 'id');
    }

    public function p_division()
    {
        return $this->belongsTo(Division::class, 'permanent_division', 'id');
    }
}
