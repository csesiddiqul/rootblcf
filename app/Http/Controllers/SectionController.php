<?php

namespace App\Http\Controllers;

use App\ExamForClass;
use App\Myclass;
use App\Section;
use App\Http\Resources\SectionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Myclass::bySchool(auth()->user()->school_id)->get();
        $classIds = $classes->pluck('id')->toArray();
        $sections = Section::whereIn('class_id', $classIds)->orderBy('class_id')->get();
        $exams = ExamForClass::whereIn('class_id', $classIds)->where('active', 1)->groupBy('class_id')->get();
        return view('school.sections', [
            'classes' => $classes,
            'sections' => $sections,
            'exams' => $exams
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($class_id)
    {
        $class = Myclass::find($class_id);
        if (empty($class) || $class->school_id != Auth::user()->school->id)
            return redirect()->back()->with('warning', 'Class not found');
        $data['sections'] = Section::whereClass_id($class_id)->paginate(15);
        $data['class'] = $class;
        return View::make('section.index', $data);
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
            'section_number' => 'required|string',
            'room_number' => 'required|numeric',
            'class_id' => 'required|numeric',
            'add_total' => 'nullable|numeric',
            'add_amount' => 'nullable|numeric',
            'lottery_on_mark' => 'nullable|numeric',
        ]);
        $tb = new Section;
        $tb->section_number = $request->section_number;
        $tb->room_number = $request->room_number;
        $tb->class_id = $request->class_id;
        $tb->user_id = Auth::user()->id;
        if (strtolower($request->section_number) == 'admission') {
            $tb->add_total = $request->add_total;
            $tb->add_amount = $request->add_amount;
            $tb->lottery_on_mark = $request->lottery_on_mark;
        }
        $tb->save();
        toast(transMsg('Created successfully.'), 'success')->timerProgressBar();
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
        return new SectionResource(Section::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($class_id, $id)
    {
        $class = Myclass::find($class_id);
        if (empty($class) || $class->school_id != Auth::user()->school->id)
            return redirect()->back()->with('warning', 'Class not found');
        $section = Section::find($id);
        if (empty($section)) {
            return redirect()->back()->with('warning', 'Class section not found');
        }
        $data['section'] = $section;
        $data['class'] = $class;
        return View::make('section.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $class_id, $id)
    {
        $class = Myclass::bySchool(Auth::user()->school->id)->find($class_id);
        if (empty($class))
            return redirect()->back()->with('warning', transMsg('Class not found'));

        $tb = Section::find($id);
        if (empty($tb)) {
            return redirect()->back()->with('warning', transMsg('Class section not found'));
        }
        $tb->section_number = $request->section_number;
        $tb->room_number = $request->room_number;
        $tb->class_id = $class_id;
        $tb->status = ($request->status == 1) ? 1 : 2;
        $tb->user_id = Auth::user()->id;
        if (strtolower($request->section_number) == 'admission') {
            $tb->add_total = $request->add_total;
            $tb->add_amount = $request->add_amount;
            $tb->lottery_on_mark = $request->lottery_on_mark;
            $tb->waiting_1 = $request->waiting_1;
            $tb->waiting_2 = $request->waiting_2;
            $tb->waiting_3 = $request->waiting_3;
        }
        $tb->save();
        toast(transMsg('Updated successfully.'), 'success')->timerProgressBar();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (Section::destroy($id)) ? response()->json([
            'status' => 'success'
        ]) : response()->json([
            'status' => 'error'
        ]);
    }
}
