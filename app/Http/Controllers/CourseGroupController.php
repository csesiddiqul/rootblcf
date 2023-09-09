<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseGroup;
use App\Http\Controllers\Controller;
use App\Myclass;
use App\Services\Course\CourseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['courseGroup'] = $this->courseGroup->bySchool(auth()->user()->school_id)->get();
        return view('coursegroup.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['classes'] = $this->courseGroup->bySchool(auth()->user()->school_id)->whereStatus(1)->pluck('name', 'id');
        $data['courses'] = $this->course->bySchool(auth()->user()->school_id)->whereStatus(1)->orderBy('name')->get();
        return view('coursegroup.create', $data);
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
            'name' => 'required|string|unique:course_groups',
            'description' => 'nullable|string',
            'status' => 'required|numeric',
            'course' => 'required|array|distinct',
        ], [
            'course.required' => transMsg('The ' . $this->cName . ' field is required'),
            'course.array' => transMsg('The ' . $this->cName . ' must be an array'),
            'course.distinct' => transMsg('The ' . $this->cName . ' field has a duplicate value')
        ]);
        $user = auth()->user();
        $courses = implode(',', $request->course);
        if ($this->courseGroup->bySchool($user->school_id)->whereCourse($courses)->exists()) {
            $message = ['course' => $this->cName . ' Already exists'];
            return redirect()->back()->withErrors($message)->withInput($request->all());
        }
        $data = request()->except(['_token', '_method']);
        $data['status'] = $request->status == 1 ? 1 : 2;
        $data['course'] = $courses;
        if ($request->optional) {
            $data['optional'] = implode(',', $request->optional);
        }
        if ($request->countiAss) {
            $data['countiAss'] = implode(',', $request->countiAss);
        }
        $data['school_id'] = $user->school_id;
        $this->courseGroup->create($data);
        toast(transMsg('Created successfully.'), 'success')->timerProgressBar();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\CourseGroup $courseGroup
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\CourseGroup $courseGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $coursegroup = $this->courseGroup->bySchool($user->school_id)->find($id);
        if (empty($coursegroup)) {
            toast(transMsg($this->cName . ' is not exists.'), 'info')->timerProgressBar();
            return redirect()->back();
        }
        $data['classes'] = $this->class->bySchool($user->school_id)->whereStatus(1)->pluck('name', 'id');
        $data['courses'] = $this->course->bySchool($user->school_id)->whereStatus(1)->orderBy('name')->get();
        $data['coursegroup'] = $coursegroup;
        return view('coursegroup.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\CourseGroup $courseGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required|string|unique:course_groups,name,' . $id . ',id,school_id,' . $user->school_id,
            'description' => 'nullable|string',
            'status' => 'required|numeric',
            'course' => 'required|array|distinct',
        ], [
            'course.required' => transMsg('The ' . $this->cName . ' field is required'),
            'course.array' => transMsg('The ' . $this->cName . ' must be an array'),
            'course.distinct' => transMsg('The ' . $this->cName . ' field has a duplicate value')
        ]);
        $courses = implode(',', $request->course);
        if ($this->courseGroup->bySchool($user->school_id)->whereCourse($courses)->whereNotIn('id', [$id])->exists()) {
            $message = ['course' => $this->cName . ' Already exists'];
            return redirect()->back()->withErrors(transMsg($message))->withInput($request->all());
        }
        $coursegroup = $this->courseGroup->bySchool($user->school_id)->find($id);
        if ($coursegroup) {
            $data = request()->except(['_token', '_method']);
            $data['status'] = $request->status == 1 ? 1 : 2;
            $data['course'] = $courses;
            if ($request->optional) {
                $data['optional'] = implode(',', $request->optional);
            } else {
                $data['optional'] = null;
            }
            if ($request->countiAss) {
                $data['countiAss'] = implode(',', $request->countiAss);
            } else {
                $data['countiAss'] = null;
            }
            $coursegroup->fill($data)->save();
            toast(transMsg('Updated successfully.'), 'success')->timerProgressBar();
            return redirect()->route('academic.coursegroup.index');
        }
        toast(transMsg($this->cName . ' not found.'), 'error')->timerProgressBar();
        return redirect()->route('academic.coursegroup.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\CourseGroup $courseGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return back();
    }
}
