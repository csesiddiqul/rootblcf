<?php

namespace App\Http\Controllers;
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
//use App\Http\Controllers\UploadHandler;
use App\CourseGroup;
use App\Myclass;
use App\Section;
use App\Session;
use App\User;
use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use App\Imports\TeachersImport;
use App\Exports\StudentsExport;
use App\Exports\TeachersExport;
use App\Exports\StaffsExport;
use App\Exports\AdmissionstudentsExport;
use App\Exports\CommitteesExport;
use App\Exports\PaymentreportsExport;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use function mysql_xdevapi\getSession;

/*
 * jQuery File Upload Plugin PHP Class
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 */

class UploadController extends Controller
{

    public function upload(Request $request)
    {
        $request->validate([
            'upload_type' => 'required',
            'file' => 'required|max:10000|mimes:doc,docx,png,jpeg,pdf,xlsx,xls,ppt,pptx,txt'
        ]);

        $upload_dir = fileUploadFolder() . '/' . $request->upload_type;
        if (serverIsLocal()) {
            $path = Storage::disk('public')->putFile($upload_dir, $request->file('file'));//$request->file('file')->store($upload_dir);
            $path = 'storage/' . $path;
        } else {
            $s3FolderPath = env('AWS_FOLDER_ROOT');
            $path = Storage::disk('s3')->putFile($upload_dir, $request->file('file'));//$request->file('file')->store($upload_dir);
            $path = $s3FolderPath . $path;
        }

        if ($request->upload_type == 'notice') {
            $request->validate([
                'title' => 'required|string',
            ]);

            $tb = new \App\Notice;
            $tb->file_path = $path;
            $tb->title = $request->title;
            $tb->active = 1;
            $tb->school_id = auth()->user()->school_id;
            $tb->user_id = auth()->user()->id;
            $tb->save();
        } else if ($request->upload_type == 'event') {
            $request->validate([
                'title' => 'required|string',
            ]);
            $tb = new \App\Event;
            $tb->file_path = $path;
            $tb->title = $request->title;
            $tb->active = 1;
            $tb->school_id = auth()->user()->school_id;
            $tb->user_id = auth()->user()->id;
            $tb->save();
        } else if ($request->upload_type == 'routine') {
            $request->validate([
                'title' => 'required|string',
            ]);
            $tb = new \App\Routine;
            $tb->file_path = $path;
            $tb->title = $request->title;
            $tb->active = 1;
            $tb->school_id = auth()->user()->school_id;
            $tb->section_id = $request->section_id;
            $tb->user_id = auth()->user()->id;
            $tb->save();
        } else if ($request->upload_type == 'syllabus') {
            $request->validate([
                'title' => 'required|string',
            ]);
            $tb = new \App\Syllabus;
            $tb->file_path = $path;
            $tb->title = $request->title;
            $tb->active = 1;
            $tb->school_id = auth()->user()->school_id;
            $tb->class_id = $request->class_id;
            $tb->user_id = auth()->user()->id;
            $tb->save();
        } else if ($request->upload_type == 'certificate') {
            $request->validate([
                'title' => 'required|string',
                'given_to' => 'required|int',
            ]);

            $tb = new \App\Certificate;
            $tb->file_path = $path;
            $tb->title = $request->title;
            $tb->given_to = $request->given_to;
            $tb->active = 1;
            $tb->school_id = auth()->user()->school_id;
            $tb->user_id = auth()->user()->id;
            $tb->save();
        } else if ($request->upload_type == 'profile' && $request->user_id > 0) {
            $tb = \App\User::find($request->user_id);
            if (serverIsLocal()) {
                @unlink($tb->file_path);
            } else {
                $oldpath = str_replace(env('AWS_FOLDER_ROOT'), '', $tb->file_path);
                Storage::disk('s3')->delete($oldpath);
            }
            $tb->pic_path = $path;
            $tb->save();
        }

        return ($path) ? response()->json([
            'imgUrlpath' => url($path),
            'path' => $path,
            'error' => false
        ]) : response()->json([
            'imgUrlpath' => null,
            'path' => null,
            'error' => true
        ]);
        // $options = ['upload_dir'=>'','upload_url'=>''];
        // new UploadHandler($options);
    }

    public function uploadExcel($type)
    {
        session()->forget('session_student_code');
        return view('upload.excel', compact('type'));
    }

    public function requiredData()
    {
        $school_id = auth()->user()->school_id;
        $data['classes'] = Myclass::query()->bySchool($school_id)->status()->get();
        $data['course_groups'] = CourseGroup::query()->bySchool($school_id)->status()->get();
        return view('upload.requiredData', $data);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|max:10000|mimes:xlsx,xls,csv',
        ]);
        // $path = $request->file('file')->getRealPath();
        $path1 = $request->file('file')->store('public/temp');
        $path = storage_path('app') . '/' . $path1;
        try {
            if ($request->type == 'student') {
                Excel::import(new StudentsImport, $path);
                toast(transMsg('Students are added successfully!'), 'success')->timerProgressBar();
            } else if ($request->type == 'teacher') {
                Excel::import(new TeachersImport, $path);
                toast(transMsg('Teacher are added successfully!'), 'success')->timerProgressBar();
                return back();
            }
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
            }
        }
        @unlink($path);
        return back();
    }

    public function export(Request $request)
    {
        $status = status($request->status);
        if ($request->type == 'student')
            return Excel::download(new StudentsExport($request->status), date('Ydm') . '-Students-' . $status . '.xlsx');
        else if ($request->type == 'teacher')
            return Excel::download(new TeachersExport($request->status), date('Ydm') . '-Teachers-' . $status . '.xlsx');
        else if ($request->type == 'staff')
            return Excel::download(new StaffsExport($request->status), date('Ydm') . '-Staffs-' . $status . '.xlsx');
        else if ($request->type == 'admission_students')
            return Excel::download(new AdmissionstudentsExport($request->status), date('Ydm') . $request->status . '-admission_students.xlsx');
        else if ($request->type == 'committees')
            return Excel::download(new CommitteesExport($request->designation), date('Ydm') . '-Committees.xlsx');

        return back();
    }
}
