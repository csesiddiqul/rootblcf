<?php

namespace App\Http\Controllers;

use App\Routine as Routine;
use App\Http\Resources\RoutineResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = Routine::with('section')
            ->bySchool(\Auth::user()->school_id)
            ->get();
        $classes = \App\Myclass::bySchool(\Auth::user()->school->id)
            ->orderByRaw('CONVERT(class_number, SIGNED) asc')
            ->get();
        $classeIds = $classes->pluck('id')->toArray();
        $sections = \App\Section::whereIn('class_id', $classeIds)->where('section_number','Not like','admission')
            ->get();
        return view('routines.create', [
            'files' => $files,
            'classes' => $classes,
            'sections' => $sections,
            'section_id' => 0
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $section_id)
    {
        try {
            if (Schema::hasColumn('routines', 'section_id')) {
                $files = Routine::with('section')
                    ->bySchool(\Auth::user()->school_id)
                    ->where('section_id', $section_id)
                    ->where('active', 1)
                    ->get();
                $classes = \App\Myclass::bySchool(\Auth::user()->school->id)
                    ->get();
                $classeIds = \App\Myclass::bySchool(\Auth::user()->school->id)
                    ->pluck('id')
                    ->toArray();
                $sections = \App\Section::whereIn('class_id', $classeIds)
                    ->orderBy('section_number')
                    ->get();
            } else {
                return '<code>section_id</code> column missing. Run <code>php artisan migrate</code>';
            }
        } catch (Exception $ex) {
            return __('Something went wrong!!');
        }
        return view('routines.create', [
            'files' => $files,
            'classes' => $classes,
            'sections' => $sections,
            'section_id' => $section_id
        ]);
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
        $tb = new Routine;
        $tb->file_path = multiFileUpload($request->file);
        $tb->title = $request->title;
        $tb->active = 1;
        $tb->school_id = $school_id;
        $tb->user_id = Auth::user()->id;
        $tb->save();
        \Cache::forget('routines-' . $school_id);
        toast('Routine Created Successfully', 'success')->timerProgressBar();
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
        return new RoutineResource(Routine::find($id));
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
        $tb = Routine::byschool($school_id)->find($id);
        if (empty($tb)) {
            toast('Routine does not exists', 'info')->timerProgressBar();
            return redirect()->back();
        }
        $tb->active = ($status == 1 ? 0 : 1);
        $tb->save();
        \Cache::forget('routines-' . $school_id);
        $msg = 'Routine ' . ($status == 0 ? 'Published' : 'Unpublished') . ' Successfully';
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
        $routine = Routine::find($id);
        unlinkS3File($routine->file_path);
        \Cache::forget('routines-' . $routine->school_id);
        $routine->delete();
        $msg = 'Routine Delete Successfully';
        toast($msg, 'success')->timerProgressBar();
        return back();

        return ($routine->delete()) ? response()->json([
            'status' => 'success'
        ]) : response()->json([
            'status' => 'error'
        ]);
    }
}
