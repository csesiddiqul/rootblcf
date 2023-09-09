<?php

namespace App\Http\Controllers;

use App\Myclass;
use App\School;
use App\Http\Resources\ClassResource;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class MyclassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getClass()
    {
        $data['school'] = $school = Auth::user()->school;
        $data['classes'] = $this->class->orderByRaw('CONVERT(class_number, SIGNED) asc')->bySchool($school->id)->get();
        $data['pluckClass'] = $this->class->bySchool($school->id)->status()->orderByRaw('CONVERT(class_number, SIGNED) asc')->pluck('name', 'id');
        return view('class.index', $data);
    }

    public function index($school_id)
    {
        return ($school_id > 0) ? ClassResource::collection($this->class->bySchool($school_id)->get()) : response()->json([
            'Invalid School id: ' . $school_id,
            404
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        return back();
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
            'class_number' => 'required|numeric|min:0'
        ]);
        $tb = new Myclass;
        $tb->name = $request->name;
        $tb->class_number = $request->class_number;
        $tb->school_id = \Auth::user()->school_id;
        $tb->group = (!empty($request->group)) ? $request->group : '';
        $tb->save();
        return back()->with('status', __('Created'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ClassResource($this->class->find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class = $this->class->find($id);
        if (empty($class))
            return abort('404');
        $data['class'] = $class;
        $data['school'] = School::find(\Auth::user()->school->id);
        View::share($data);
        return View::make('class.edit');
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
            'name' => 'required|string',
            'class_number' => 'required|numeric|min:0'
        ]);

        $tb = $this->class->find($id);
        if (empty($tb))
            return abort('404');
        $tb->name = $request->name;
        $tb->class_number = $request->class_number;
        $tb->group = $request->group;
        $tb->status = ($request->status == 1) ? 1 : 2;
        $tb->save();
        return redirect()->route('academic.class')->with('status', 'Updated Class');
        /*return ($tb->save()) ? response()->json([
            'status' => 'success'
        ]) : response()->json([
            'status' => 'error'
        ]);*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ($this->class->destroy($id)) ? response()->json([
            'status' => 'success'
        ]) : response()->json([
            'status' => 'error'
        ]);
    }
}
