<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Myclass;
use App\Exam;
use App\StudentBoardExam;
use App\User;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificates = Certificate::where('given_to', \Auth::user()->student_code)
            ->bySchool(\Auth::user()->school_id)
            ->get();
        return view('certificates.index', ['certificates' => $certificates]);
    }

    public function testimonialDesign(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'student' => 'required|numeric',
                'section' => 'required|numeric',
                'board_exam' => 'required|numeric'
            ]);
            $data['student'] = $this->user->bySchool(auth()->user()->school_id)->where('section_id', $request->section)->where('id', $request->student)->student()->active()->first();
            $data['board_exam'] = StudentBoardExam::where('id', $request->board_exam)->where('student_id', $request->student)->first();
        }
        $data['section'] = (new $this->section())->getSection(true, true, true, 'classes.name');
        return view('certificates.testimonial', $data);

    }

    public function banglaTestimonial()
    {

        return view('certificates.bangla-testimonial');

    }

    public function tcDesign()
    {

        return view('certificates.tc');

    }

    public function seatplan(Request $request)
    {
        $school_id = auth()->user()->school_id;
        if (request()->isMethod('POST')) {
            $this->validate($request, [
                'exam' => 'required|numeric',
                'section' => 'required|numeric'
            ]);
            $session = currentSession();
            $data['section'] = $section = $request->section;
            $data['exam_id'] = $exam_id = $request->exam;
            $data['students'] = User::leftjoin('student_infos', 'student_infos.student_id', 'users.id')
                ->where('student_infos.session', $session->id)
                ->where('users.school_id', $school_id)
                ->where('users.role', 'student')
                ->where('users.section_id',$section )
                ->where('users.active', 1)
                ->select('users.*', 'student_infos.*')
                ->orderBy('users.student_code')->get();
            $data['exam'] = $this->exam->bySchool($school_id)->where('session_id', $session->id)->where('id',$exam_id)->active()->first();
        }
        $data['pluckSection'] = (new Section())->getSection(true, true, true, 'classes.name');
        $data['pluckExam'] = (new Exam())->getExam(true, true);
        return view('seatplan.seat-plan', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $certificates = Certificate::with('student')
            ->bySchool(Auth::user()->school_id)
            ->where('active', 1)->get();
        return view('certificates.create', ['certificates' => $certificates]);
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
     * @param \App\Certificate $certificate
     * @return \Illuminate\Http\Response
     */
    public function show(Certificate $certificate)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Certificate $certificate
     * @return \Illuminate\Http\Response
     */
    public function edit(Certificate $certificate)
    {
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $tb = Certificate::find($id);
        $tb->active = 0;
        $tb->save();
        return back()->with('status', __('File removed'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Certificate $certificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certificate $certificate)
    {
        return back();
    }
}
