<?php

namespace App\Http\Controllers;

use App\BreakingNews;
use App\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BreakingNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breaking_newses = BreakingNews::bySchool(Auth::user()->school_id)->where('status', '!=', '0')->get();
        return view('breakingNews.index', compact('breaking_newses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['notice'] = Notice::bySchool(auth()->user()->school_id)->where('active', 1)->pluck('title', 'id');
        return view('breakingNews.create', $data);
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
            'notice_id' => 'nullable|numeric',
            'priority' => 'required|numeric',
            'status' => 'required|numeric',
            'title' => 'required|string'
        ]);
        $data = request()->except(['_token', '_method']);
        $data['status'] = $request->status == 1 ? 1 : 2;
        $data['user_id'] = Auth::user()->id;
        $data['school_id'] = Auth::user()->school_id;
        BreakingNews::create($data);
        toast(transMsg('Created successfully.'), 'success')->timerProgressBar();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\BreakingNews $breakingNews
     * @return \Illuminate\Http\Response
     */
    public function show(BreakingNews $breakingNews)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\BreakingNews $breakingNews
     * @return \Illuminate\Http\Response
     */
    public function edit(BreakingNews $breakingNews)
    {
        $data['notice'] = Notice::bySchool(auth()->user()->school_id)->where('active', 1)->pluck('title', 'id');
        $data['breakingNews'] = $breakingNews;
        return view('breakingNews.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\BreakingNews $breakingNews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BreakingNews $breakingNews)
    {
        $request->validate([
            'notice_id' => 'nullable|numeric',
            'priority' => 'required|numeric',
            'status' => 'required|numeric',
            'title' => 'required|string'
        ]);
        $data = request()->except(['_token', '_method']);
        $data['status'] = $request->status == 1 ? 1 : 2;
        $data['user_id'] = Auth::user()->id;
        $breakingNews->update($data);
        toast(transMsg('Updated successfully.'), 'success')->timerProgressBar();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\BreakingNews $breakingNews
     * @return \Illuminate\Http\Response
     */
    public function destroy(BreakingNews $breakingNews)
    {
        $breakingNews->status = 0;
        $breakingNews->user_id = Auth::user()->id;
        $breakingNews->save();
        toast(transMsg('Delete successfully.'), 'success')->timerProgressBar();
        return redirect()->back();
    }
}
