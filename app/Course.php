<?php

namespace App;

use App\Model;
use Illuminate\Support\Facades\Auth;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = ['school_id', 'user_id', 'name', 'code', 'type', 'status'];

    /**
     * Get the class record associated with the user.
     */
    public function class()
    {
        return $this->belongsTo('App\Myclass');
    }

    /**
     * Get the section record associated with the user.
     */
    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    /**
     * Get the teacher record associated with the user.
     */
    public function teacher()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the exam record associated with the course.
     */
    public function exam()
    {
        return $this->belongsTo('App\Exam', 'course_id', 'id');
    }

    public function course_config()
    {
        return $this->hasMany(CourseConfig::class, 'course_id', 'id');
    }

    public function courseGroup()
    {
        return $this->hasMany('App\CourseGroup', 'course_id', 'id');
    }

    public function courseAttendance()
    {
        return $this->hasMany('App\CourseAttendance', 'course_id', 'id');
    }

    public function getCourseByGroup($id)
    {
        if (\Request::ajax()) {
            $school_id = Auth::guest() ? school('id') : Auth::user()->school_id;
            if (empty($school_id)) {
                return response()->json(['Not supported formatted']);
            }
            $coursegroup = CourseGroup::bySchool($school_id)->find($id);
            if (empty($coursegroup)) {
                return response()->json(['Data not found']);
            }
            $courses = self::bySchool($school_id)->whereIn('id', explode(',', $coursegroup->course))->orderBy('name')->get();;
            if (empty($courses)) {
                return response()->json(['Data not found']);
            }
            $html = '<table class="w-100"><tbody>';
            foreach ($courses as $course) {
                $html .= '<tr><td class="pull-left">' . $course->name . '</td></tr>';
            }
            $html .= '</tbody></table>';
            return response()->json($html);
        }
        return response()->json(['Method not supported']);
    }

    public function getCourse($status = false, $pluck = false, $sort = false, $sortBy = 'ASC')
    {
        $school_id = Auth::guest() ? school('id') : Auth::user()->school_id;
        $course = self::bySchool($school_id);
        if ($status) {
            $course = $course->whereStatus($status);
        }
        if ($sort) {
            $course = $course->orderBy($sort, $sortBy);
        }
        if ($pluck) {
            $course = $course->pluck('name', 'id');
        } else {
            $course = $course->get();
        }
        return $course;

    }
}
