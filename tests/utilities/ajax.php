<?php
function getDistrict($division)
{
    if (\Request::ajax()) {
        $localLang = session('localLang') ?? 'en';
        if ($localLang == 'bn') {
            $choose = 'পছন্দ করুন';
        } else {
            $choose = transMsg('Choose');
        }
        $results = \App\District::where('division_id', $division)->orderBy('name')->get();
        $district = '<option selected="selected">' . $choose . '</option>';
        foreach ($results as $result) {
            $district .= '<option value="' . $result->id . '">' . ($localLang == 'bn' ? $result->namebn : $result->name) . '</option>';
        }
        return response()->json(['district' => $district]);
    }
}

function getThana($district)
{
    if (\Request::ajax()) {
        $localLang = session('localLang') ?? 'en';
        if ($localLang == 'bn') {
            $choose = 'পছন্দ করুন';
        } else {
            $choose = transMsg('Choose');
        }
        $results = \App\Thana::where('district_id', $district)->orderBy('name')->get();
        $thana = '';
        $thana .= '<option selected="selected">' . $choose . '</option>';
        foreach ($results as $result) {
            $thana .= '<option value="' . $result->id . '">' . ($localLang == 'bn' ? $result->namebn : $result->name) . '</option>';
        }
        return response()->json(['thana' => $thana]);
    }
}

function getState($country)
{
    if (\Request::ajax()) {
        $localLang = session('localLang') ?? 'en';
        if ($localLang == 'bn') {
            $choose = 'পছন্দ করুন';
        } else {
            $choose = transMsg('Choose');
        }
        $results = \App\State::where('country_id', $country)->orderBy('name')->get();
        $state = '<option selected="selected">' . $choose . '</option>';
        foreach ($results as $result) {
            $state .= '<option value="' . $result->id . '">' . transMsg($result->name) . '</option>';
        }
        return response()->json(['state' => $state, 'count' => count($results)]);
    }
}

function getSection($class)
{
    if (\Request::ajax()) {
        $localLang = session('localLang') ?? 'en';
        if ($localLang == 'bn') {
            $choose = 'পছন্দ করুন';
        } else {
            $choose = transMsg('Choose');
        }
        $results = \App\Section::where('class_id', $class)->orderBy('section_number')->where('sections.section_number', 'Not like', 'admission')->get();
        $section = '<option selected="selected">' . $choose . '</option>';
        foreach ($results as $result) {
            $section .= '<option value="' . $result->id . '">' . $result->section_number . '</option>';
        }
        return response()->json(['section' => $section]);
    }
}

function getStudentsInfo($student_id)
{
    if (\Request::ajax()) {
        $localLang = session('localLang') ?? 'en';
        $student = \App\User::where('school_id', auth()->user()->school_id)->where('id', $student_id)->student()->active()->first();
        $data['student_code'] = $student->student_code;
        $data['name'] = $student->name;
        $data['father_name'] = $student->studentInfo->father_name;
        $data['mother_name'] = $student->studentInfo->mother_name;
        $data['birthday'] = $student->studentInfo->birthday;
        $data['present_address'] = $student->studentInfo->present_address;
        $data['present_post_office'] = $student->studentInfo->present_post_office;
        $data['present_postcode'] = $student->studentInfo->present_postcode;
        $data['permanent_address'] = $student->studentInfo->permanent_address;
        $data['permanent_post_office'] = $student->studentInfo->permanent_post_office;
        $data['permanent_postcode'] = $student->studentInfo->permanent_postcode;
        $data['present_thana'] = $student->studentInfo->thana->name;
        $data['present_district'] = $student->studentInfo->district->name;
        $data['present_division'] = $student->studentInfo->division->name;
        $data['permanent_thana'] = $student->studentInfo->p_thana->name;
        $data['permanent_district'] = $student->studentInfo->p_district->name;
        $data['permanent_division'] = $student->studentInfo->p_division->name;
        return response()->json(['student' => $data]);
    }
}

