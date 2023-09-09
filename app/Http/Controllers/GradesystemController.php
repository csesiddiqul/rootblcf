<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gradesystem as Gradesystem;

class GradesystemController extends Controller
{
    protected $gradesystem;

    public function __construct(Gradesystem $gradesystem)
    {
        parent::__construct();
        $this->gradesystem = $gradesystem;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['gpas'] = $this->gradesystem->bySchool(auth()->user()->school_id)->orderBy('grade_system_name', 'ASC')->orderBy('point', 'DESC')->get();
        $data['gpaCount'] = $this->gradesystem->bySchool(auth()->user()->school_id)->groupBy('grade_system_name')->get()->count();
        return view('gpa.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gpa.create');
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
            'grade_system_name' => 'required|string|max:255',
            'point' => 'required',
            'grade' => 'required',
            'from_mark' => 'required',
            'to_mark' => 'required',
        ]);
        $gpa = new $this->gradesystem;
        $gpa->grade_system_name = $request->grade_system_name;
        $gpa->point = $request->point;
        $gpa->grade = $request->grade;
        $gpa->from_mark = $request->from_mark;
        $gpa->to_mark = $request->to_mark;
        $gpa->school_id = \Auth::user()->school_id;
        $gpa->user_id = \Auth::user()->id;
        $gpa->save();
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
        return redirect()->route('gpa.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['gpa'] = $gpa = $this->gradesystem->bySchool(auth()->user()->school_id)->find($id);
        if (empty($gpa)) {
            toast(transMsg('Grade System not found !'), 'error')->timerProgressBar();
            return back();
        }
        return view('gpa.edit', $data);
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
        $request->validate([
            'grade_system_name' => 'required|string|max:255',
            'point' => 'required',
            'grade' => 'required',
            'from_mark' => 'required',
            'to_mark' => 'required',
        ]);
        $gpa = $this->gradesystem->bySchool(auth()->user()->school_id)->find($id);
        if (empty($gpa)) {
            toast(transMsg('Grade System not found !'), 'error')->timerProgressBar();
            return back();
        }
        $gpa->grade_system_name = $request->grade_system_name;
        $gpa->point = $request->point;
        $gpa->grade = $request->grade;
        $gpa->from_mark = $request->from_mark;
        $gpa->to_mark = $request->to_mark;
        $gpa->save();
        toast(transMsg('Updated Successfully.'), 'success')->timerProgressBar();
        return redirect()->route('gpa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gpa = $this->gradesystem->bySchool(auth()->user()->school_id)->find($id);
        $gpa->delete();
        toast(transMsg('Deleted Successfully.'), 'success')->timerProgressBar();
        return back();
    }
}
