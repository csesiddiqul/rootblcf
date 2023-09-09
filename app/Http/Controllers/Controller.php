<?php

namespace App\Http\Controllers;

use App\Designation;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $school, $cName, $current_session, $exam, $class, $session, $courseGroup, $course, $user, $due, $fee, $department, $admission, $accountSector, $admissionPayment, $course_config, $section, $degree;

    public function __construct()
    {
        $this->admission = app('App\Admission');
        $this->accountSector = app('App\AccountSector');
        $this->admissionPayment = app('App\AdmissionPayment');
        $this->class = app('App\Myclass');
        $this->courseGroup = app('App\CourseGroup');
        $this->course = app('App\Course');
        $this->course_config = app('App\CourseConfig');
        $this->cName = subjectOrCourseName();
        $this->department = app('App\Department');
        $this->designation = app('App\Designation');
        $this->degree = app('App\Degree');
        $this->due = app('App\Due');
        $this->fee = app('App\Fee');
        $this->section = app('App\Section');
        $this->school = app('App\School');
        $this->session = app('App\Session');
        $this->user = app('App\User');
        $this->exam = app('App\Exam');
        $language = session('localLang');
        $this->current_session = currentSession();
        if (empty($language)) {
            $language = foqas_setting('language') ?? 'en';
        }
        App::setLocale($language);
    }
}
