<?php

namespace App;

use App\Model;
use Illuminate\Support\Facades\Auth;

class Section extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section_number', 'room_number', 'class_id', 'user_id', 'status', 'add_amount', 'add_total', 'lottery', 'lottery_on_mark', 'lottery_sms', 'waiting_1', 'waiting_2', 'waiting_3'
    ];

    /**
     * Get the class record associated with the user.
     */
    public function admissions()
    {
        return $this->hasMany('App\Admission', 'section_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo('App\Myclass', 'class_id', 'id');
    }

    public function attendance()
    {
        return $this->hasMany('App\Attendance', 'section_id', 'id');
    }

    public function courseAttendance()
    {
        return $this->hasMany('App\CourseAttendance', 'section_id', 'id');
    }

    public function fees()
    {
        return $this->hasMany('App\Fee', 'section_id', 'id');
    }

    public function course_config()
    {
        return $this->hasMany(CourseConfig::class, 'section_id', 'id');
    }

    public function getSection($status = false, $admission = false, $pluck = false, $sort = false, $sortBy = 'ASC')
    {
        $school_id = Auth::guest() ? school('id') : Auth::user()->school_id;
        $section = self::join('classes', 'classes.id', 'sections.class_id')->where('classes.school_id', $school_id);
        if ($admission) {
            $section = $section->where('sections.section_number', 'Not like', 'Admission');
        } else {
            $section = $section->where('sections.section_number', 'like', 'Admission');
        }
        if ($status) {
            $section = $section->where('sections.status', $status);
        }
        $section->orderByRaw('CONVERT(classes.class_number, SIGNED) asc');
        if ($sort) {
            $section = $section->orderBy($sort, $sortBy);
        }
        if ($pluck) {
            $section = $section->selectRaw('sections.id, CONCAT(classes.name, " - ",section_number) as pluckName')->
            pluck('pluckName', 'sections.id');
        } else {
            $section = $section->get();
        }
        return $section;

    }
}