function getStudent($section_id)
{
    $session = currentSession();
    if ($session)
        $session_id = $session->id;
    if (empty($session_id))
        return response()->json(['student' => array()]);

    if (\Request::ajax()) {
        $results = \App\User::whereSection_id($section_id)->bySchool(Auth::user()->school->id)
            ->leftjoin('student_infos', 'student_infos.student_id', 'users.id')
            ->where('student_infos.session', $session_id)->active()
            ->student()->select('users.*')->get();
        $student = '';
        foreach ($results as $result) {
            $student .= '<option value="' . $result->id . '">' . $result->name . '</option>';
        }
        return response()->json(['student' => $student, 'count_std' => count($results)]);
    }
}

function getStudentRS($resident_status, $section_id)
{
    $session = currentSession();
    if ($session)
        $session_id = $session->id;
    if (empty($session_id))
        return response()->json(['student' => array()]);

    if (\Request::ajax()) {
        $results = \App\User::whereSection_id($section_id)->bySchool(Auth::user()->school->id)
            ->leftjoin('student_infos', 'student_infos.student_id', 'users.id')
            ->where('student_infos.session', $session_id)
            ->where('student_infos.singaporepr', $resident_status)->active()
            ->student()->select('users.*')->get();
        $student = '';
        foreach ($results as $result) {
            $student .= '<option value="' . $result->id . '">' . $result->name . '</option>';
        }
        return response()->json(['student' => $student, 'count_std' => count($results)]);
    }
}

function getStudentBySession($section_id, $session_id = false)
{
    if ($session_id == false) {
        $session = currentSession();
        if ($session)
            $session_id = $session->id;
    }
    if (empty($session_id))
        return response()->json(['student' => array()]);
    if (\Request::ajax()) {
        $results = \App\User::bySchool(auth()->user()->school_id)->where('section_id', $section_id)
            ->leftjoin('student_infos', 'student_infos.student_id', 'users.id')
            ->where('student_infos.session', $session_id)
            ->active()
            ->student()->select('users.*')
            ->orderBy('users.student_code')->get();
        $student = '';
        foreach ($results as $result) {
            $student .= '<option value="' . $result->id . '">' . $result->name . '</option>';
        }
        return response()->json(['student' => $student]);
    }
}

function getBoardExamByStudent($student_id)
{
    if (empty($student_id))
        return response()->json(['exams' => array()]);
    if (\Request::ajax()) {
        $results = \App\StudentBoardExam::where('student_id', $student_id)->get();
        $exams = '';
        foreach ($results as $result) {
            $exams .= '<option value="' . $result->id . '">' . $result->exam_name . ' - ' . $result->roll . '</option>';
        }
        return response()->json(['exams' => $exams]);
    }
}

function checkClassIsAdmission($class_id)
{
    $class = \App\Section::join('classes', 'classes.id', 'sections.class_id')
        ->select('sections.id', 'classes.name')
        ->where([['sections.section_number', 'LIKE', 'admission'], ['classes.school_id', school('id')], ['classes.id', $class_id]])->first();
    if ($class)
        return response()->json(['status' => 200, 'msg' => 'success']);
    return response()->json(['status' => 404, 'msg' => 'not found']);
}

function getAdmissionTotalBySection($section_id)
{
    $class = \App\Section::join('classes', 'classes.id', 'sections.class_id')
        ->select('sections.id', 'sections.add_total', 'classes.name')
        ->where([['sections.section_number', 'LIKE', 'admission'], ['classes.school_id', school('id')], ['sections.id', $section_id]])->first();
    if ($class)
        return response()->json(['status' => 200, 'total' => $class->add_total]);
    return response()->json(['status' => 404, 'total' => 0]);
}

function getRollBySection($section_id)
{
    if (\Request::ajax()) {
        $session = currentSession();
        if ($session) {
            $students = \App\User::join('student_infos', 'student_infos.student_id', 'users.id')
                ->where('users.section_id', $section_id)
                ->where('users.school_id', school('id'))
                ->where('users.active', 1)
                ->where('student_infos.session', $session->id)
                ->orderByRaw('CONVERT(student_infos.class_roll, SIGNED) asc')
                ->get();

            $rolls = '<option selected>' . transMsg('Choose Roll') . '</option>';
            foreach ($students as $student) {
                $rolls .= '<option value="' . $student->student_code . '">' . $student->class_roll . '</option>';
            }
            return response()->json(['status' => 200, 'students' => $rolls]);
        }
        return response()->json(['status' => 404, 'students' => '']);
    }
}