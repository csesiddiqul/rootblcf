<?php

namespace App\Http\Controllers;

use App\TransferCertificate;
use App\User;
use App\Admission;
use App\Myclass;
use App\Section;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TransferCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tcs'] = TransferCertificate::bySchool(Auth::user()->school->id)->get();
        return view('tc.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tc.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate([
            'first_ad_class' => 'required|string',
            'remark' => 'required|string',
            'laststudied' => 'required|string',
            'dues' => 'required|string',
            'behaviour' => 'required|string',
            'reason' => 'required|string',
            'date' => 'required|date',
            'date_lastclass' => 'required|date',
        ]);
        $tc = new TransferCertificate();
        $tc->school_id = auth()->user()->school_id;
        $tc->user_id = auth()->user()->id;
        $tc->student_id = $request['student'];
        $tc->first_ad_class = $request['first_ad_class'];
        $tc->remark = $request['remark'];
        $tc->laststudied = $request['laststudied'];
        $tc->dues = $request['dues'];
        $tc->behaviour = $request['behaviour'];
        $tc->reason = $request['reason'];
        $tc->date = date('Y-d-m', strtotime($request['date']));
        $tc->date_lastclass = date('Y-d-m', strtotime($request['date_lastclass']));
        $tc->save();
        $this->user->find($request['student'])->update(['active' => 3]);
        toast(transMsg('Generate successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.tc.index');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Tc $tc
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['admission'] = Admission::bySchool(\school('id'))->first();
        $data['tc'] = TransferCertificate::bySchool(\auth()->user()->school_id)->find($id);
        return view('certificates.tc', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Tc $tc
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $school_id = auth()->user()->school_id;
        $data['tc'] = $tc = TransferCertificate::bySchool($school_id)->find($id);
        $data['studentPluck'] = $this->user->bySchool($school_id)->where('section_id', $tc->student->section_id)->pluck('name', 'id');
        return view('tc.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Tc $tc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransferCertificate $tc)
    {
        request()->validate([
            'first_ad_class' => 'required|string',
            'remark' => 'required|string',
            'laststudied' => 'required|string',
            'dues' => 'required|string',
            'behaviour' => 'required|string',
            'reason' => 'required|string',
            'date' => 'required|date',
            'date_lastclass' => 'required|date',
        ]);

        $tc->school_id = auth()->user()->school_id;
        $tc->user_id = auth()->user()->id;
        $tc->student_id = $request['student'];
        $tc->first_ad_class = $request->first_ad_class;
        $tc->remark = $request->remark;
        $tc->laststudied = $request->laststudied;
        $tc->dues = $request->dues;
        $tc->behaviour = $request->behaviour;
        $tc->reason = $request->reason;
        $tc->date = date('Y-d-m', strtotime($request->date));
        $tc->date_lastclass = date('Y-d-m', strtotime($request->date_lastclass));
        $tc->save();
        toast(transMsg('Update successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.tc.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Tc $tc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tc = TransferCertificate::bySchool(\auth()->user()->school_id)->find($id);
        $tc->delete();
        toast(transMsg('Delete successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.tc.index');
    }
}
