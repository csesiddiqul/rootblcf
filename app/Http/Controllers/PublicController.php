<?php

namespace App\Http\Controllers;

use App\Admission;
use App\Content;
use App\Due;
use App\Grade;
use App\House;
use App\Http\Controllers\Auth\LoginController;
use App\LetsEncript;
use App\Menu;
use App\Notice;
use App\Event;
use App\School;
use App\Myclass;
use App\Division;
use App\Section;
use App\Services\Grade\GradeService;
use App\Slider;
use App\Testimonial;
use App\Country;
use App\User;
use App\Committee;
use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use PDF;
use App\TempleteDesign;

class PublicController extends Controller
{
    public function index()
    {
        $school_id = \school('id');
        if (foqas_setting('slider_notice') == 2) {
            $data['notices'] = Notice::bySchool($school_id)->active()->latest()->take(4)->get();
        } else {
            $data['singleNotice'] = $singleNotice = Notice::bySchool($school_id)->active()->latest()->first();
            if (empty($singleNotice)) {
                $data['notices'] = array();
            } else {
                $data['notices'] = Notice::bySchool($school_id)->where('id', '!=', $singleNotice->id)->active()->latest()->take(3)->get();
            }
        }
        $data['teachers'] = (new User())->getUsers('teacher', true, '6', 'name');
        $data['sliders'] = Slider::bySchool($school_id)->status()->orderBy('priority', 'asc')->take(5)->get();
        $count['teacher'] = (new User())->countUser('teacher');
        $count['student'] = (new User())->countUser('student');
        $count['class'] = Myclass::bySchool($school_id)->status()->count();
        $data['count'] = $count;
        $data['testimonials'] = Testimonial::bySchool($school_id)->status()->latest()->get();
        return view('public.index', $data);
    }

    public function fileManagerMy(Request $request)
    {
        return view('filemanager');
    }


    public function retrieveLetsEcriptData($filename)
    {
        $letsEcript = LetsEncript::where('filename', 'LIKE', $filename)->first();
        return Str::ascii($letsEcript->content);
    }

    public function setLang()
    {
        $locale = request('lang');
        if ($locale != session('localLang')) {
            session()->forget('localLang');
        }
        $supportedLanguages = ['en', 'bn'];
        if (in_array($locale, $supportedLanguages)) {
            session()->put('localLang', $locale);
        }
        return redirect()->back();
    }

    public function foqasLogin(Request $request)
    {
        $data = $message = [];
        if ($request->isMethod('PUT')) {
            $loginFor = ($request->loginfor == 1 ? 1 : 2);
            session()->put('foqasLoginFor', $loginFor);
        } elseif ($request->isMethod('POST')) {
            $this->validate($request, [
                'schoolcode' => 'nullable|integer',
                'email' => 'required|email|string',
                'password' => 'required|string'
            ]);
            $LoginFor = session('foqasLoginFor');
            if (empty($LoginFor)) {
                $LoginFor = 1; // for school
            }
            $data['email'] = $email = filter_var($request->email, FILTER_VALIDATE_EMAIL);
            $password = filter_var($request->password, FILTER_SANITIZE_STRING);
            $field = (new LoginController())->username();
            if ($LoginFor == 1) {
                $data['schoolcode'] = $schoolcode = filter_var($request->schoolcode, FILTER_VALIDATE_INT);
                $school = School::code($schoolcode)->status()->first();
                if (empty($school)) {
                    $validatorMsg = ['schoolcode' => transMsg('School code does not match')];
                    return back()->withErrors($validatorMsg)->withInput();
                }
                if ($school->status == 0) {
                    $validatorMsg = ['schoolcode' => transMsg('School already delete.')];
                    return back()->withErrors($validatorMsg)->withInput();
                }
                if ($school->status == 2) {
                    $validatorMsg = ['schoolcode' => transMsg('School deactive now,Please Contact Foqas Academy.')];
                    return back()->withErrors($validatorMsg)->withInput();
                }
                if ($school->code == defaultSchoolCode()) {
                    $user = $this->user->bySchool($school->id)->where($field, $email)->first();
                    if ($user->role == 'admin' || $user->role == 'master') {
                    } else {
                        $message = ['email' => trans('auth.failed')];
                        goto breakStatement;
                    }
                } else
                    $user = $this->user->bySchool($school->id)->where($field, $email)->role('admin')->first();

                if (empty($user)) {
                    $message = ['email' => trans('auth.failed')];
                    goto breakStatement;
                } else {
                    if (Hash::check($password, $user->password)) {
                        Auth::loginUsingId($user->id);
                        session()->put('current_school', $school);
                        return redirect()->route('home');
                    } else {
                        $message = ['password' => trans('auth.passwordNotMatch')];
                        goto breakStatement;
                    }
                }
            } else {
                $user = $this->user->bySchool(school('id'))->where($field, $email)->role('agent')->first();
                if (empty($user)) {
                    $message = ['email' => trans('auth.failed')];
                    goto breakStatement;
                } else {
                    if (Hash::check($password, $user->password)) {
                        Auth::loginUsingId($user->id);
                        return redirect()->route('home');
                    } else {
                        $message = ['password' => trans('auth.passwordNotMatch')];
                        goto breakStatement;
                    }
                }
            }
        } else {
            if (Auth::check())
                return redirect('home');
            if (serverIsLocal() == false) {
              if ($_SERVER['SERVER_NAME'] != 'blcf.sg' || $_SERVER['SERVER_NAME'] != 'www.blcf.sg') {
                    return redirect(route('login'));
                }
            }
            session()->put('foqasLoginFor', $LoginFor ?? 1);
        }
        breakStatement:
        return view('auth.foqas-login', $data)->withErrors($message);
    }

