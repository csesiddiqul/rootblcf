<?php

namespace App\Http\Controllers;

use App\Testimonial;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['testimonials'] = Testimonial::bySchool(Auth::user()->school->id)->get();
        return view('testimonial.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('testimonial.create');
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
            'url' => 'required|string',
            'status' => 'required|numeric',
        ], [
            'url.required' => transMsg('Photo is required')
        ]);

        $testimonial = new Testimonial();
        $testimonial->school_id = auth()->user()->school_id;
        $testimonial->title = $request['title'];
        $testimonial->message = $request['message'];
        $testimonial->status = $request['status'];
        $testimonial->photo = (!empty($request->url)) ? fileUpload($request->url, 'TP') : '';
        $testimonial->save();
        toast(transMsg('Testimonial Created successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.testimonial.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Testimonial $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Testimonial $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        $data['testimonial'] = $testimonial;
        return view('testimonial.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Testimonial $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        request()->validate([
            'status' => 'required|numeric',
        ]);
        $testimonial->school_id = auth()->user()->school_id;
        $testimonial->title = $request->title;
        $testimonial->message = $request->message;
        $testimonial->status = $request->status;
        if (!empty($request->url)) {
            unlinkS3File($testimonial->photo);
            $testimonial->photo = fileUpload($request->url, 'TP');
        }
        $testimonial->save();
        toast(transMsg('Testimonial updated successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.testimonial.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Testimonial $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        unlinkS3File($testimonial->photo);
        $testimonial->delete();
        toast(transMsg('Testimonial Delete successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.testimonial.index');
    }
}
