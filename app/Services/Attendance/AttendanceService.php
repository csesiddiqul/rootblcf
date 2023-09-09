<?php

namespace App\Services\Attendance;

use App\CourseAttendance;
use App\User;
use App\Attendance as Attendance;
use Illuminate\Support\Facades\Auth;

class AttendanceService
{
    public $request;

    public function getStudentsBySection($section_id)
    {
        return User::with('section')
            ->join('student_infos', 'users.id', '=', 'student_infos.student_id')
            ->where('student_infos.session', currentSession()->id)
            ->select('users.id', 'users.name', 'users.student_code', 'users.section_id')
            ->where('users.section_id', $section_id)
            ->student()
            ->active()
            ->get();
    }

    public function getStudentsWithInfoBySection($section_id)
    {
        return User::with(['section', 'school', 'studentInfo'])
            ->join('student_infos', 'users.id', '=', 'student_infos.student_id')
            ->where('student_infos.session', currentSession()->id)
            ->where('section_id', $section_id)
            ->select('users.*')
            ->student()
            ->active()
            ->orderBy('name', 'asc')
            ->paginate(50);
    }

    public function adjustPost($request)
    {
        try {
            for ($i = 0; $i < count($request->isPresent); $i++) {
                $atts[] = [
                    'id' => $request->att_id[$i],
                    'remark' => $request->remark[$i],
                    'present' => isset($request->isPresent[$i]) ? 1 : 0,
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            $attTb = new CourseAttendance;
            \Batch::update($attTb, (array)$atts, 'id');
            toast(transMsg('Adjust successfully.'), 'success')->focusCancel(true)->timerProgressBar();
            return back();
        } catch (\Exception $ex) {
            toast(transMsg('Can not saved.'), 'error')->focusCancel(true)->timerProgressBar();
            return back();
        }
    }

    public function getTodaysAttendanceBySectionId($section_id, $course_id, $exam_id)
    {
        return CourseAttendance::where('section_id', $section_id)
            ->where('course_id', $course_id)->where('exam_id', $exam_id)
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->orderBy('created_at', 'desc')
            ->get()
            ->unique('student_id');
    }

    public function getAllAttendanceBySecAndExam($section_id, $course_id, $exam_id)
    {
        return \DB::table('course_attendances')
            ->select('student_id', \DB::raw('
                      COUNT(CASE WHEN present=1 THEN present END) AS totalPresent,
                      COUNT(CASE WHEN present=0 THEN present END) AS totalAbsent,
                      COUNT(CASE WHEN present=2 THEN present END) AS totalEscaped'
            ))
            ->where('section_id', $section_id)
            ->where('exam_id', $exam_id)
            ->where('course_id', $course_id)
            ->groupBy('student_id')
            ->get();
    }

    public function getStudent($student_id)
    {
        return User::with('section')
            ->where('id', $student_id)
            ->student()
            ->where('active', 1)
            ->first();
    }

    public function getAbsentAttendanceByStudentAndExam($student_id, $exId, $course_id)
    {
        return CourseAttendance::with(['student', 'section'])
            ->where('student_id', $student_id)
            ->where('course_id', $course_id)
            ->where('present', 0)
            ->where('exam_id', $exId)
            ->get();
    }

    public function getAttendanceByStudentAndExam($student_id, $exId)
    {
        return Attendance::with(['student', 'section'])
            ->where('student_id', $student_id)
            ->where('exam_id', $exId)
            ->get();
    }

    public function updateAttendance()
    {
        $i = 0;
        $at = [];
        foreach ($this->request->attendances as $key => $attendance) {
            $tb = CourseAttendance::find($attendance);
            if (count((array)$tb) === 1 && !isset($this->request["isPresent$i"]) && $tb->present == 1) {
                // Attended today's class but escaped
                $tb->updated_at = date('Y-m-d H:i:s');
                $tb->save();
                // Escape record
                $tb2 = new CourseAttendance();
                $tb2->student_id = $this->request->students[$i];
                $tb2->section_id = $this->request->section_id;
                $tb2->course_id = $this->request->course_id;
                $tb2->exam_id = $this->request->exam_id;
                $tb2->present = 2;
                $tb2->user_id = auth()->user()->id;
                $tb2->school_id = auth()->user()->school_id;
                $tb2->created_at = date('Y-m-d H:i:s');
                $tb2->updated_at = date('Y-m-d H:i:s');
                $at[] = $tb2->attributesToArray();
            }
            ++$i;
        }
        return $at;
    }

    public function storeAttendance($student_code, $status, $remark = false)
    {
        $school_id = Auth::guest() ? school('id') : Auth::user()->school_id;
        $student = User::bySchool($school_id)
            ->join('student_infos', 'users.id', 'student_infos.student_id')
            ->where('student_infos.session', currentSession()->id)
            ->student()->active()
            ->where('student_code',$student_code)->select('users.*')->first();
        if (empty($student)) {
            return response()->json(['status' => '404', 'msg' => transMsg('Student does not exists')]);
        }
        $session = session('attendanceData');
        $date = date('Y-m-d', strtotime($session['date']));
        $newAtt = Attendance::firstOrCreate(['student_id' => $student->id, 'date' => $date, 'section_id' => $session['section']]);
        $newAtt->school_id = $school_id;
        $newAtt->student_id = $student->id;
        $newAtt->section_id = $session['section'];
        $newAtt->exam_id = $session['exam'];
        $newAtt->present = $status;
        $newAtt->user_id = auth()->user()->id;
        $newAtt->date = $date;
        if ($remark) {
            $newAtt->remark = $remark;
        }
        $newAtt->save();
        return $newAtt;
    }

    public function courseStoreAttendance()
    {
        $i = 0;
        foreach ($this->request->students as $key => $student) {
            $tb = new CourseAttendance;
            $tb->student_id = $student;
            $tb->section_id = $this->request->section_id;
            $tb->exam_id = $this->request->exam_id;
            $tb->course_id = $this->request->course_id;
            $tb->present = isset($this->request["isPresent$i"]) ? 1 : 0;
            $tb->user_id = auth()->user()->id;
            $tb->school_id = auth()->user()->school_id;
            $tb->created_at = date('Y-m-d H:i:s');
            $tb->updated_at = date('Y-m-d H:i:s');
            $at[] = $tb->attributesToArray();
            ++$i;
        }
        CourseAttendance::insert($at);
    }
}