    public function registryActive()
    {
        try {
            $email = \Crypt::decrypt(trim($_REQUEST['_token']));
        } catch (\Exception $e) {
            alert()->info('Oops!', transMsg('Token has been invalid'));
            return redirect()->route('public.index');
        }
        $user = User::bySchool(\school('id'))->whereEmail($email)->first();
        if (!empty($user)) {
            if ($user->active == 0) {
                $user->active = 1;
                $user->save();
                alert()->success('Success', transMsg('Your account is active now.'));
                return redirect()->route('public.index');
            }
        }
        alert()->info('Oops!', transMsg('Token has been expired'));
        return redirect()->route('public.index');
    }

    public function generatePDF()
    {
        $insert = new LetsEncript();
        $insert->school_id = 1;
        $insert->domain = 'emrul.com';
        $insert->status = 'domain_added';
        $insert->save();
        return 1;
        $data = ['title' => 'Welcome to ItSolutionStuff.com'];
        $pdf = PDF::loadView('myPDF', $data);
        return $pdf->download('itsolutionstuff.pdf');
    }

    public function pagesIndex($slug)
    {
        $menu = Menu::bySchool(\school('id'))->whereSlug($slug)->first();
        if (empty($menu)) {
            toast(transMsg('Pages does not exists'), 'info')->timerProgressBar();
            return back();
        }
        $data['content'] = Content::where('menu_id', $menu->id)->first();
        return view('public.pages.index', $data);
    }

    public function viewall()
    {
        $notices = Notice::bySchool(\school('id'))->active()->latest()->get();
        return view('public.view-notice', compact('notices'));
    }

    public function singleNotice($slug)
    {
        $notice = Notice::bySchool(school('id'))->active()->slug($slug)->first();
        if (empty($notice)) {
            toast(transMsg('Notice does not exists'), 'info')->timerProgressBar();
            return back();
        }
        $data['notice'] = $notice;
        $data['moreNotices'] = Notice::bySchool(school('id'))->where('id', '!=', $notice->id)->take(4)->active()->latest()->get();
        return view('public.single-notice', $data);


    }

    public function getAboutus()
    {
        if (\school('parent_id') == 0) {
            $data['branchs'] = School::where([['parent_id', \school('id')], ['status', 1]])->get();
        } else {
            $data['branchs'] = array();
        }
        return view('public.aboutus', $data);
    }

    public function anyMessage($title)
    {
        if ($title == 'chairman' || $title == 'headteacher') {
            $slug = $title . '-message';
            $data['content'] = Content::join('menus', 'contents.menu_id', 'menus.id')->where('contents.school_id', \school('id'))->where('menus.slug', 'LIKE', $slug)->select('contents.*')->first();
            return view('public.message_head_c', $data);
        }
        return redirect(url('/'));
    }

    public function getCommittee()
    {
        $school_id = school('id');
        $data['mcMenu'] = $menu = Menu::bySchool($school_id)->where('slug', 'committee')->status()->whereType('1')->first();
        if (empty($menu)) {
            toast(transMsg('Menus not found'), 'info')->timerProgressBar();
            return redirect(url('/'));
        }
        $data['committees'] = Committee::bySchool($school_id)->whereType(1)->status()->orderBy('priority', 'asc')->get();
        return view('public.committee', $data);
    }

