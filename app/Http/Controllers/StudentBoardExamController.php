<?php

namespace App\Http\Controllers;

use App\StudentBoardExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentBoardExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['board_exams'] = StudentBoardExam::bySchool(auth()->user()->school_id)
            ->join('student_infos', 'student_board_exams.student_id', '=', 'student_infos.student_id')
            ->where('student_infos.session', $this->current_session->id)->with('student')->select('student_board_exams.*')->get();
        return view('students.board_exam.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['section'] = (new $this->section())->getSection(true, true, true, 'classes.name');
        return view('students.board_exam.create', $data);
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
            'student_id' => 'required|numeric',
            'board' => 'required|string',
            'session' => 'required|string',
            'exam_name' => 'required|string',
            'passing_year' => 'required|string',
            'institution_name' => 'required|string',
            'gpa' => 'required|numeric',
            'out_of_gpa' => 'required|numeric',
            'group' => 'required|string',
            'roll' => 'required|numeric',
            'registration' => 'required|numeric',
        ]);
        $data = request()->except(['_token', '_method']);
        $data['user_id'] = Auth::user()->id;
        $data['school_id'] = Auth::user()->school_id;
        StudentBoardExam::create($data);
        toast(transMsg('Added Successfully.'), 'success')->timerProgressBar();
        return redirect()->back();
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
        $auth_user = auth()->user();
        $data['studentBoardExam'] = $broad_exam = StudentBoardExam::bySchool($auth_user->school_id)->findOrFail($id);
        if (empty($broad_exam)) {
            toast(transMsg('Not found'), 'info')->timerProgressBar();
            return back();
        }
        $data['student'] = $this->user->bySchool($auth_user->school_id)
            ->leftjoin('student_infos', 'users.id', '=', 'student_infos.student_id')
            ->where('users.section_id', $broad_exam->student->section_id)
            ->where('student_infos.session', $this->current_session->id)
            ->active()->student()->pluck('users.name', 'users.id');
        $data['section'] = (new $this->section())->getSection(true, true, true, 'classes.name');
        return view('students.board_exam.edit', $data);
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
        $this->validate($request, [
            'student_id' => 'required|numeric',
            'board' => 'required|string',
            'session' => 'required|string',
            'exam_name' => 'required|string',
            'passing_year' => 'required|string',
            'institution_name' => 'required|string',
            'gpa' => 'required|numeric',
            'out_of_gpa' => 'required|numeric',
            'group' => 'required|string',
            'roll' => 'required|numeric',
            'registration' => 'required|numeric',
        ]);
        $data = request()->except(['_token', '_method']);
        StudentBoardExam::find($id)->update($data);
        toast(transMsg('Update Successfully.'), 'success')->timerProgressBar();
        return redirect()->route('academic.board_exam.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StudentBoardExam::find($id)->delete();
        toast(transMsg('Delete Successfully.'), 'success')->timerProgressBar();
        return redirect()->route('academic.board_exam.index');
    }
}
