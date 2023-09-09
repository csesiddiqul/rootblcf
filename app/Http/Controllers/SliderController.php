<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['slider'] = Slider::bySchool(Auth::user()->school->id)->get();
        return view('slider.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'nullable|string',
            'link' => 'nullable|string',
            'shortdrc' => 'nullable|string',
            'priority' => 'nullable|numeric',
            'status' => 'required|numeric',
            'url' => 'required|string',
        ],[
            'url.required' => transMsg('Image filed is required'),
            'url.string' => transMsg('Image is string'),
        ]);
        $tb = new Slider();
        $tb->school_id = auth()->user()->school_id;
        $tb->title = $request['title'];
        $tb->link = $request['link'];
        $tb->shortdrc = $request['shortdrc'];
        $tb->priority = $request['priority'];
        $tb->status = $request['status'];
        $tb->image = (!empty($request->url)) ? fileUpload($request->url,'MS') : '';
        $tb->save();
        toast(transMsg('Slider Created successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.slider.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
      return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        $data['slider'] = $slider;
        return view('slider.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    { 
        request()->validate([
            'title' => 'nullable|string',
            'link' => 'nullable|string',
            'shortdrc' => 'nullable|string',
            'priority' => 'nullable|numeric',
            'status' => 'required|numeric',
        ]);
        $slider->school_id = auth()->user()->school_id;
        $slider->title = $request->title;
        $slider->link = $request->link;
        $slider->shortdrc = $request->shortdrc;
        $slider->priority = $request->priority;
        $slider->status = $request->status;
        if (!empty($request->url)) { 
            unlinkS3File($slider->image);
            $slider->image = fileUpload($request->url,'MS'); 
        }
        $slider->save();
        toast(transMsg('Slider Update successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        unlinkS3File($slider->image);
        $slider->delete();
        toast(transMsg('Slider Delete successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.slider.index');
    }
}
