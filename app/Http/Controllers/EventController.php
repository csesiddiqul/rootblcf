<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::bySchool(Auth::user()->school_id)->get();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
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
        $event = new Event;
        $event->title = $request->title;
        $event->slug = renderSlug($request->title, 'Event');
        $event->description = $request->description;
        $event->venue = $request->venue;
        $event->event_date = date('Y-m-d', strtotime($request['event_date']));
        $event->event_time = $request['event_time'];
        $event->event_timend = $request['event_timend'];
        $event->file_path = multiFileUpload($request->file);
        $event->active = 1;
        $event->school_id = $school_id;
        $event->user_id = Auth::user()->id;
        $event->save();
        \Cache::forget('events-' . $school_id);
        toast(transMsg('Event Created Successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.event.index');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new EventResource(Event::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $event = Event::find($id);
        if (empty($event) || $event->active == 0 || $event->school_id != Auth::user()->school_id) {
            toast('Event doesnt exists', 'info')->timerProgressBar();
            return redirect()->route('academic.event.index');
        }
        if ($request->isMethod('POST')) {
            $request->validate([
                'description' => 'required|string',
                'file' => 'nullable|mimes:pdf,xlx,xlsx,xls,csv,doc,docx,ppt,pptx,txt,png,jpeg,jpg|max:2048'
            ]);
            $event->title = $request->title;
            $event->description = $request->description;
            $event->venue = $request->venue;
            $event->event_date = date('Y-m-d', strtotime($request['event_date']));
            $event->event_time = $request['event_time'];
            $event->event_timend = $request['event_timend'];
            if ($request->hasFile('file')) {
                unlinkS3File($event->file_path);
                $event->file_path = multiFileUpload($request->file);
            }
            $event->save();
            toast(transMsg('Event Updated Successfully'), 'success')->timerProgressBar();
            return redirect()->route('academic.event.index');
        }
        return view('events.edit', compact('event'));
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
        $tb = Event::byschool($school_id)->find($id);
        if (empty($tb)) {
            toast(transMsg('Event does not exists'), 'info')->timerProgressBar();
            return redirect()->route('academic.event.index');
        }
        $tb->active = ($status == 1 ? 0 : 1);
        $tb->save();
        $msg = 'Event ' . ($status == 0 ? 'Published' : 'Unpublished') . ' Successfully';
        toast(transMsg($msg), 'success')->timerProgressBar();
        \Cache::forget('events-' . $school_id);
        return redirect()->route('academic.event.index');
    }

    public function remove($id)
    {
        $tb = Event::find($id);
        $tb->active = 0;
        $tb->save();
        \Cache::forget('events-' . $tb->school_id);
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
        $event = Event::find($id);
        if (serverIsLocal()) {
            @unlink($event->file_path);
        } else {
            $path = str_replace(env('AWS_FOLDER_ROOT'), '', $event->file_path);
            Storage::disk('s3')->delete($path);
        }
        \Cache::forget('events-' . $event->school_id);
        return ($event->delete()) ? response()->json([
            'status' => 'success'
        ]) : response()->json([
            'status' => 'error'
        ]);
    }
}
