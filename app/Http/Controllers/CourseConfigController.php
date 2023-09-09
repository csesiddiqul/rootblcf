<?php

namespace App\Http\Controllers;

use App\CourseConfig;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseConfigController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['results'] = self::indexData();
        return view('assignTeacher.index', $data);
    }

    protected function indexData()
    {
        return $this->course_config->bySchool(auth()->user()->school_id)->where('session_id', currentSession()->id)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('academic.course_config.index');
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
            'course_id' => 'required|numeric|unique:course_configs,course_id,NULL,id,section_id,' . $request->section_id . 'id,teacher_id,' . $request->teacher_id . 'id,exam_id,' . $request->exam_id . 'id,session_id,' . currentSession()->id,
            'section_id' => 'required|numeric',
            'teacher_id' => 'required|numeric',
            'exam_id' => 'required|numeric',
            'grade_system' => 'required|string'
        ], [
            'course_id.required' => transMsg('The ' . $this->cName . ' field is required'),
            'course_id.unique' => transMsg('The ' . $this->cName . ' has already been taken under it\'s Section,Teacher & Exam.'),
        ]);
        $data = request()->except(['_token', '_method']);
        $data['school_id'] = auth()->user()->school_id;
        $section = $this->section->find($request->section_id);
        $session = currentSession();
        if (empty($section)) {
            toast(transMsg('Section not found'), 'error')->timerProgressBar();
            return redirect()->back();
        }
        if ($section->class->school_id != auth()->user()->school_id) {
            toast(transMsg('Section not found'), 'error')->timerProgressBar();
            return redirect()->back();
        }
        if (empty($session)) {
            toast(transMsg('Session not found'), 'error')->timerProgressBar();
            return redirect()->back();
        }
        $data['class_id'] = $section->class_id;
        $data['grade_system_name'] = $data['grade_system'];
        $data['user_id'] = auth()->user()->id;
        $data['session_id'] = $session->id;
        $this->course_config->create($data);
        toast(transMsg('Created successfully.'), 'success')->timerProgressBar();
        return redirect()->route('academic.course_config.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\AssignTeacher $assignTeacher
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('academic.course_config.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\AssignTeacher $assignTeacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['assignTeacher'] = $assignTeacher = $this->course_config->bySchool(auth()->user()->school_id)->find($id);
        if (empty($assignTeacher)) {
            return redirect()->back();
        }
        $data['results'] = self::indexData();
        return view('assignTeacher.index', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\AssignTeacher $assignTeacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'course_id' => 'required|numeric|unique:course_configs,course_id,' . $id . ',id,section_id,' . $request->section_id . 'id,teacher_id,' . $request->teacher_id . 'id,exam_id,' . $request->exam_id . 'id,session_id,' . currentSession()->id,
            'section_id' => 'required|numeric',
            'teacher_id' => 'required|numeric',
            'exam_id' => 'required|numeric',
            'grade_system' => 'required|string'
        ], [
            'course_id.required' => transMsg('The ' . $this->cName . ' field is required'),
            'course_id.unique' => transMsg('The ' . $this->cName . ' has already been taken under it\'s Section,Teacher & Exam.'),
        ]);
        $assignTeacher = $this->course_config->bySchool(auth()->user()->school_id)->find($id);
        if (empty($assignTeacher)) {
            return redirect()->back();
        }
        $section = $this->section->find($request->section_id);
        $data = request()->except(['_token', '_method']);
        $data['grade_system_name'] = $data['grade_system'];
        $data['class_id'] = $section->class_id;
        $assignTeacher->fill($data)->save();
        toast(transMsg('Updated successfully.'), 'success')->timerProgressBar();
        return redirect()->route('academic.course_config.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\AssignTeacher $assignTeacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assignTeacher = $this->course_config->bySchool(auth()->user()->school_id)->find($id);
        if (empty($assignTeacher)) {
            return redirect()->back();
        }
        $assignTeacher->delete();
        toast(transMsg('Deleted successfully.'), 'success')->timerProgressBar();
        return redirect()->route('academic.course_config.index');
    }

    public function cloneAT(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'previous_exam' => 'required',
                'new_exam' => 'required',
            ]);
            $previous_exam = $request->previous_exam;
            $new_exam = $request->new_exam;
            if ($previous_exam == $new_exam) {
                return response()->json(['status' => 404, 'message' => 'The previous exam and the new exam will not be the same', 'type' => 'warning']);
            }
            $checkAT = $this->queryCheckAT($new_exam);
            if ($checkAT->count()) {
                return response()->json(['status' => 404, 'message' => 'The new exam already assign', 'type' => 'warning']);
            }
            $previousAT = $this->queryCheckAT($previous_exam);
            DB::beginTransaction();
            try {
                foreach ($previousAT as $previousData) {
                    $replicated = $previousData->replicate();
                    $replicated->exam_id = $new_exam;
                    $replicated->save();
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
            return response()->json(['status' => 200, 'message' => 'Cloning is successfully', 'type' => 'success']);
        }
        return response()->json(['status' => 404, 'message' => 'unauthorized', 'type' => 'warning']);
    }

    protected function queryCheckAT($exam_id)
    {
        return CourseConfig::query()->bySchool(auth()->user()->school_id)->where('exam_id', $exam_id)->where('session_id', currentSession()->id)->get();
    }
}
