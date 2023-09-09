<?php

namespace App\Http\Controllers;

use App\Notice as Notice;
use App\Http\Resources\NoticeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = Notice::bySchool(Auth::user()->school_id)->get();
        return view('notices.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notices.create');
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
            'file' => 'required|mimes:pdf,xlx,xlsx,xls,csv,doc,docx,ppt,pptx,txt,png,jpeg,jpg|max:2048',
            'description' => 'required|string',
            'title' => 'required|string'
        ]);
        $school_id = Auth::user()->school_id;
        $tb = new Notice;
        $tb->title = $request->title;
        $tb->slug = renderSlug($request->title, 'Notice');
        $tb->description = $request->description;
        $tb->file_path = multiFileUpload($request->file);
        $tb->active = 1;
        $tb->school_id = $school_id;
        $tb->user_id = Auth::user()->id;
        $tb->save();
        \Cache::forget('notices-' . $school_id);
        toast(transMsg('Notice Created Successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.notice.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new NoticeResource(Notice::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $notice = Notice::find($id);
        if (empty($notice) || $notice->active == 0 || $notice->school_id != Auth::user()->school_id) {
            toast(transMsg('Notice doesnt exists'), 'info')->timerProgressBar();
            return redirect()->route('academic.notice.index');
        }
        if ($request->isMethod('POST')) {
            $request->validate([
                'file' => 'nullable|mimes:pdf,xlx,xlsx,xls,csv,doc,docx,ppt,pptx,txt,png,jpeg,jpg|max:2048',
                'description' => 'required|string',
                'title' => 'required|string'
            ]);
            $notice->title = $request->title;
            $notice->description = $request->description;
            if ($request->hasFile('file')) {
                unlinkS3File($notice->file_path);
                $notice->file_path = multiFileUpload($request->file);
            }
            $notice->save();
            toast(transMsg('Notice Updated Successfully'), 'success')->timerProgressBar();
            return redirect()->route('academic.notice.index');
        }
        return view('notices.edit', compact('notice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, $status)
    {
        $school_id = Auth::user()->school_id;
        $tb = Notice::byschool($school_id)->find($id);
        if (empty($tb)) {
            toast(transMsg('Notice does not exists'), 'info')->timerProgressBar();
            return redirect()->route('academic.notice.index');
        }
        $tb->active = ($status == 1 ? 0 : 1);
        $tb->save();
        $msg = 'Notice ' . ($status == 0 ? 'Published' : 'Unpublished') . ' Successfully';
        \Cache::forget('notices-' . $school_id);
        toast(transMsg($msg), 'success')->timerProgressBar();
        return back();
    }

    public function remove($id)
    {
        $tb = Notice::find($id);
        $tb->active = 0;
        $tb->save();
        \Cache::forget('notices-' . $tb->school_id);
        return back()->with('status', __('File removed'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notice = Notice::find($id);
        if (serverIsLocal()) {
            @unlink($notice->file_path);
        } else {
            $path = str_replace(env('AWS_FOLDER_ROOT'), '', $notice->file_path);
            Storage::disk('s3')->delete($path);
        }
        \Cache::forget('notices-' . $notice->school_id);
        return ($notice->delete()) ? response()->json([
            'status' => 'success'
        ]) : response()->json([
            'status' => 'error'
        ]);
    }
}
