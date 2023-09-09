<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Http\Resources\GradeResource;
use App\StudentInfo;
use Illuminate\Http\Request;
use App\Http\Requests\Grade\CalculateMarksRequest;
use App\Http\Traits\GradeTrait;
use App\Services\Grade\GradeService;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    use GradeTrait;

    protected $gradeService;

    public function __construct(GradeService $gradeService)
    {
        parent::__construct();
        $this->gradeService = $gradeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($student_code)
    {
        if ($this->gradeService->isLoggedInUserStudent()) {
            $grades = $this->gradeService->getStudentGradesWithInfoCourseTeacherExam(auth()->user()->id);
        } else {
            $user = $this->user->bySchool(auth()->user()->school_id)->StudentCode($student_code)->first();
            if (empty($user)) {
                toast(transMsg('Student not found'), 'error')->timerProgressBar();
                return redirect()->back();
            }
            $grades = $this->gradeService->getStudentGradesWithInfoCourseTeacherExam($user->id);
        }
        if (count($grades) > 0) {
            $exams = $this->gradeService->getExamByIdsFromGrades($grades);
            $gradesystems = $this->gradeService->getGradeSystemBySchoolId($grades);
        } else {
            $grades = [];
            $gradesystems = [];
            $exams = [];
        }

        $this->gradeService->grades = $grades;
        $this->gradeService->gradesystems = $gradesystems;
        $this->gradeService->exams = $exams;

        return $this->gradeService->gradeIndexView('grade.student-grade');
    }

    public function print($student_code)
    {
        if ($this->gradeService->isLoggedInUserStudent()) {
            $grades = $this->gradeService->getStudentGradesWithInfoCourseTeacherExam(auth()->user()->id);
        } else {
            $user = $this->user->bySchool(auth()->user()->school_id)->StudentCode($student_code)->first();
            if (empty($user)) {
                toast(transMsg('Student not found'), 'error')->timerProgressBar();
                return redirect()->back();
            }
            $grades = $this->gradeService->getStudentGradesWithInfoCourseTeacherExam($user->id);
        }
        if (count($grades) > 0) {
            $exams = $this->gradeService->getExamByIdsFromGrades($grades);
            $gradesystems = $this->gradeService->getGradeSystemBySchoolId($grades);
        } else {
            $grades = [];
            $gradesystems = [];
            $exams = [];
        }

        $this->gradeService->grades = $grades;
        $this->gradeService->gradesystems = $gradesystems;
        $this->gradeService->exams = $exams;

        return $this->gradeService->gradeIndexView('grade.student-grade-print');
    }

    public function tindex($teacher_id, $course_id, $exam_id, $section_id)
    {
        $this->addStudentsToCourse($teacher_id, $course_id, $exam_id, $section_id);

        $grades = $this->gradeService->getGradesByCourseExam($teacher_id, $course_id, $exam_id, $section_id);
        $gradesystems = $this->gradeService->getGradeSystemBySchoolIdGroupByName($grades);

        $this->gradeService->grades = $grades;
        $this->gradeService->gradesystems = $gradesystems;

        return $this->gradeService->gradeTeacherIndexView('grade.teacher-grade');
    }

    public function cindex($teacher_id, $course_id, $exam_id, $section_id)
    {
        $this->addStudentsToCourse($teacher_id, $course_id, $exam_id, $section_id);
        $grades = $this->gradeService->getGradesByCourseExam($teacher_id, $course_id, $exam_id, $section_id, true);

        $gradesystems = $this->gradeService->getGradeSystemBySchoolId($grades);

        $this->gradeService->grades = $grades;
        $this->gradeService->gradesystems = $gradesystems;
        $this->gradeService->course_id = $course_id;
        $this->gradeService->exam_id = $exam_id;
        $this->gradeService->teacher_id = $teacher_id;
        $this->gradeService->section_id = $section_id;

        return $this->gradeService->gradeCourseIndexView('grade.course-grade');
    }

    public function allExamsGrade()
    {
        /*$classes = $this->gradeService->getClassesBySchoolId();
        $classIds = $classes->pluck('id')->toArray();
        $sections = $this->gradeService->getSectionsByClassIds($classIds);*/
        $school_id = auth()->user()->school_id;
        if (isset($_GET['id']) && isset($_GET['section']))
            $data['student_user'] = $this->user->bySchool($school_id)->student()->active()->where('student_code', $_GET['id'])->where('section_id', $_GET['section'])->first();
        $data['session'] = $session = currentSession();
        $data['exam'] = array();
        if ($session) {
            $data['exam'] = $this->exam->bySchool($school_id)->where('result_published', 1)->where('session_id', $session->id)->pluck('exam_name', 'id');
        }
        $data['section'] = (new $this->section())->getSection(true, true, true, 'classes.name');
        return view('grade.all-exams-grade', $data);
    }

    public function markGrade(Request $request)
    {
        $this->validate($request, [
            'exam' => 'required|array|max:3',
            'section' => 'required|numeric',
            'student' => 'required|string',
            'range_from' => 'nullable|required_if:student,==,all|integer|min:0',
            'range_to' => 'nullable|required_if:student,==,all|integer|min:0|max:' . ($request->range_from + 20),
        ], [
            'range_to.max' => 'The student range between 20'
        ]);
        $request_exam = $request->exam;
        $school_id = auth()->user()->school_id;
        $session = currentSession();
        $data['section'] = $section = $request->section;
        $users = $this->user->bySchool($school_id)->where('section_id', $section)->student()->active()
            ->leftjoin('student_infos', 'users.id', 'student_infos.student_id')
            ->where('student_infos.session', $session->id)->select('users.*');
        if (strtolower($request->student) == 'all') {
            $users = $users->whereBetween('student_infos.class_roll', [$request->range_from, $request->range_to])->get();
        } else
            $users = $users->where('users.id', $request->student)->get();
        if (count($users) == 0) {
            toast(transMsg('Student not found'), 'error')->timerProgressBar();
            return redirect()->back();
        }
        $positions = Grade::leftJoin('course_configs', function ($q) use ($request_exam, $session) {
            $q->on('course_configs.id', 'grades.course_id');
            $q->leftjoin('courses', 'courses.id', 'course_configs.course_id');
        })->leftJoin('users', function ($q) use ($session) {
            $q->on('users.id', 'grades.student_id');
            $q->leftjoin('student_infos', 'student_infos.student_id', 'users.id');
            $q->leftjoin('course_groups', 'student_infos.coursegroup_id', 'course_groups.id');
            $q->where('student_infos.session', $session->id);
        })->where('users.section_id', $request->section)
            ->whereIn('grades.exam_id', $request_exam)
            ->selectRaw('grades.student_id,grades.exam_id,SUM(grades.gpa) AS tGpa,SUM(grades.marks) as tMark,SUM(grades.gpa) - CASE WHEN course_configs.course_id = course_groups.optional THEN CASE WHEN grades.gpa >=2 THEN 2 ELSE CASE WHEN grades.gpa >=1 THEN 1 ELSE 0 END END ELSE 0 END as fGpa')
            ->orderBy('fGpa', 'DESC')
            ->orderBy('tMark', 'DESC')
            ->orderBy('student_infos.class_roll', 'ASC')
            ->groupBy('grades.student_id')
            ->groupBy('grades.exam_id')->get();
        if (count($request_exam) > 1) {
            $final_positions = Grade::leftJoin('course_configs', function ($q) use ($request_exam, $session) {
                $q->on('course_configs.id', 'grades.course_id');
                $q->leftjoin('courses', 'courses.id', 'course_configs.course_id');
            })->leftJoin('users', function ($q) use ($session) {
                $q->on('users.id', 'grades.student_id');
                $q->leftjoin('student_infos', 'student_infos.student_id', 'users.id');
                $q->leftjoin('course_groups', 'student_infos.coursegroup_id', 'course_groups.id');
                $q->where('student_infos.session', $session->id);
            })->where('users.section_id', $request->section)
                ->whereIn('grades.exam_id', $request_exam)
                ->selectRaw('grades.student_id,(SUM(grades.gpa) - CASE WHEN course_configs.course_id = course_groups.optional THEN CASE WHEN grades.gpa >=2 THEN 2 ELSE CASE WHEN grades.gpa >=1 THEN 1 ELSE 0 END END ELSE 0 END) / ' . count($request_exam) . ' as fGpa')
                ->orderBy('fGpa', 'DESC')
                ->groupBy('grades.student_id')->get();
        }
        $grade_array_multi = array();
        foreach ($users as $user) {
            $grade_array = array();
            foreach ($request_exam as $exam_id) {
                $grades = $this->gradeService->getStudentGradesWithInfoCourseTeacherExam($user->id, $exam_id);
                if (count($grades) > 0) {
                    $exams = $this->gradeService->getExamByIdsFromGrades($grades);
                    $gradesystems = $this->gradeService->getGradeSystemBySchoolId($grades);
                } else {
                    $grades = [];
                    $gradesystems = [];
                    $exams = [];
                }
                array_push($grade_array, $grades);
            }
            array_push($grade_array_multi, $grade_array);
        }
        if (count($request_exam) > 1) {
            $view = 'grade.multi_exam_student-grade';
            $data['final_positions'] = $final_positions;
        } else {
            if (foqas_setting('marksheet_tem') == 2)
                $view = 'grade.student_grade_1';
            else
                $view = 'grade.student-grade-print';
        }
        $data['grade_array_multi'] = $grade_array_multi;
        $data['gradesystems'] = $gradesystems;
        $data['exams'] = $exams;
        $data['positions'] = $positions;
        return view($view, $data);
    }

    protected function final_position($student_id, $exam_id, $positions)
    {
        foreach ($positions as $position) {
            if ($position->student_id == $student_id && $position->exam_id == $exam_id) {
                return $position->fGpa;
            }
        }
        return 0;
    }

    public function gradesOfSection($section_id)
    {
        $examIds = $this->gradeService->getActiveExamIds()->toArray();
        $courses = $this->gradeService->getCourseBySectionIdExamIds($section_id, $examIds);
        $grades = $this->gradeService->getGradesByCourseId($courses);

        return view('grade.class-result', compact('grades'));
    }

    public function calculateMarks(CalculateMarksRequest $request)
    {
        $gradeSystem = $this->gradeService->getGradeSystemByname($request->grade_system_name);

        $this->gradeService->course_id = $request->course_id;
        $this->gradeService->course_config_id = $request->course_config_id;
        $course_config = $this->gradeService->getCourseByCourseId();
        $grades = $this->gradeService->getGradesByCourseExam($request->teacher_id, $request->course_config_id, $request->exam_id, $request->section_id)->toArray();

        $tbc = $this->gradeService->calculateGpaFromTotalMarks($grades, $course_config, $gradeSystem);

        $this->gradeService->saveCalculatedGPAFromTotalMarks($tbc);

        $this->gradeService->course_id = $request->course_id;
        $this->gradeService->exam_id = $request->exam_id;
        $this->gradeService->teacher_id = $request->teacher_id;
        $this->gradeService->section_id = $request->section_id;
        return $this->gradeService->returnRouteWithParameters('teacher_grade');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        return new GradeResource(Grade::find($id));
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
        //return \Request::all();
        // return count($request->grade_ids);
        $tbc = $this->gradeService->updateGrade($request);
        try {
            if (count($tbc) > 0) {
                $gradeTb = new Grade;
                \Batch::update($gradeTb, (array)$tbc, 'id');
            }
        } catch (\Exception $e) {
            toast(transMsg('Oops an error occurred'), 'error')->timerProgressBar();
            return back();
        }
        toast(transMsg('Saved successfully'), 'success')->timerProgressBar();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (Grade::destroy($id)) ? response()->json([
            'status' => 'success'
        ]) : response()->json([
            'status' => 'error'
        ]);
    }
}
