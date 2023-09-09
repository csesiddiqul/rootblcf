<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseGroup;
use App\Department;
use App\Http\Resources\CourseResource;
use App\Myclass;
use App\Section;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\Course\SaveConfigurationRequest;
use App\Http\Traits\GradeTrait;
use App\Services\Course\CourseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    use GradeTrait;

    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        parent::__construct();
        $this->courseService = $courseService;
    }


    public function getCourseindex()
    {
        $courses = $this->courseService->getCoursesBySchool(auth()->user()->school_id);
        return view('course.index', compact('courses'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($teacher_id, $section_id)
    {
        if ($this->courseService->isCourseOfTeacher($teacher_id)) {
            $courses = $this->courseService->getCoursesByTeacher($teacher_id);
            $exams = $this->courseService->getExamsBySchoolId();
            $view = 'course.teacher-course';
        } else if ($this->courseService->isCourseOfStudentOfASection($section_id)) {
            $courses = $this->courseService->getCoursesBySection($section_id);
            $view = 'course.class-course';
            $exams = [];
        } else if ($this->courseService->isCourseOfASection($section_id)) {
            $courses = $this->courseService->getCoursesBySection($section_id);
            $exams = $this->courseService->getExamsBySchoolId();
            $view = 'course.class-course';
        } else {
            return redirect('home');
        }
        return view($view, compact('courses', 'exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function course($teacher_id, $course_id, $exam_id, $section_id)
    {
        $this->addStudentsToCourse($teacher_id, $course_id, $exam_id, $section_id);
        $students = $this->courseService->getStudentsFromGradeByCourseAndExam($course_id, $exam_id);
        return view('course.students', compact('students', 'teacher_id', 'section_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:courses,name,null,id,school_id,' . auth()->user()->school_id,
            'code' => 'required|numeric|unique:courses,code,null,id,school_id,' . auth()->user()->school_id,
            'type' => 'required|numeric',
            'status' => 'required|numeric',
        ]);
        $data = request()->except(['_token', '_method']);
        $data['status'] = $request->status == 1 ? 1 : 2;
        $data['user_id'] = Auth::user()->id;
        $data['school_id'] = Auth::user()->school_id;
        $this->course->create($data);
        toast(transMsg(subjectOrCourseName() . ' created successfully.'), 'success')->timerProgressBar();
        return redirect()->back();
    }

    /**
     * @param SaveConfigurationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveConfiguration(SaveConfigurationRequest $request)
    {
        try {
            $this->courseService->saveConfiguration($request);
            toast(transMsg('Saved successfully.'), 'success')->timerProgressBar();
        } catch (\Exception $ex) {
            toast(transMsg('Could not save configuration'), 'error')->timerProgressBar();
        }
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
        return new CourseResource(Course::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = $this->course->bySchool(Auth::user()->school_id)->find($id);
        return view('course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required|string||unique:courses,name,' . $id . ',id,school_id,' . $user->school_id,
            'code' => 'required|numeric|unique:courses,code,' . $id . ',id,school_id,' . $user->school_id,
            'type' => 'required|numeric',
            'status' => 'required|numeric',
        ]);
        $data = request()->except(['_token', '_method']);
        $data['user_id'] = $user->id;
        $this->courseService->updateCourseInfo($id, $data);
        toast(transMsg(subjectOrCourseName() . ' updated successfully.'), 'success')->timerProgressBar();
        return redirect()->route('academic.course.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $course = $this->course->bySchool($user->school_id)->find($id);
        if ($course) {
            if ($this->courseGroup->bySchool($user->school_id)->where('course', 'LIKE', '%' . $id . '%')->exists()) {
                $message = ucfirst($course->name) . ' already join ' . subjectOrCourseName() . ' group, can not delete this';
                toast(transMsg($message), 'info')->timerProgressBar();
                return redirect()->back();
            }
            $course->delete();
            toast(transMsg('Delete Successfully'), 'success')->timerProgressBar();
            return redirect()->back();
        } else {
            toast(transMsg(subjectOrCourseName() . ' not found'), 'error')->timerProgressBar();
            return redirect()->back();
        }
        return ($this->course->bySchool($user->school_id)->destroy($id)) ? response()->json([
            'status' => 'success'
        ]) : response()->json([
            'status' => 'error'
        ]);
    }
}