    public function getMembers()
    {
        $school_id = school('id');
        $data['mcMenu'] = $menu = Menu::bySchool($school_id)->where('slug', 'members')->status()->whereType('1')->first();
        if (empty($menu)) {
            toast(transMsg('Menus not found'), 'info')->timerProgressBar();
            return redirect(url('/'));
        }
        $data['committees'] = Committee::bySchool($school_id)->whereType(2)->status()->orderBy('priority', 'asc')->get();
        return view('public.committee', $data);
    }

    public function getManagements()
    {
        $school_id = school('id');
        $data['mcMenu'] = $menu = Menu::bySchool($school_id)->where('slug', 'managements')->status()->whereType('1')->first();
        if (empty($menu)) {
            toast(transMsg('Menus not found'), 'info')->timerProgressBar();
            return redirect(url('/'));
        }
        $data['committees'] = Committee::bySchool($school_id)->whereType(3)->status()->orderBy('priority', 'asc')->get();
        return view('public.committee', $data);
    }

    public function getTeacher()
    {
        $data['teachers'] = (new User())->getUsers('teacher', true, '6', 'name', 'asc', '12');
        return view('public.teachers', $data);

    }

    public function teacherDetails($code, $name)
    {
        $teacher = User::bySchool(\school('id'))->active()->studentCode($code)->role('teacher')->first();
        if (empty($teacher)) {
            toast(transMsg('Teacher does not exists'), 'info')->timerProgressBar();
            return back();
        }
        return view('public.single-teacher', compact('teacher'));
    }

    public function getBlog()
    {
        return view('public.blog');
    }

    public function getBlogdetails()
    {
        return view('public.blog-details');
    }

    public function getCourse()
    {
        return view('public.courses');
    }

    public function getCoursedetails()
    {
        return view('public.course-details');
    }

    public function getEvent()
    {
        $events = Event::bySchool(\school('id'))->active()->latest()->paginate(8);
        return view('public.event', compact('events'));
    }

    public function getEventdetails($slug)
    {
        $event = Event::bySchool(school('id'))->slug($slug)->first();
        if (empty($event)) {
            toast(transMsg('Event does not exists'), 'info')->timerProgressBar();
            return redirect()->back();
        }
        if ($event->active != 1 && Auth::guest() || Auth::check() && Auth::user()->role != 'admin') {
            toast(transMsg('Event status unpublished'), 'info')->timerProgressBar();
            return redirect()->route('event.index');
        }
        return view('public.event-details', compact('event'));
    }

    public function getGallery()
    {
        $data['gallerys'] = Gallery::bySchool(\school('id'))->status()->paginate(18);
        return view('public.gallery', $data);
    }

    public function getContact()
    {
        return view('public.contact');
    }

    public function viewComplain()
    {
        return view('public.complain');
    }

    public function privacypolicy()
    {
        return view('public.privacypolicy');
    }

    public function termscondition()
    {
        return view('public.termscondition');
    }

    public function admission()
    {
        if (Auth::check()) {
            alert()->error('Oops!', transMsg('You are a login user, if you want to access your public admission form, please logout first.'))->autoClose(false);
            return redirect()->route('academic.admission.create');
        }
        $school_id = \school('id');
        $data['applyMenu'] = $menu = Menu::bySchool($school_id)->where('slug', 'admission/apply')->status()->whereType('1')->first();
        if (empty($menu)) {
            toast(transMsg('Menus not found'), 'info')->timerProgressBar();
            return redirect(url('/'));
        }
        $accept = $_REQUEST['accept'] ?? '';
        if ($accept != 'false')
            session()->forget('applicationVal');

        $data['division'] = (new Division())->pluckDivision();
        $data['country'] = Country::pluck('name', 'id')->sortBy('name');
        $data['housePluck'] = House::pluck('name', 'id')->sortBy('name');
        if (branch_permission()) {
            $data['branchPluck'] = School::where('parent_id', $school_id)->where('status', 1)->orderBy('name')->pluck('name', 'id');
        }
        return view('public.admission.apply', $data);
    }

