<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\CourseAttendance;
use App\Exam;
use App\Section;
use App\User;
use App\Http\Resources\AttendanceResource;
use Illuminate\Http\Request;
use App\Http\Requests\Attendance\StoreAttendanceRequest;
use App\Http\Traits\GradeTrait;
use App\Services\Attendance\AttendanceService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    use GradeTrait;

    protected $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        parent::__construct();
        $this->attendanceService = $attendanceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($school_code)
    {
        $school = Auth::user()->school;
        if ($school->code != $school_code) {
            return redirect()->back();
        }
        if (request()->isMethod('POST')) {
            request()->validate([
                'section' => 'required|numeric',
                'exam' => 'required|numeric',
                'date' => 'required|date|before:tomorrow'
            ]);
            $data['section'] = request()->section;
            $data['exam'] = request()->exam;
            $data['date'] = $date = request()->date;
            session()->put('attendanceData', $data);
            session()->put('adjustCheckAttendance', true);
            $data['students'] = User::with(['attendance' => function ($q) use ($date) {
                $q->where('date', date('Y-m-d', strtotime($date)));
            }])->join('student_infos', 'users.id', '=', 'student_infos.student_id')
                ->where('student_infos.session', $this->current_session->id)
                ->bySchool($school->id)->whereRole('student')
                ->whereSection_id(request()->section)
                ->active()
                ->orderBy('student_code')->select('users.*')->get();
        }
        $data['pluckSection'] = (new Section())->getSection(true, true, true, 'classes.name');
        $data['pluckExam'] = (new Exam())->getExam(true, true);
        return view('attendance.index', $data);
    }

    public function takeAttendanceViaSection()
    {
        $data = request('insert');
        $data = explode(',', $data);
        $student_code = $data[0];
        if (empty($student_code)) {
            return response()->json(['status' => '404', 'msg' => transMsg('Id does not exists')]);
        }
        if ($data[1] == 0 || $data[1] == 1 || $data[1] == 2) {
            $status = $data[1]; //0 = absent,1 = present,2 = Escaped
        } else {
            return response()->json(['status' => '403', 'msg' => transMsg('Access Forbidden')]);
        }
        $this->attendanceService->storeAttendance($student_code, $status);
        $attrStatus = ($status == 0 ? 'Absent' : ($status == 1 ? 'Present' : 'Escaped'));
        return response()->json(['status' => '200', 'msg' => $attrStatus]);
    }

    public function indexOld($section_id, $student_id, $exam_id)
    {
        if ($section_id > 0 && \Auth::user()->role != 'student') {
            // View attendances of students of a section
            $students = $this->attendanceService->getStudentsBySection($section_id);
            $attendances = $this->attendanceService->getTodaysAttendanceBySectionId($section_id);
            $attCount = $this->attendanceService->getAllAttendanceBySecAndExam($section_id, $exam_id);

            return view('attendance.attendance', [
                'students' => $students,
                'attendances' => $attendances,
                'attCount' => $attCount,
                'section_id' => $section_id,
                'exam_id' => $exam_id
            ]);
        } else {
            // View attendance of a single student by student id
            if (\Auth::user()->role == 'student') {
                // From student view
                $exam = \App\ExamForClass::where('class_id', \Auth::user()->section->class->id)
                    ->where('active', 1)
                    ->first();
            } else {
                // From other users view
                $student = $this->attendanceService->getStudent($student_id);
                $exam = \App\ExamForClass::where('class_id', $student->section->class->id)
                    ->where('active', 1)
                    ->first();
            }
            if ($exam)
                $exId = $exam->exam_id;
            else
                $exId = 0;
            $attendances = $this->attendanceService->getAttendanceByStudentAndExam($student_id, $exId);
            return view('attendance.student-attendances', ['attendances' => $attendances]);
        }
    }

    /**
     * View for Adjust missing Attendances
     *
     * @return \Illuminate\Http\Response
     */
    public function adjust($student_id, $course_id, $exam_id)
    {
        $student = $this->attendanceService->getStudent($student_id);
        // return    $exam = \App\ExamForClass::where('class_id', $student->section->class->id)->where('id', $exam_id)->where('active', 1)->first();
        $exam = CourseAttendance::where('exam_id', $exam_id)->where('section_id', $student->section->id)
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->orderBy('created_at', 'desc')->first();
        if (empty($exam))
            $exId = 0;
        else
            $exId = $exam->exam_id;
        $attendances = $this->attendanceService->getAbsentAttendanceByStudentAndExam($student_id, $exId, $course_id);
        return view('attendance.adjust', ['attendances' => $attendances, 'student_id' => $student_id]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * Adjust missing Attendances POST request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adjustPost(Request $request)
    {
        $request->validate([
            'att_id' => 'required|array',
        ]);
        return $this->attendanceService->adjustPost($request);
    }

    public function adjustPostAjax()
    {
        if (\request()->ajax() && \request()->isMethod('POST')) {
            $data = request('insert');
            $student_code = $data[0];
            if (empty($student_code)) {
                return response()->json(['status' => '404', 'msg' => transMsg('Id does not exists')]);
            }
            $status = $data[1];
            if ($status == 0 || $status == 1 || $status == 2) {
                //0 = absent,1 = present,2 = Escaped
                $remark = $data[2];
                if (empty($remark)) {
                    return response()->json(['status' => '404', 'msg' => transMsg('Remarks is required')]);
                }
                $this->attendanceService->storeAttendance($student_code, $status, $remark);
                return response()->json(['status' => '200', 'msg' => transMsg('Successfully update')]);
            } else {
                return response()->json(['status' => '403', 'msg' => transMsg('Access Forbidden')]);
            }
        } elseif (\request()->ajax() && \request()->isMethod('PUT')) {
            if (session('adjustCheckAttendance')) {
                $session = session('attendanceData');
                $school_id = Auth::user()->school_id;
                $date = date('Y-m-d', strtotime($session['date']));
                $storeAttr = Attendance::bySchool($school_id)->where('exam_id', $session['exam'])->where('date', $date)->where('section_id', $session['section'])->get();
                if ($storeAttr->count()) {
                    $attendanceIds = $storeAttr->pluck('student_id')->toArray();
                    $students = User::bySchool($school_id)->join('student_infos', 'users.id', '=', 'student_infos.student_id')
                        ->where('student_infos.session', $this->current_session->id)->where('users.section_id', $session['section'])->active()->student()->whereNotIn('users.id', $attendanceIds)->select('users.*')->get();
                    if ($students->count()) {
                        for ($i = 0; $i < count($students); $i++) {
                            $attrAddArray['school_id'] = $school_id;
                            $attrAddArray['student_id'] = $students[$i]->id;
                            $attrAddArray['section_id'] = $session['section'];
                            $attrAddArray['exam_id'] = $session['exam'];
                            $attrAddArray['date'] = $date;
                            $attrAddArray['present'] = 0;
                            $attrAddArray['user_id'] = auth()->user()->id;
                            $attrAddArray['created_at'] = now();
                            $attrAddArray['updated_at'] = now();
                            $attrAddArrays[] = $attrAddArray;
                        }
                        Attendance::insert($attrAddArrays);
                        $message = 'successfully update';
                        goto statementBreak;
                    }
                    $message = 'Already up to date';
                    goto statementBreak;
                }
                $message = 'no result found';
                statementBreak:
                session()->forget('adjustCheckAttendance');
                session()->forget('attendanceData');
                return response()->json(['status' => 200, 'msg' => transMsg($message)]);
            }
        }
    }

    /**
     * Add students to a Course before taking attendances
     * @return \Illuminate\Http\Response
     */
    public function addStudentsToCourseBeforeAtt($teacher_id, $course_id, $exam_id, $section_id)
    {
        // $this->addStudentsToCourse($teacher_id, $course_id, $exam_id, $section_id);

        $students = $this->attendanceService->getStudentsBySection($section_id);
        $attendances = $this->attendanceService->getTodaysAttendanceBySectionId($section_id, $course_id, $exam_id);
        $attCount = $this->attendanceService->getAllAttendanceBySecAndExam($section_id, $course_id, $exam_id);

        return view('attendance.attendance', [
            'students' => $students,
            'attendances' => $attendances,
            'attCount' => $attCount,
            'course_id' => $course_id,
            'section_id' => $section_id,
            'exam_id' => $exam_id
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * View students of a section to view attendances
     * @return \Illuminate\Http\Response
     */
    public function sectionIndex(Request $request, $section_id)
    {
        $users = $this->attendanceService->getStudentsWithInfoBySection($section_id);

        $request->session()->put('section-attendance', true);

        return view('list.student-list', [
            'users' => $users,
            'current_page' => $users->currentPage(),
            'per_page' => $users->perPage()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttendanceRequest $request)
    {
        $this->attendanceService->request = $request;
        if ($request->update == 1) {
            $at = $this->attendanceService->updateAttendance();
            if (isset($at))
                if (count($at) > 0)
                    CourseAttendance::insert($at);
        } else {
            $this->attendanceService->courseStoreAttendance();
        }
        toast(transMsg("Saved Successfully"), 'success')->timerProgressBar();
        return redirect()->back();
    }

    public function reportByDate(Request $request)
    {
        if ($request->isMethod('POST')) {
            request()->validate([
                'section' => 'required|numeric',
                'date' => 'required|date|before:tomorrow'
            ]);
            $data['section'] = $section = $request->section;
            $data['date'] = $date = $request->date;
            $school_id = Auth::user()->school_id;
            $date = date('Y-m-d', strtotime($date));
            if (Attendance::bySchool($school_id)->where('date', $date)->exists()) {
                $data['results'] = User::with(['attendance' => function ($q) use ($date) {
                    $q->where('date', date('Y-m-d', strtotime($date)));
                }])->join('student_infos', 'users.id', '=', 'student_infos.student_id')
                    ->where('student_infos.session', $this->current_session->id)
                    ->bySchool($school_id)->student()
                    ->whereSection_id(request()->section)
                    ->active()
                    ->orderBy('student_code')->select('users.*')->get();;
            } else {
                $data['results'] = array();
            }
        }
        $data['pluckSection'] = (new Section())->getSection(true, true, true, 'classes.name');
        return view('attendance.reportByDate', $data);
    }

    public function reportByMonth(Request $request)
    {
        if ($request->isMethod('POST')) {
            request()->validate([
                'section' => 'required|numeric',
                'month' => 'required|integer|min:1|max:12',
                'year' => 'required|digits:4|integer|min:2000|max:' . (date('Y') + 1)
            ]);
            $data['section'] = $section = $request->section;
            $data['month'] = $month = $request->month;
            $data['year'] = $year = $request->year;
            $school_id = Auth::user()->school_id;
            $dates = getDatesByMonthYear($month, $year);
            $sql = DB::connection(db_connection())->table('users')
                ->leftjoin('sections', 'sections.id', 'users.section_id')
                ->leftjoin('student_infos', 'users.id', 'student_infos.student_id')
                ->leftjoin('classes', 'sections.class_id', 'classes.id')
                ->leftJoin('attendances', function ($q) use ($dates) {
                    $q->on('users.id', 'attendances.student_id');
                    $q->leftjoin('exams', 'exams.id', 'attendances.exam_id');
                    $q->whereIn('attendances.date', $dates);
                })
                ->where('users.school_id', $school_id)
                ->where('users.section_id', $section)
                ->where('student_infos.session', $this->current_session->id)
                ->where('users.role', 'student')
                ->selectRaw('users.student_code,classes.name as classname,sections.section_number,exams.exam_name,COUNT(if(present=1,present, null)) AS totalP,COUNT(if(present=0,present, null)) AS totalA');
            foreach ($dates as $date) {
                $sql->selectRaw("GROUP_CONCAT(if(date = '" . $date . "', present, null)) AS '" . date('d', strtotime($date)) . "'");
            }
            $sql->groupBy('users.student_code')->orderBy('users.student_code');
            $data['attendances'] = $sql->get();
        }
        $data['pluckSection'] = (new Section())->getSection(true, true, true, 'classes.name');
        return view('attendance.reportByMonth', $data);
    }

    public function attendanceSendSMS()
    {
        if (\Request::ajax() && \request()->isMethod('POST')) {
            $school_id = auth()->user()->school_id;
            $data = request('insert');
            $section = base64_decode($data[0]);
            $date = base64_decode($data[1]);
            $message = $data[2];
            if (empty($section)) {
                return response()->json(['status' => '404', 'msg' => transMsg('Section does not exists')]);
            }
            if (empty($date)) {
                return response()->json(['status' => '404', 'msg' => transMsg('Date does not exists')]);
            }
            if (empty($message)) {
                return response()->json(['status' => '404', 'msg' => transMsg('Message is required')]);
            }
            $results = User::join('student_infos', 'users.id', 'student_infos.student_id')
                ->join('attendances', 'users.id', 'attendances.student_id')
                ->where('student_infos.session', $this->current_session->id)
                ->where('attendances.date', date('Y-m-d', strtotime($date)))
                ->where('present', 0)
                ->where('users.school_id', $school_id)
                ->where('users.section_id', $section)
                ->active()->student()
                ->select('users.school_id', 'users.name', 'users.phone_number', 'attendances.present', 'attendances.date', 'student_infos.session')->get();
            $array_number = [];
            foreach ($results as $result) {
                array_push($array_number, $result->phone_number);
            }

            try {
                $array_number = implode(',', $array_number);
                sms_query($array_number, $message);
                return response()->json(['status' => '200', 'msg' => transMsg('Send Successfully')]);
            } catch (\Exception $exception) {
                return response()->json(['status' => '404', 'msg' => transMsg('something wrong')]);
            }
        }
    }
}
