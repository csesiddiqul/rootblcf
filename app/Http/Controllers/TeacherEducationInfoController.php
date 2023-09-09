<?php

namespace App\Http\Controllers;

use App\User;
use App\TeacherEducationInfo;
use Illuminate\Http\Request;

class TeacherEducationInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::find($_REQUEST['id']);
        if (empty($user)) {
            return abort('404');
        }
        session()->put('teacher_info_user_id', $_REQUEST['id']);
        $teacherEducationInfos = TeacherEducationInfo::whereUser_id($_REQUEST['id'])->get();
        return view('teacherEducationInfo.create', compact('teacherEducationInfos'));
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
            'level_of_education' => 'required|array',
            'exam_degree_title' => 'required|array',
            'group' => 'required|array',
            'result' => 'required|array',
            'year_of_passing' => 'required|array',
            'duration' => 'required|array',
            'institution' => 'required|array'
        ]);
        $id = session()->get('teacher_info_user_id');
        $infodatas = array();
        $count = count($request->level_of_education);
        for ($i = 0; $i < $count; $i++) {
            $infodata = array(
                'user_id' => $id,
                'level_of_education' => $request['level_of_education'][$i],
                'exam_degree_title' => $request['exam_degree_title'][$i],
                'others' => $request['others'][$i],
                'result' => $request['result'][$i],
                'group' => $request['group'][$i],
                'institution' => $request['institution'][$i],
                'duration' => $request['duration'][$i],
                'year_of_passing' => $request['year_of_passing'][$i],
                'created_at' => now(),
                'updated_at' => now(),
            );
            $infodatas[] = $infodata;
        }
        TeacherEducationInfo::insert($infodatas);
        session()->forget('teacher_info_user_id');
        toast(transMsg('Education summary has been save successfully.'), 'success')->focusCancel(true)->timerProgressBar();
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
    public function update(Request $request, TeacherEducationInfo $teacherinfo)
    {
        $this->validate($request, [
            'exam_degree_title' => 'required'
        ]);
        $request['exam_degree_title'] = $request->exam_degree_title;
        $teacherinfo->update($request->all());
        toast(transMsg('Education summary has been updated successfully.'), 'success')->focusCancel(true)->timerProgressBar();
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
        TeacherEducationInfo::destroy($id);
        toast(transMsg('Education summary was deleted successfully.'), 'success')->focusCancel(true)->timerProgressBar();
        return back();
    }
}
