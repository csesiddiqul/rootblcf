<?php

namespace App\Http\Controllers;

use App\CourseConfig;
use App\Session;
use App\Http\Controllers\Controller;
use App\StudentInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SessionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->indexData();
        return view('session.index');
    }

    protected function indexData()
    {
        $data['sessions'] = $this->session->bySchool(auth()->user()->school_id)->get();
        View::share($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('session.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST') && $request->check == 1)
            return $this->ajaxCheckSession($request['request']);

        if ($request->ajax() && $request->isMethod('POST') && $request->update == 1)
            return $this->ajaxUpdate($request['request']);

        if ($request->ajax() && $request->isMethod('POST'))
            return $this->ajaxStore($request['request']);

        request()->validate([
            'schoolyear' => 'required|string|unique:sessions,schoolyear,null,id,school_id,' . auth()->user()->school_id,
            'status' => 'required|numeric|min:1|max:2',
        ]);
        $data = $request->except(['_token', '_method']);
        $data['school_id'] = auth()->user()->school_id;
        $data['status'] = ($request->status == 1) ? 1 : 2;
        $insert = $this->session->create($data);
        if ($request->status == 1) {
            $this->session->bySchool($data['school_id'])->where('id', '!=', $insert->id)->update(array('status' => 2));
        }
        toast(transMsg('Created successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.session.index');
    }

    private function ajaxStore($request)
    {
        $data['schoolyear'] = $request[0];
        $data['starttime'] = $request[1];
        $data['endtime'] = $request[2];
        $data['status'] = 1;
        $data['school_id'] = auth()->user()->school_id;
        $insert = $this->session->create($data);
        if ($insert) {
            session()->forget('create_session_now');
            return response()->json(['status' => '200', 'msg' => transMsg('Created successfully')]);
        }
        return response()->json(['status' => '500', 'msg' => transMsg('Internal server error')]);
    }

    private function ajaxCheckSession($school_year)
    {
        if ($this->session->bySchool(auth()->user()->school_id)->where('schoolyear', $school_year)->exists()) {
            return response()->json(['status' => '409', 'msg' => transMsg('Session already exists')]);
        }
        return response()->json(['status' => '200', 'msg' => transMsg('proceeded')]);
    }

    private function ajaxUpdate($request)
    {
        $school_id = auth()->user()->school_id;
        $session = $this->session->bySchool($school_id)->find($request[0]);
        $session->status = 1;
        $update = $session->save();
        if ($update) {
            session()->forget('active_session_now');
            $this->session->bySchool($school_id)->where('id', '!=', $session->id)->update(array('status' => 2));
            return response()->json(['status' => '200', 'msg' => transMsg('Activate successfully')]);
        }
        return response()->json(['status' => '500', 'msg' => transMsg('Internal server error')]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Session $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Session $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        if ($session->school_id != auth()->user()->school_id) {
            toast(transMsg('Session not found'), 'error')->timerProgressBar();
            return redirect()->back();
        }
        $this->indexData();
        $data['session'] = $session;
        return view('session.index', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Session $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        $school_id = auth()->user()->school_id;
        if ($session->school_id != $school_id) {
            toast(transMsg('Session not found'), 'error')->timerProgressBar();
            return redirect()->back();
        }
        request()->validate([
            'schoolyear' => 'required|string|unique:sessions,schoolyear,' . $session->id . ',id,school_id,' . $school_id,
            'status' => 'required|numeric|min:1|max:2',
        ]);
        $data = $request->except(['_token', '_method']);
        $data['status'] = ($request->status == 1) ? 1 : 2;
        $session->fill($data)->save();
        if ($request->status == 1) {
            $this->session->bySchool($session->school_id)->where('id', '!=', $session->id)->update(array('status' => 2));
        }
        toast(transMsg('Update successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.session.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Session $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        if ($session->school_id != auth()->user()->school_id) {
            toast(transMsg('Session not found'), 'error')->timerProgressBar();
            return redirect()->back();
        }
        if (CourseConfig::bySchool(auth()->user()->school_id)->where('session_id', $session->id)->exists()) {
            $message = $session->schoolyear . ' already join ' . subjectOrCourseName() . ' group, can not delete this';
            toast(transMsg($message), 'info')->timerProgressBar();
            return redirect()->back();
        }
        if (StudentInfo::where('session', $session->id)->exists()) {
            $message = $session->schoolyear . ' already take an students, can not delete this';
            toast(transMsg($message), 'info')->timerProgressBar();
            return redirect()->back();
        }
        $session->delete();
        toast(transMsg('Delete successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.session.index');
    }
}
