<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Grade;
use App\Notice as Notice;
use App\TempleteDesign;
use App\User;
use Illuminate\Http\Request;
use App\Services\Exam\ExamService;
use App\Http\Requests\Exam\CreateExamRequest;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    protected $examService;

    public function __construct(ExamService $examService)
    {
        parent::__construct();
        $this->examService = $examService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = $this->examService->getLatestExamsBySchoolIdWithPagination();
        return view('exams.all', compact('exams'));
    }

    public function indexActive()
    {
        $exams = $this->examService->getActiveExamsBySchoolId();
        $this->examService->examIds = $exams->pluck('id')->toArray();
        $courses = $this->examService->getCoursesByExamIds();

        return view('exams.active', compact('exams', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = $this->examService->getClassesBySchoolId();
        $already_assigned_classes = $this->examService->getAlreadyAssignedClasses();
        return view('exams.add', compact('classes', 'already_assigned_classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateExamRequest $request)
    {
        $this->examService->request = $request;
        $session = currentSession();
        if (empty($session)) {
            toast(transMsg('Session not found'), 'error')->timerProgressBar();
            return redirect()->back();
        }
        try {
            $this->examService->storeExam();
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
        \Cache::forget('exams-' . auth()->user()->school_id);
        //return $this->cindex($course_id, $exam_id, $teacher_id);
        toast(transMsg('Created successfully.'), 'success')->timerProgressBar();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|numeric',
        ]);
        $school_id = auth()->user()->school_id;
        $exam = Exam::bySchool($school_id)->find($request->exam_id);
        if (empty($exam)) {
            toast(transMsg('Exam not found !'), 'info')->timerProgressBar();
            return back();
        }
        try {
            $this->examService->request = $request;
            $this->examService->updateExam();
            if ($request->notice_published == 1)
                $this->exam_notice_published($exam);
            toast('Save Successfully!', 'success')->timerProgressBar();
            \Cache::forget('exams-' . $school_id);
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
        return back();
    }

    private function exam_notice_published($exam)
    {
        if ($exam) {
            $title = 'The results of the ' . $exam->name_name . ' examination of ' . $exam->session->schoolyear . ' session have been published';
            $tb = new Notice;
            $tb->title = $title;
            $tb->slug = renderSlug($title, 'Notice');
            $tb->description = $title . '. Published date ' . date('d-m-Y');
            $tb->active = 1;
            $tb->school_id = $exam->school_id;
            $tb->user_id = Auth::user()->id;
            $tb->save();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    private function assignCoursesToExam()
    {
        //   $request->validate([
        //     'course_id' => 'required|numeric',
        //     'exam_id' => 'required|numeric',
        //   ]);

        // $tb = Course::find($request->course_id);
        // $tb->exam_id = $request->exam_id;
        // $tb->save();
        // return back()->with('status', 'Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return back();
    }

    public function admitcard(Request $request)
    {
        $school_id = auth()->user()->school_id;
        $data['session'] = $session = currentSession();
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'exam' => 'required|numeric',
                'student' => 'required|array',
                'section' => 'required|numeric',
                'template' => 'required|numeric'
            ]);
            $request_student = $request->student;
            $request_exam = $data['request_exam'] = $request->exam;
            $request_section = $data['request_section'] = $request->section;
            $students = $this->user->bySchool($school_id)->where('section_id', $request_section)
                ->leftjoin('student_infos', 'student_infos.student_id', 'users.id')
                ->where('student_infos.session', $session->id)
                ->active()
                ->student()
                ->orderBy('users.student_code')->select('users.*');
            if ($request_student[0] == 'all')
                $students = $students->get();
            else
                $students = $students->whereIn('users.id', $request_student)->get();
            $data['students'] = $students;
            $data['find_exam'] = $this->exam->bySchool($school_id)->where('session_id', $session->id)->where('id', $request_exam)->first();
            $data['admitTemplete'] = $admitTemplete = TempleteDesign::find($request->template);
            if (empty($admitTemplete)) {
                toast(transMsg('Admitcard Template not found'), 'info')->timerProgressBar();
                return redirect()->back();
            }
        }
        $data['exam_array'] = array();
        if ($session) {
            $data['exam_array'] = $this->exam->bySchool($school_id)->where('result_published', 0)->where('session_id', $session->id)->pluck('exam_name', 'id');
        }
        $data['section'] = (new $this->section())->getSection(true, true, true, 'classes.name');
        $data['admitCardPluck'] = TempleteDesign::bySchool($school_id)->where('type', 2)->pluck("name", "id");
        return view('admitcard.admitcard-view', $data);
    }

    public function signatureView()
    {
        return view('exams.signature-sheet');
    }

    public function get_report()
    {
        $school_id = auth()->user()->school_id;
        $data['exam'] = array();
        $data['session'] = $session = currentSession();
        if ($session) {
            $data['exam'] = $this->exam->bySchool($school_id)->where('result_published', 1)->where('session_id', $session->id)->pluck('exam_name', 'id');
        }
        $data['section'] = (new $this->section())->getSection(true, true, true, 'classes.name');
        return view('grade.report_grade', $data);
    }

    public function post_report(Request $request)
    {
        $this->validate($request, [
            'exam' => 'required|numeric',
            'report_type' => 'required|numeric|in:1,2,3,4',
            'section' => 'required|numeric'
        ]);
        $report_type = $request->report_type;
        $data['request_exam'] = $request_exam = $request->exam;
        $data['request_section'] = $request_section = $request->section;
        $sql = Grade::leftJoin('course_configs', function ($q) {
            $q->on('course_configs.id', 'grades.course_id');
            $q->leftjoin('courses', 'courses.id', 'course_configs.course_id');
        })->leftJoin('users', function ($q) {
            $q->on('users.id', 'grades.student_id');
            $q->leftjoin('student_infos', 'student_infos.student_id', 'users.id');
            $q->leftjoin('course_groups', 'student_infos.coursegroup_id', 'course_groups.id');
            $q->leftjoin('sections', 'sections.id', 'users.section_id');
            $q->leftjoin('classes', 'sections.class_id', 'classes.id');
            $q->where('student_infos.session', currentSession()->id);
            $q->where('users.active', 1);
        })->where('grades.exam_id', $request_exam);
        if ($report_type == 1 || $report_type == 2 || $report_type == 3):
            $sql = $sql->selectRaw('classes.name as class_name,sections.section_number,classes.group,users.student_code,users.name,student_infos.father_name,student_infos.mother_name,student_infos.class_roll,grades.exam_id,SUM(CASE WHEN grades.gpa < 1 and course_groups.optional NOT IN(course_configs.course_id)  THEN 1 ELSE 0 END)  as fail,(SUM(grades.gpa) - (CASE WHEN course_groups.optional NOT IN(course_configs.course_id) THEN CASE WHEN grades.gpa >=2 THEN 2 ELSE CASE WHEN grades.gpa >=1 THEN 1 ELSE 0 END END ELSE 0 END)) / (COUNT(course_groups.course) - CASE WHEN course_groups.optional NOT IN(course_configs.course_id) THEN 1 ELSE 0 END) as fGpa,CASE WHEN course_groups.optional NOT IN(course_configs.course_id) THEN CASE WHEN grades.gpa >=2 THEN 2 ELSE CASE WHEN grades.gpa >=1 THEN 1 ELSE 0 END END ELSE 0 END as minus,(COUNT(course_groups.course) - CASE WHEN course_groups.optional NOT IN(course_configs.course_id) THEN 2 ELSE 0 END) as shihab,SUM(grades.marks) as tMark')
                ->orderBy('fail', 'ASC')->orderBy('fGpa', 'DESC')->orderBy('tMark', 'DESC')->orderBy('student_infos.class_roll', 'ASC')
                ->groupBy('grades.student_id');
        elseif ($report_type == 4):
            $data['courses'] = Grade::leftJoin('course_configs', function ($q) {
                $q->on('course_configs.id', 'grades.course_id');
                $q->leftjoin('courses', 'courses.id', 'course_configs.course_id');
            })->where('grades.exam_id', $request_exam)->where('course_configs.section_id', $request_section)->select('courses.name', 'courses.id')->orderBy('courses.id')->groupBy('courses.name')->get();
            $sql = $sql->where('users.section_id', $request_section);
            $data['results'] = $sql->selectRaw('grades.exam_id,course_configs.course_id,course_configs.id as course_config_id,course_groups.course as course_groups,classes.name as class_name,sections.section_number,classes.group,users.student_code,student_infos.class_roll,users.name as student_name,grades.ca,grades.written,grades.mcq,grades.practical,grades.marks,grades.gpa,CASE WHEN course_groups.optional NOT IN(course_configs.course_id) THEN 1 ELSE 0 END as optional')
                ->orderBy('class_roll', 'ASC')->orderBy('users.student_code', 'ASC')->groupBy('grades.id')->get();
            $data['t_marits'] = Grade::leftJoin('users', function ($q) {
                $q->on('users.id', 'grades.student_id');
                $q->leftjoin('student_infos', 'student_infos.student_id', 'users.id');
                $q->leftjoin('course_groups', 'student_infos.coursegroup_id', 'course_groups.id');
            })->leftJoin('course_configs', function ($q) {
                $q->on('course_configs.id', 'grades.course_id');
                $q->leftjoin('courses', 'courses.id', 'course_configs.course_id');
            })->where('grades.exam_id', $request_exam)->where('users.section_id', $request_section)
                ->selectRaw('users.student_code,grades.exam_id,(SUM(grades.gpa) - CASE WHEN course_groups.optional NOT IN(course_configs.course_id) THEN CASE WHEN grades.gpa >=2 THEN 2 ELSE CASE WHEN grades.gpa >=1 THEN 1 ELSE 0 END END ELSE 0 END) / (COUNT(grades.course_id) - CASE WHEN course_groups.optional NOT IN(course_configs.course_id) THEN 1 ELSE 0 END) as fGpa,SUM(grades.marks) as tMark')
                ->orderBy('fGpa', 'DESC')->orderBy('tMark', 'DESC')->orderBy('student_infos.class_roll', 'ASC')->groupBy('grades.student_id')->get();
        endif;
        $section = $this->section->find($request_section);
        switch ($report_type):
            case 1:
                $data['results'] = $sql->where('users.section_id', $section->id)->get();
                return view('grade.merit', $data);
            case 2:
                $data['results'] = $sql->where('users.section_id', $section->id)->get();
                return view('grade.fail', $data);
            case 3:
                $data['results'] = $sql->where('sections.class_id', $section->class_id)->get();
                return view('grade.combined_merit', $data);
            case 4:
                return view('grade.tabulation', $data);
            default:
                toast('Select a valid report type', 'info')->timerProgressBar();
                return back();
        endswitch;
    }

    public function resultsSendSMS(Request $request)
    {
        $school_id = Auth::user()->school_id;
        $session = currentSession();
        $section = $request->insert[0];
        $exam = $request->insert[1];
        $message = $request->insert[2];
        $message = str_replace('$school_name', school('name'), $message);
        $find_exam = Exam::bySchool(school('id'))->where('id', $exam)->first();
        if (empty($find_exam))
            return response()->json(['status' => 404, 'msg' => 'Exams not found']);
        $message = str_replace('$session', $find_exam->session->schoolyear, $message);
        $message = str_replace('$exam_name', $find_exam->exam_name, $message);

        $grade_students = Grade::leftJoin('course_configs', function ($q) {
            $q->on('course_configs.id', 'grades.course_id');
            $q->leftjoin('courses', 'courses.id', 'course_configs.course_id');
        })->leftJoin('users', function ($q) use ($session, $section) {
            $q->on('users.id', 'grades.student_id');
            $q->leftjoin('student_infos', 'student_infos.student_id', 'users.id');
            $q->leftjoin('course_groups', 'student_infos.coursegroup_id', 'course_groups.id');
            $q->leftjoin('sections', 'sections.id', 'users.section_id');
            $q->leftjoin('classes', 'sections.class_id', 'classes.id');
            $q->where('users.section_id', $section);
            $q->where('users.active', true);
            $q->where('student_infos.session', $session->id);
        })->where('grades.exam_id', $exam)
            ->selectRaw('classes.name as class_name,sections.section_number,classes.group,users.student_code,users.name,users.phone_number,student_infos.class_roll,grades.exam_id,SUM(CASE WHEN grades.gpa < 1 and course_groups.optional NOT IN(course_configs.course_id)  THEN 1 ELSE 0 END)  as fail,(SUM(grades.gpa) - (CASE WHEN course_groups.optional NOT IN(course_configs.course_id) THEN CASE WHEN grades.gpa >=2 THEN 2 ELSE CASE WHEN grades.gpa >=1 THEN 1 ELSE 0 END END ELSE 0 END)) / (COUNT(course_groups.course) - CASE WHEN course_groups.optional NOT IN(course_configs.course_id) THEN 1 ELSE 0 END) as fGpa,CASE WHEN course_groups.optional NOT IN(course_configs.course_id) THEN CASE WHEN grades.gpa >=2 THEN 2 ELSE CASE WHEN grades.gpa >=1 THEN 1 ELSE 0 END END ELSE 0 END as minus,(COUNT(course_groups.course) - CASE WHEN course_groups.optional NOT IN(course_configs.course_id) THEN 2 ELSE 0 END) as shihab,SUM(grades.marks) as tMark')
            ->orderBy('fail', 'ASC')->orderBy('fGpa', 'DESC')->orderBy('tMark', 'DESC')->orderBy('student_infos.class_roll', 'ASC')
            ->groupBy('grades.student_id')->get();
        foreach ($grade_students as $student) {
            if (!empty($student) && !empty($student->phone_number)){
                $send_msg = str_replace('$roll', $student->class_roll, $message);
                $send_msg = str_replace('$gpa', number_format($student->fGpa,2), $send_msg);
                $send_msg = str_replace('$pass_or_fail', ($student->fail > 0 ? 'Failed' : 'Passed'), $send_msg);
                send_sms($student->phone_number,$send_msg);
            }
        }
        return response()->json(['status' => 200, 'msg' => 'SMS Send Successfully']);
    }
}
