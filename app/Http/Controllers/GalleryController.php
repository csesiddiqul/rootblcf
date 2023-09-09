<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['gallerys'] = Gallery::bySchool(Auth::user()->school->id)->get();
        return view('gallery.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallery.create');

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

        $gallery = new Gallery();
        $gallery->school_id = auth()->user()->school_id;
        $gallery->title = $request['title'];
        $gallery->description = $request['description'];
        $gallery->status = $request['status'];
        $gallery->photo = (!empty($request->url)) ? fileUpload($request->url, 'GP') : '';
        $gallery->save();
        toast(transMsg('Gallery Created successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.gallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        $data['gallery'] = $gallery;
        return view('gallery.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        request()->validate([
            'url' => 'nullable|string',
            'status' => 'required|numeric',
        ]);
        $gallery->school_id = auth()->user()->school_id;
        $gallery->title = $request->title;
        $gallery->description = $request->description;
        $gallery->status = $request->status;
        if (!empty($request->url)) {
            unlinkS3File($gallery->photo);
            $gallery->photo = fileUpload($request->url, 'GP');
        }
        $gallery->save();
        toast(transMsg('Gallery  Update successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        unlinkS3File($gallery->photo);
        $gallery->delete();
        toast(transMsg('Gallery Delete successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.gallery.index');

    }
}
