<?php

namespace App\Http\Controllers;

use App\Syllabus as Syllabus;
use App\Http\Resources\SyllabusResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SyllabusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = Syllabus::with('myclass')
            ->bySchool(\Auth::user()->school_id)
            ->get();
        $classes = \App\Myclass::bySchool(\Auth::user()->school->id)
            ->get();
        $classeIds = $classes->pluck('id')->toArray();
        $sections = \App\Section::whereIn('class_id', $classeIds)->where('section_number','Not like','admission')
            ->get();
        return view('syllabus.course-syllabus', ['files' => $files, 'classes' => $classes, 'sections' => $sections, 'class_id' => 0]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $class_id)
    {
        try {
            if (Schema::hasColumn('syllabuses', 'class_id')) {
                $files = Syllabus::with('myclass')
                    ->bySchool(\Auth::user()->school_id)
                    ->where('class_id', $class_id)
                    ->where('active', 1)
                    ->get();
                $classes = \App\Myclass::bySchool(\Auth::user()->school->id)
                    ->get();
            } else {
                return '<code>class_id</code> column missing. Run <code>php artisan migrate</code>';
            }
        } catch (Exception $ex) {
            return 'Something went wrong!!';
        }

        return view('syllabus.course-syllabus', ['files' => $files, 'classes' => $classes, 'class_id' => $class_id]);
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
            'title' => 'required|string|max:255',
            'file' => 'required|mimes:pdf,doc,docx,png,jpeg,jpg|max:2048'
        ]);
        $school_id = Auth::user()->school_id;
        $tb = new Syllabus;
        $tb->file_path = multiFileUpload($request->file);
        $tb->title = $request->title;
        $tb->active = 1;
        $tb->school_id = $school_id;
        $tb->user_id = Auth::user()->id;
        $tb->save();
        \Cache::forget('syllabuses-' . $school_id);
        toast('Syllabus Created Successfully', 'success')->timerProgressBar();
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
        return new SyllabusResource(Syllabus::find($id));
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
    public function update($id, $status)
    {
        $school_id = Auth::user()->school_id;
        $tb = Syllabus::byschool($school_id)->find($id);
        if (empty($tb)) {
            toast('Syllabus does not exists', 'info')->timerProgressBar();
            return redirect()->back();
        }
        $tb->active = ($status == 1 ? 0 : 1);
        $tb->save();
        \Cache::forget('syllabuses-' . $school_id);
        $msg = 'Syllabus ' . ($status == 0 ? 'Published' : 'Unpublished') . ' Successfully';
        toast($msg, 'success')->timerProgressBar();
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
        $syllabus = Syllabus::find($id);
        \Cache::forget('syllabuses-' . $syllabus->school_id);
        unlinkS3File($syllabus->file_path);
        $syllabus->delete();
        $msg = 'Syllabus Delete Successfully';
        toast($msg, 'success')->timerProgressBar();
        return back();

        return ($syllabus->delete()) ? response()->json([
            'status' => 'success'
        ]) : response()->json([
            'status' => 'error'
        ]);
    }
}
