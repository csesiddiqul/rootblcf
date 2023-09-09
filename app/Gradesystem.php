<?php

namespace App;

use App\Model;
use Illuminate\Support\Facades\Auth;

class Gradesystem extends Model
{
    protected $table = 'grade_systems';

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function course_config()
    {
        return $this->hasMany(Gradesystem::class, 'grade_system_name', 'id');
    }

    public function getGradeSysName($pluck = false, $groupby = 'grade_system_name', $sort = 'grade_system_name', $sortBy = 'ASC')
    {
        $school_id = Auth::guest() ? school('id') : Auth::user()->school_id;
        $grade = self::bySchool($school_id);
        if ($sort) {
            $grade = $grade->orderBy($sort, $sortBy);
        }
        if ($groupby) {
            $grade = $grade->groupBy($groupby);
        }
        if ($pluck) {
            $grade = $grade->pluck('grade_system_name', 'grade_system_name');
        } else {
            $grade = $grade->get();
        }
        return $grade;

    }
}