    public function admissionPreview(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            if (foqas_setting('admission_additional_file') !== '')
                $additional_files = explode(',', foqas_setting('admission_additional_file'));
            else
                $additional_files = [];
            foreach ($additional_files as $item) {
                if ($item != 1) {
                    $field_name = school('code') . $item;
                    if ($request->file($field_name) !== null) {
                        $input[$field_name] = multiFileUpload($request->file($field_name), 'ADDITIONAL');
                    }
                }
            }
            session()->put('applicationVal', $input);
            return response()->json(['status' => '200']);
        }
        if (empty(session('applicationVal'))) {
            alert()->info('Oops!', transMsg('Please Fill-up Application form first'));
            return redirect()->route('apply.admission');
        }
        $data['input'] = session('applicationVal');
        return View::make('public.admission.review', $data);
    }

    public function admissionPrint()
    {
        if (empty(session('applicationVal'))) {
            alert()->info('Oops!', transMsg('Please Fill-up Application form first'));
            return redirect()->route('apply.admission');
        }
        $data['input'] = session('applicationVal');
        return View::make('public.admission.print-application', $data);
    }

    public function showdownloadApplication()
    {
        $data['downloadMenu'] = $menu = Menu::bySchool(school('id'))->where('slug', 'admission/download')->status()->whereType('1')->first();
        return view('public.admission.download-application', $data);
    }

    public function verifyApplication(Request $request)
    {
        if (foqas_setting('admission_form') != 1) {
            toast(transMsg('Admission form not published yet'), 'info')->timerProgressBar();
            return redirect()->back();
        }
        if (foqas_setting('admission_verify') != 1) {
            toast(transMsg('Admission verify not published yet'), 'info')->timerProgressBar();
            return redirect()->back();
        }
        $school_id = school('id');
        $data['verifyMenu'] = $menu = Menu::bySchool($school_id)->where('slug', 'admission/verify')->status()->whereType('1')->first();
        if (empty($menu)) {
            toast(transMsg('Menus not found'), 'info')->timerProgressBar();
            return redirect(url('/'));
        }
        if ($request->isMethod('POST')) {
            $request->validate([
                'roll' => 'required|numeric'
            ], [
                'roll.required' => transMsg('Please enter your admission roll'),
            ]);
            $data['admission'] = $admission = Admission::bySchool($school_id)->whereRoll($request->roll)->first();
            if (empty($admission)) {
                $validatorMsg = ['roll' => transMsg('Roll does not match')];
                return back()->withErrors($validatorMsg)->withInput();
            }
            \view()->share($data);
        } else {
            $admission = Session::get('admission');
            if ($admission) {
                $data['admission'] = $admission;
            }
            \view()->share($data);
        }
        return view('public.admission.verify');
    }

    public function paymentApplication($roll)
    {
        $roll = base64_decode(base64_decode(str_replace(base64_encode(date('Y')), '', $roll)));
        $admission = Admission::bySchool(\school('id'))->whereRoll($roll)->first();
        if (empty($admission)) {
            toast(transMsg('Nothing found payment details'), 'info')->timerProgressBar();
            return back();
        }
        if ($admission->status == 4) {
            toast(transMsg('Payment Already successfully'), 'info')->timerProgressBar();
            return back();
        }
        if ($admission->status == 5) {
            // status unpaid
            if (getCountryName($admission->country, false)->code == 'BD') {
                session([
                    'SSL_SUCCESS_URL' => 'admission/payment/success',
                    'SSL_FAIL_URL' => 'admission/payment/fail',
                    'SSL_CANCEL_URL' => 'admission/payment/cancel',
                ]);
                return redirect()->route('admission_payment.index', $admission->id);
            }
            toast(transMsg('Payment Method not supported'), 'warning')->timerProgressBar();
            return back();
        }
        toast(transMsg('Something wrong try again!'), 'warning')->timerProgressBar();
        return back();
    }

    public function downloadApplication(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            array(
                'roll' => 'required|numeric',
                'password' => 'required|string',
            ), ([
            'roll.required' => transMsg('Please enter your admission Roll'),
            'password.required' => transMsg('Please enter your Password'),
        ])
        );
        $admission = Admission::bySchool(\school('id'))->whereRoll($request->roll)->first();
        if (empty($admission)) {
            $validator->getMessageBag()->add('roll', transMsg('Roll does not match'));
            return back()->withErrors($validator)->withInput();
        }
        if ($admission->add_pass != $request->password) {
            $validator->getMessageBag()->add('password', transMsg('Password does not match'));
            return back()->withErrors($validator)->withInput();
        }
        $data['input'] = $admission;
        return View::make('public.admission.pdf-application', $data);
    }

    public function meritlist()
    {
        $school_id = \school('id');
        $data['meritMenu'] = $menu = Menu::bySchool($school_id)->where('slug', 'admission/meritlist')->status()->whereType('1')->first();
        if (empty($menu)) {
            toast(transMsg('Menus not found'), 'info')->timerProgressBar();
            return redirect(url('/'));
        }
        $admission_result = foqas_setting('admission_result');
        if ($admission_result) {
            $published_time = foqas_setting('add_result_pubtime');
            $timezone = foqas_setting('timezone');
            if (now()->gt($published_time)) {
                $data['results'] = $this->admission->with(['section'])
                    ->where('preadmission_id', preAdmissionId())
                    ->where('school_id', $school_id)
                    ->where('status', 2)
                    ->orderBy('merit', 'ASC')
                    ->orderBy('mark', 'DESC')
                    ->orderBy('roll', 'ASC')
                    ->get()->groupBy('section_id');
                /*->map(function ($q) {
                       $admission_student = foqas_setting('admission_student') ?? 100;
                       return $q->take($admission_student);
                   });*/
                $data['published_status'] = true;
            } else {
                $data['message'] = transMsg('Merit List published at ' . convertTimeToUSERzone($published_time, $timezone));
                $data['results'] = array();
                $data['published_status'] = false;
            }
        } else {
            $data['message'] = transMsg('Merit List not published yet');
            $data['results'] = array();
        }
        return View::make('public.admission.meritlist', $data);
    }

    public function admissionWaiting($step)
    {
        // return  (new Admission())->waiting_1();
        if ($step == 1 || $step == 2 || $step == 3) {
            $school_id = \school('id');
            $data['waitingMenu'] = $menu = Menu::bySchool($school_id)->where('slug', 'admission/waiting_step_' . $step)->status()->whereType('1')->first();
            if (empty($menu)) {
                toast(transMsg('Menus not found'), 'info')->timerProgressBar();
                return redirect(url('/'));
            }
            $data['step'] = $step;
            $data['results'] = $this->admission->with(['section'])
                ->where('preadmission_id', preAdmissionId())
                ->where('school_id', $school_id)
                ->where('status', 2)
                ->where('waiting_' . $step, 1)
                ->orderBy('merit', 'ASC')
                ->orderBy('mark', 'DESC')
                ->orderBy('roll', 'ASC')
                ->get()->groupBy('section_id');
            return view('public.admission.waiting_list', $data);
        }
        return redirect(url('/'));
    }

    public function secretKey($key)
    {
        // $exploded = explode('S','', $key);
        //explode(delimiter, string)
        //$date1 = implode(glue, pieces)('S', $key);
        //$parts = explode('S', $key);
        //$ss = preg_split('/\d+\K/', $key);
        $array = preg_split('/([a-zA-Z]+)/', $key, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        if ($array[0] == 'T') {
            session()->put('registry_type', false);
        } elseif ($array[0] == 'S') {
            session()->put('registry_type', 'staff');
        } else {
            session()->put('able_registry', false);
            $message = ['status' => '404'];
            goto returnSection;
        }
        $school = School::where([['id', school('id')], ['secretKey', $array[1]]])->first();
        if (!empty($school)) {
            session()->put('able_registry', true);
            $message = ['status' => '200'];
        } else {
            session()->put('able_registry', false);
            $message = ['status' => '404'];
        }
        returnSection:
        return response()->json($message);
    }

    public function checkEmail(Request $request)
    {
        if ($request->ajax()) {
            $email = User::bySchool(\school('id'))->where('email', $_REQUEST['email'])->first();
            if (empty($email)) {
                $email = Admission::bySchool(\school('id'))->where('email', $_REQUEST['email'])->first();
            }
            if (empty($email)) {
                return response()->json(['status' => '200', 'msg' => '<h5 class="text-success">' . transMsg('Email available for registration') . '</h5>']);
            } else {
                return response()->json(['status' => '404', 'msg' => '<h5 class="text-danger">' . transMsg('Email already exists') . '</h5>']);
            }
        }
    }

    public function admitCard(Request $request)
    {
        $school_id = school('id');
        $data['admitCardMenu'] = $menu = Menu::bySchool($school_id)->where('slug', 'admission/admitcard')->status()->whereType('1')->first();
        if (empty($menu)) {
            toast(transMsg('Menus not found'), 'info')->timerProgressBar();
            return redirect(url('/'));
        }
        $data['admission'] = Admission::bySchool($school_id)->first();
        $data['admitTemplete'] = $admitTemplete = TempleteDesign::find(foqas_setting('admi_card_template'));
        if (empty($admitTemplete)) {
            return redirect()->back();
        }
        if ($request->isMethod('post')) {
            $validator = \Validator::make(
                $request->all(),
                array(
                    'roll' => 'required|numeric',
                    'password' => 'required|string',
                ), ([
                'roll.required' => transMsg('Please enter your admission Roll'),
                'password.required' => transMsg('Please enter your Password'),
            ])
            );
            if ($validator->fails())
                return back()->withErrors($validator)->withInput();

            $data['admitTemplete'] = $admitTemplete = TempleteDesign::find(foqas_setting('admi_card_template'));
            if (empty($admitTemplete)) {
                return redirect()->back();
            }
            $addmission = Admission::bySchool(\school('id'))->whereRoll($request->roll)->first();
            if (empty($addmission)) {
                $validator->getMessageBag()->add('roll', transMsg('Roll does not match'));
                return back()->withErrors($validator)->withInput();
            }
            if ($addmission->add_pass != $request->password) {
                $validator->getMessageBag()->add('password', transMsg('Password does not match'));
                return back()->withErrors($validator)->withInput();
            }
            $data['input'] = $addmission;
            $data['footerFalse'] = 0;
            return View::make('public.admission.admit-card', $data);
        }
        return View::make('public.admission.admitcard-download', $data);
    }

    public function academicResults(Request $request)
    {
        $school_id = school('id');
        $data['academicR_menu'] = $menu = Menu::bySchool($school_id)->where('slug', 'academic-results')->status()->whereType('1')->first();
        if (empty($menu)) {
            toast(transMsg('Menus not found'), 'info')->timerProgressBar();
            return redirect(url('/'));
        }
        $session = currentSession();
        $data['post_request'] = false;
        if ($request->isMethod('POST')) {
            $validator = \Validator::make(
                $request->all(),
                array(
                    'roll' => 'required|numeric',
                    'section_id' => 'required|numeric',
                    'exam_id' => 'required|numeric',
                ), ([
                'roll.required' => transMsg('Please enter your class Roll'),
                'section_id.required' => transMsg('Please choose an class & section'),
                'exam_id.required' => transMsg('Please choose an exam'),
            ])
            );
            if ($validator->fails())
                return back()->withErrors($validator)->withInput();
            $section_id = $request->section_id;
            $roll = $request->roll;
            $exam_id = $request->exam_id;
            $section = Section::join('classes', 'classes.id', 'sections.class_id')->where('classes.school_id', $school_id)->where('sections.id', $section_id)->first();
            if (empty($section)) {
                $validator->getMessageBag()->add('section_id', transMsg('Class & Section not found'));
                return back()->withErrors($validator)->withInput();
            }
            $user = $this->user->join('student_infos', 'student_infos.student_id', 'users.id')->bySchool($school_id)->where('student_infos.session', $session->id)->where('student_infos.class_roll', $roll)->where('users.section_id', $section_id)->select('users.*')->first();
            if (empty($user)) {
                $validator->getMessageBag()->add('roll', transMsg('Roll does not match'));
                return back()->withErrors($validator)->withInput();
            }
            $positions = Grade::leftJoin('course_configs', function ($q) {
                $q->on('course_configs.id', 'grades.course_id');
                $q->leftjoin('courses', 'courses.id', 'course_configs.course_id');
            })->leftJoin('users', function ($q) use ($session) {
                $q->on('users.id', 'grades.student_id');
                $q->leftjoin('student_infos', 'student_infos.student_id', 'users.id');
                $q->leftjoin('course_groups', 'student_infos.coursegroup_id', 'course_groups.id');
                $q->where('student_infos.session', $session->id);
            })->where('users.section_id', $section_id)
                ->where('grades.exam_id', $exam_id)
                ->selectRaw('grades.student_id,grades.exam_id,SUM(grades.gpa) AS tGpa,SUM(grades.marks) as tMark,SUM(grades.gpa) - CASE WHEN course_configs.course_id = course_groups.optional THEN CASE WHEN grades.gpa >=2 THEN 2 ELSE CASE WHEN grades.gpa >=1 THEN 1 ELSE 0 END END ELSE 0 END as fGpa')
                ->orderBy('fGpa', 'DESC')
                ->orderBy('tMark', 'DESC')
                ->orderBy('student_infos.class_roll', 'ASC')
                ->groupBy('grades.student_id')
                ->groupBy('grades.exam_id')->get();
            $grades = (new GradeService)->getStudentGradesWithInfoCourseTeacherExam($user->id, $exam_id);
            if (count($grades) > 0) {
                $exams = (new GradeService)->getExamByIdsFromGrades($grades);
                $gradesystems = (new GradeService)->getGradeSystemBySchoolId($grades);
            } else {
                $grades = [];
                $gradesystems = [];
                $exams = [];
            }
            $data['grades'] = $grades;
            $data['gradesystems'] = $gradesystems;
            $data['exams'] = $exams;
            $data['positions'] = $positions;
            $data['post_request'] = true;
        }
        $data['examPluck'] = $this->exam->bySchool($school_id)->where('result_published', 1)->where('session_id', $session->id)->pluck('exam_name', 'id');
        return View::make('public.academic_results', $data);
    }

    public function payOnline(Request $request)
    {
        $school_id = \school('id');
        $data['pagesMenu'] = $menu = Menu::bySchool($school_id)->where('slug', 'pay-online')->whereStatus(1)->whereType('1')->first();
        if (empty($menu)) {
            toast(transMsg('Menus not found'), 'info')->timerProgressBar();
            return redirect(url('/'));
        }
        if ($request->isMethod('POST')) {
            $validator = \Validator::make(
                $request->all(),
                array(
                    'roll' => 'required|numeric',
                    'section_id' => 'required|numeric',
                    'payment_type' => 'required|numeric',
                ), ([
                'roll.required' => transMsg('Please enter your Student ID/Roll'),
                'section_id.required' => transMsg('Please choose an class & section'),
                'payment_type.required' => transMsg('Please choose an payment type'),
            ])
            );
            if ($validator->fails())
                return back()->withErrors($validator)->withInput();
            $data['section_id'] = $section_id = $request->section_id;
            $data['payment_type'] = $payment_type = $request->payment_type;
            $data['student_code'] = $roll = $request->roll;
            $student = $this->user->bySchool($school_id)->active()->where('section_id', $section_id)->studentCode($roll)
                ->join('student_infos', 'users.id', '=', 'student_infos.student_id')
                ->where('student_infos.session', $this->current_session->id)->select('users.*')->first();
            if (empty($student)) {
                $validator->getMessageBag()->add('roll', transMsg('Student not found in this roll'));
                return back()->withErrors($validator)->withInput();
            }
            $data['dues'] = Due::join('users', 'users.id', 'dues.student_id')
                ->join('fees', 'fees.id', 'dues.fee_id')
                ->join('account_sectors', 'account_sectors.id', 'fees.type')
                ->leftJoin('payment_details', 'dues.id', 'payment_details.due_id')
                ->select('dues.id', 'dues.school_id', 'dues.user_id', 'dues.class_id', 'dues.section_id', 'dues.student_id', 'dues.fee_id', 'dues.status', 'fees.amount', 'fees.type', 'fees.created_at', 'users.name', 'users.student_code', 'account_sectors.name as account_sectors', \DB::raw('sum(payment_details.amount) as paid'), \DB::raw('sum(payment_details.waiver) as waiver'), \DB::raw('fees.amount- CASE WHEN payment_details.amount IS NULL THEN 0 ELSE (sum(payment_details.amount)+sum(payment_details.waiver)) END  as due'))
                ->where('dues.school_id', $school_id)
                ->where('dues.status', 1)
                ->where('users.id', $student->id)->groupBy('dues.id');
            if (strtolower($payment_type) == 0)
                $data['payment_type'] = 0;
            else
                $data['dues'] = $data['dues']->where('account_sectors.id', $payment_type);
            $data['dues'] = DBConnection()->table(\DB::raw("({$data['dues']->toSql()}) as data"))->mergeBindings($data['dues']->getQuery())->where("due", "!=", 0)->get();
        }
        $data['payment_types'] = $this->accountSector->where('type', 'income')->bySchool($school_id)->pluck('name', 'id')->prepend('All', '0');
        return view('public.pay_online', $data);
    }

    public function money_receipt()
    {
        return view('accounts.invoice.invoice1');
    }
}
