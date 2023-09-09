<?php

namespace App\Http\Controllers;

use App\Message as Message;
use App\Http\Resources\MessageResource;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getCommunication()
    {
        return view('communication.index');
    }

    public function index($school_id)
    {
        return ($school_id > 0) ? MessageResource::collection(Message::bySchool($school_id)->get()) : response()->json([
            'Invalid School id: ' . $school_id,
            404
        ]);
    }

    public function send_sms(Request $request)
    {
        $school_id = auth()->user()->school_id;
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'teacher' => 'array',
                'student' => 'array',
                'section' => 'nullable|numeric',
                'other_number' => 'nullable|string'
            ]);
            $array_number = [];
            if (isset($request->teacher)) {
                $teachers = (new $this->user())->bySchool($school_id)->active()->role('teacher')->select('id', 'phone_number', 'name');
                if (strtolower($request->teacher[0]) == 'all')
                    $teachers = $teachers->get();
                else
                    $teachers = $teachers->whereIn('id', $request->teacher)->get();

                foreach ($teachers as $key => $teacher) {
                    $value = $teacher->phone_number;
                    $first_2 = substr($value, 0, 2);
                    $first_3 = substr($value, 0, 3);
                    if ($first_2 == '01') {
                        $value = '88' . $value;
                    } elseif ($first_3 != '880') {
                        Alert::error('Country code is missing', 'Teachers ' . $teacher->name . ' number format wrong ' . $value . ' correct format 8801********')->autoClose(false);
                        return back()->withInput();
                    }
                    array_push($array_number, $value);
                }
            }
            if (isset($request->student)) {
                $students = (new $this->user())->bySchool($school_id)->active()->role('student')->where('section_id', $request->section)
                    ->join('student_infos', 'users.id', '=', 'student_infos.student_id')
                    ->where('student_infos.session', $this->current_session->id)
                    ->select('users.id', 'users.phone_number', 'users.name');
                if (strtolower($request->student[0]) == 'all')
                    $students = $students->get();
                else
                    $students = $students->whereIn('users.id', $request->student)->get();

                foreach ($students as $key => $student) {
                    $value = $student->phone_number;
                    $first_2 = substr($value, 0, 2);
                    $first_3 = substr($value, 0, 3);
                    if ($first_2 == '01') {
                        $value = '88' . $value;
                    } elseif ($first_3 != '880') {
                        Alert::error('Country code is missing', 'Students ' . $student->name . ' number format wrong ' . $value . ' correct format 8801********')->autoClose(false);
                        return back()->withInput();
                    }
                    array_push($array_number, $value);
                }
            }
            if (isset($request->other_number)) {
                $toPhone = explode(',', $request->other_number);
                foreach ($toPhone as $key => $value) {
                    $first_2 = substr($value, 0, 2);
                    $first_3 = substr($value, 0, 3);
                    if ($first_2 == '01') {
                        $value = '88' . $value;
                    } elseif ($first_3 != '880') {
                        Alert::error('Country code is missing', 'Number format wrong ' . $value . ' correct format 8801********')->autoClose(false);
                        return back()->withInput();
                    }
                    array_push($array_number, $value);
                }
            }
            if (count($array_number) > 0) {
                $message = filter_var($request->message, FILTER_SANITIZE_STRING);
                $array_number = implode(',', $array_number);
                sms_query($array_number, $message);
                SMS_put_file($array_number, $message);
                toast(transMsg("Send Successfully"), 'success')->timerProgressBar();
            }
        }
        $data['section'] = (new $this->section())->getSection(true, true, true, 'classes.name');
        $data['teacher'] = (new $this->user())->bySchool($school_id)->active()->role('teacher')->orderBy('name')->pluck('name', 'id')->prepend('All', 'all');
        return view('communication.sms', $data);
    }

    public function send_email(Request $request)
    {
        $school_id = auth()->user()->school_id;
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'teacher' => 'array',
                'student' => 'array',
                'section' => 'nullable|numeric',
                'other_email' => 'nullable|string',
                'subject' => 'required|string',
                'message' => 'nullable|string'
            ]);
            $array_emails = [];
            if (isset($request->teacher)) {
                $teachers = (new $this->user())->bySchool($school_id)->active()->role('teacher')->select('id', 'email', 'name');
                if (strtolower($request->teacher[0]) == 'all')
                    $teachers = $teachers->get();
                else
                    $teachers = $teachers->whereIn('id', $request->teacher)->get();

                foreach ($teachers as $key => $teacher) {
                    array_push($array_emails, $teacher->email);
                }
            }
            if (isset($request->student)) {
                $students = (new $this->user())->bySchool($school_id)->active()->role('student')->where('section_id', $request->section)
                    ->join('student_infos', 'users.id', '=', 'student_infos.student_id')
                    ->where('student_infos.session', $this->current_session->id)
                    ->select('users.id', 'users.email', 'users.name');
                if (strtolower($request->student[0]) == 'all')
                    $students = $students->get();
                else
                    $students = $students->whereIn('users.id', $request->student)->get();

                foreach ($students as $key => $student) {
                    array_push($array_emails, $student->email);
                }
            }
            if (isset($request->other_email)) {
                $toEmails = explode(',', $request->other_email);
                foreach ($toEmails as $key => $email) {
                    array_push($array_emails, $email);
                }
            }

            if (count($array_emails) > 0) {
                Mail::send('email.custom_email', ['request' => $request], function ($m) use ($request, $array_emails) {
                    $m->from('noreply@foqas.com', school('name'));
                    $m->to($array_emails)->subject($request->subject);
                });
                email_put_file($array_emails, $request->message, $request->subject);
                toast(transMsg("Send Successfully"), 'success')->timerProgressBar();
            }
        }
        $data['section'] = (new $this->section())->getSection(true, true, true, 'classes.name');
        $data['teacher'] = (new $this->user())->bySchool($school_id)->active()->role('teacher')->orderBy('name')->pluck('name', 'id')->prepend('All', 'all');
        return view('communication.email', $data);
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
        $tb = new Message;
        $tb->phone_number = $request->phone_number;
        $tb->email = $request->email;
        $tb->message = $request->message;
        $tb->school_id = $request->school_id;

        return ($tb->save()) ? response()->json([
            'status' => 'success'
        ]) : response()->json([
            'status' => 'error'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new MessageResource(Message::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return back();
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
        $tb = Message::find($id);
        $tb->phone_number = $request->phone_number;
        $tb->email = $request->email;
        $tb->message = $request->message;
        $tb->school_id = $request->school_id;
        return ($tb->save()) ? response()->json([
            'status' => 'success'
        ]) : response()->json([
            'status' => 'error'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (Message::destroy($id)) ? response()->json([
            'status' => 'success'
        ]) : response()->json([
            'status' => 'error'
        ]);
    }
}
