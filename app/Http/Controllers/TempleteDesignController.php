<?php

namespace App\Http\Controllers;

use App\TempleteDesign;
use App\Admission;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class TempleteDesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['templetes'] = TempleteDesign::bySchool(Auth::user()->school->id)->get();
        return view('admitcard.create', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('academic.template.index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'heading' => 'required|string',
            'examname' => 'required|string',
            'examcenter' => 'required|string',
        ]);
        $template = new TempleteDesign();
        $template->type = ($request->type == 1 ? 1 : ($request->type == 2 ? 2 : 3));
        $template->name = $request->name;
        $template->heading = $request->heading;
        $template->examname = $request->examname;
        $template->examdate = date('Y-m-d', strtotime($request['examdate']));
        $template->examcenter = $request->examcenter;

        $template->info_position = ($request->info_position == 1) ? 1 : 2;
        $template->is_name = $request->is_name;
        $template->is_fname = $request->is_fname;
        $template->is_mname = $request->is_mname;
        $template->is_email = $request->is_email;
        $template->is_phone = $request->is_phone;
        $template->is_address = $request->is_address;
        $template->is_admission_id = $request->is_admission_id;
        $template->is_st_id = $request->is_st_id;
        $template->is_photo = $request->is_photo;
        $template->photo_position = ($request->photo_position == 1) ? 1 : 2;
        $template->is_class = $request->is_class;
        $template->is_section = $request->is_section;
        $template->is_session = $request->is_session;
        $template->page = ($request->page == 'a4') ? 'a4' : 'a5';
        $template->lsign_title = $request->lsign_title;
        $template->msign_title = $request->msign_title;
        $template->rsign_title = $request->rsign_title;
        $template->bodyText = filter_var($request->bodyText, FILTER_SANITIZE_STRING);
        $template->footerText = filter_var($request->footerText, FILTER_SANITIZE_STRING);
        $template->llogo = (!empty($request->llogo)) ? fileUpload($request->llogo, 'TEMPLETE') : '';
        $template->mlogo = (!empty($request->mlogo)) ? fileUpload($request->mlogo, 'TEMPLETE') : '';
        $template->rlogo = (!empty($request->rlogo)) ? fileUpload($request->rlogo, 'TEMPLETE') : '';
        $template->lsign = (!empty($request->lsign)) ? fileUpload($request->lsign, 'TEMPLETE') : '';
        $template->msign = (!empty($request->msign)) ? fileUpload($request->msign, 'TEMPLETE') : '';
        $template->rsign = (!empty($request->rsign)) ? fileUpload($request->rsign, 'TEMPLETE') : '';
        $template->status = ($request->status == 1) ? 1 : 2;
        $template->school_id = Auth::user()->school_id;
        $template->save();
        toast(transMsg('Template Created Successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.template.create');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\TempleteDesign $templateDesign
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['admission'] = Admission::bySchool(\school('id'))->first();
        $data['admitTemplete'] = $admitTemplete = TempleteDesign::bySchool(auth()->user()->school_id)->find($id);

        if (empty($admitTemplete)) {
            return redirect()->back();
        }
        $data['footerFalse'] = 0;
        /*return $data;*/
        return view('admitcard.show', $data);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\TempleteDesign $templateDesign
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $template = TempleteDesign::find($id);
        if ($template->school_id != Auth::user()->school_id) {
            return redirect()->back();
        }
        $data['template'] = $template;
        $data['templetes'] = TempleteDesign::bySchool(Auth::user()->school->id)->paginate(15);
        view()->share($data);
        return view('admitcard.create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\TempleteDesign $templateDesign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $template = TempleteDesign::find($id);
        if ($template->school_id != Auth::user()->school_id) {
            return redirect()->back();
        }

        $request->validate([

            'name' => 'required|string',
            'heading' => 'required|string',
            'examname' => 'required|string',
            'examcenter' => 'required|string',
        ]);

        $template->name = $request->name;
        $template->heading = $request->heading;
        $template->examname = $request->examname;
        $template->examdate = date('Y-m-d', strtotime($request['examdate']));
        $template->examcenter = $request->examcenter;
        $template->type = ($request->type == 1 ? 1 : ($request->type == 2 ? 2 : 3));
        $template->info_position = ($request->info_position == 1) ? 1 : 2;
        $template->is_name = $request->is_name;
        $template->is_fname = $request->is_fname;
        $template->is_mname = $request->is_mname;
        $template->is_email = $request->is_email;
        $template->is_phone = $request->is_phone;
        $template->is_address = $request->is_address;
        $template->is_admission_id = $request->is_admission_id;
        $template->is_st_id = $request->is_st_id;
        $template->is_photo = $request->is_photo;
        $template->photo_position = ($request->photo_position == 1) ? 1 : 2;
        $template->is_class = $request->is_class;
        $template->is_section = $request->is_section;
        $template->is_session = $request->is_session;
        $template->llogo = (!empty($request->llogo)) ? fileUpload($request->llogo, 'TEMPLETE') : $template->llogo;
        $template->mlogo = (!empty($request->mlogo)) ? fileUpload($request->mlogo, 'TEMPLETE') : $template->mlogo;
        $template->rlogo = (!empty($request->rlogo)) ? fileUpload($request->rlogo, 'TEMPLETE') : $template->rlogo;
        $template->lsign = (!empty($request->lsign)) ? fileUpload($request->lsign, 'TEMPLETE') : $template->lsign;
        $template->msign = (!empty($request->msign)) ? fileUpload($request->msign, 'TEMPLETE') : $template->msign;
        $template->rsign = (!empty($request->rsign)) ? fileUpload($request->rsign, 'TEMPLETE') : $template->rsign;

        $template->page = ($request->page == 'a4') ? 'a4' : 'a5';

        $template->lsign_title = $request->lsign_title;
        $template->msign_title = $request->msign_title;
        $template->rsign_title = $request->rsign_title;

        $template->bodyText = filter_var($request->bodyText, FILTER_SANITIZE_STRING);
        $template->footerText = filter_var($request->footerText, FILTER_SANITIZE_STRING);


        $template->status = ($request->status == 1) ? 1 : 2;


        $template->save();
        toast(transMsg('Template Update Successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.template.create');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\TempleteDesign $templateDesign
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $template = TempleteDesign::find($id);
        if ($template->school_id == Auth::user()->school_id) {
            $template->delete();
        }
        toast(transMsg('Template Delete successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.template.create');
    }

    public function removetempleteImg($id, $name)
    {
        $templete = TempleteDesign::bySchool(Auth::user()->school_id)->find($id);
        if (!empty($templete)) {

            $templete->$name = null;
            $templete->save();
            return response()->json(['msg' => transMsg('updated Successfully'), 'status' => '200']);
        }
        return response()->json(['msg' => transMsg('data not found'), 'status' => '404']);
    }


}
