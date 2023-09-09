<?php

namespace App\Http\Controllers;

use App\Category;
use App\Department;
use App\District;
use App\Division;
use App\House;
use App\Http\Requests\CreateStaffRequest;
use App\Myclass;
use App\Section;
use App\Country;
use App\StudentFile;
use App\State;
use App\StudentInfo;
use App\EmployeeDetail;
use App\Thana;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\CreateAdminRequest;
use App\Http\Requests\User\CreateTeacherRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ImpersonateUserRequest;
use App\Http\Requests\User\CreateLibrarianRequest;
use App\Http\Requests\User\CreateAccountantRequest;
use App\Events\UserRegistered;
use App\Events\StudentInfoUpdateRequested;
use Illuminate\Support\Facades\Log;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Stripe\File;
use Illuminate\Support\Facades\Storage;
/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }


    public function getStudents()
    {

        return view('students.index');
    }

    public function viewProfile()
    {

        return view('students.profile-view');
    }


    public function getTeam()
    {
        return view('team.index');
    }

    public function changeStatus($id = null, $status = null)
    {
        if ($status == 1) {
            $this->user->bySchool(auth()->user()->school_id)->find($id)->update(['active' => 0]);
            $returnStatus = '200';
        } elseif ($status == 2 || $status == 0) {
            $this->user->bySchool(auth()->user()->school_id)->find($id)->update(['active' => 1]);
            $returnStatus = '200';
        } else {
            $returnStatus = '400';
        }
        return $returnStatus;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $school_code
     * @param $student_code
     * @param $teacher_code
     * @return \Illuminate\Http\Response
     */
    public function index($school_code, $student_code, $teacher_code)
    {



        session()->forget('section-attendance');
        if ($this->userService->isListOfStudents($school_code, $student_code)) {
            if (request()->isMethod('POST')) {
                $users = $this->userService->getStudents();
                $html = view('components.users-list', compact('users'))->render();
                return $html;
            }
            return $this->userService->indexView('list.student-list', $this->userService->getStudents(1));
        } else if ($this->userService->isListOfTeachers($school_code, $teacher_code))
            return $this->userService->indexView('list.teacher-list', $this->userService->getTeachers());
        else if ($this->userService->isListOfStaff($school_code, $teacher_code))
            return $this->userService->indexView('list.staff-list', $this->userService->getStaffs());
        else if ($this->userService->isListOfaccountant($school_code, $teacher_code))
            return $this->userService->indexView('accounts.accountant-list', $this->userService->getAccountants());
        else if ($this->userService->isListOflibrarian($school_code, $teacher_code))
            return $this->userService->indexView('library.librarian-list', $this->userService->getLibrarians());
        else
            return view('home');
    }

    public function employeeindex($school_code, $employee_status, $employee_role)
    {
        if ($employee_status == 0 || $employee_status == 2) {
            if ($employee_role == 1) {
                return $this->userService->indexView('list.teacher-list', $this->userService->getEmployees($employee_status, 'teacher'));
            } elseif ($employee_role == 2) {
                return $this->userService->indexView('list.staff-list', $this->userService->getEmployees($employee_status, 'staff'));
            }elseif ($employee_role == 0) {
                return $this->userService->indexView('list.student-list', $this->userService->getStudents(false,$employee_status));
            }
        } else {
            return view('home');
        }
    }

    /**
     * @param $school_code
     * @param $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexOther($school_code, $role)
    {

        if ($this->userService->isAccountant($role))
            return $this->userService->indexOtherView('accounts.accountant-list', $this->userService->getAccountants());
        else if ($this->userService->isLibrarian($role))
            return $this->userService->indexOtherView('library.librarian-list', $this->userService->getLibrarians());
        else
            return view('home');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToRegister($type)
    {
        $type = trim($type);
        if ($type == 'student' || $type == 'teacher' || $type == 'accountant' || $type == 'librarian' || $type == 'staff') {
            if ($type == 'teacher') {
                $departments = $this->department->bySchool(auth()->user()->school_id)->get();
                session(['departments' => $departments]);
            }
            session(['register_role' => $type]);
            return redirect()->route('register');
        } else {
            return abort('404');
        }
    }

    /**
     * @param $section_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sectionStudents($section_id)
    {


        $students = $this->userService->getSectionStudentsWithSchool($section_id);
        return view('profile.section-students', compact('students'));
    }

    /**
     * @param $section_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function promoteSectionStudents(Request $request, $section_id)
    {
        if ($this->userService->hasSectionId($section_id)) {
            $students = $this->userService->getSectionStudentsWithStudentInfo($request, $section_id);
            $classes = $this->class->with('sections')->bySchool(Auth::user()->school_id)->status()->orderByRaw('CONVERT(class_number, SIGNED) asc')->get();
            return $this->userService->promoteSectionStudentsView($students, $classes, $section_id);
        } else
            return $this->userService->promoteSectionStudentsView([], [], $section_id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function promoteSectionStudentsPost(Request $request)
    {
        return $this->userService->promoteSectionStudentsPost($request);
    }

    public function changepasswordById(Request $request, $code)
    {
        $user = $this->user->whereStudent_code($code)->first();
        if (empty($user)) {
            return redirect()->back();
        }
        if (auth()->user()->role != 'master') {
            if ($user->school->parent_id == 0) {
                if ($user->school_id != auth()->user()->school_id) {
                    return redirect()->back();
                }
            } else {
                if ($user->school->parent_id != auth()->user()->school_id) {
                    return redirect()->back();
                }
            }
        }
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'new_password' => 'required|string|min:6',
                'password_confirm' => 'required|string|same:new_password'
            ]);
            $user->password = Hash::make($request->new_password);
            $user->save();
            toast(transMsg('Update successfully'), 'success')->timerProgressBar();
            return redirect()->back();
        }
        return view('profile.changePasswordById', compact('user'));
    }

    /**
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        if ($request->isMethod('POST')) {
            if (Hash::check($request->old_password, Auth::user()->password)) {
                $request->user()->fill([
                    'password' => Hash::make($request->new_password),
                ])->save();
                toast(transMsg('Update successfully'), 'success')->timerProgressBar();
                return redirect()->back();
            } else {
                $message = ['old_password' => transMsg('Old password does not match!')];
                return redirect()->back()->withErrors($message);
            }
        }
        return view('profile.change-password');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function impersonateGet()
    {
        if (app('impersonate')->isImpersonating()) {
            Auth::user()->leaveImpersonation();
            return (Auth::user()->role == 'master') ? redirect('/masters') : redirect('/home');
        } else {
            return view('profile.impersonate', [
                'other_users' => $this->user->where('id', '!=', auth()->id())->get(['id', 'name', 'role'])
            ]);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function impersonate(ImpersonateUserRequest $request)
    {
        $user = $this->user->find($request->id);
        Auth::user()->impersonate($user);
        return redirect('/home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {


        DB::transaction(function () use ($request) {
            $password = $request->password;
            $tb = $this->userService->storeStudent($request);
            if($tb->role == 'student'){
                if (foqas_setting('admission_additional_file') !== '')
                    $additional_files = explode(',', foqas_setting('admission_additional_file'));
                else
                    $additional_files = [];
                foreach ($additional_files as $item) {
                    if ($item != 1) {
                        $field_name = school('code') . $item;
                        if (isset($request[$field_name])) {
                            $student_file = new StudentFile();
                            $student_file->type = 2; // admission
                            $student_file->student_id = $tb->id; // admission id
                            $student_file->name = admission_additional_file($item);
                            $student_file->file = Auth::guest() ? $request[$field_name] : multiFileUpload($request->file($field_name), 'ADDITIONAL');;
                            $student_file->save();
                        }
                    }
                }
            }
            try {
                // Fire event to store Student information
                if (event(new StudentInfoUpdateRequested($request, $tb->id))) {
                    // Fire event to send welcome email
                    if (isset($request->email) && isset($password))
                        event(new UserRegistered($tb, $password));
                } else {
                    throw new \Exeception('Event returned false');
                }
            } catch (\Exception $ex) {
                Log::info('Email failed to send to this address: ' . $tb->email . '\n' . $ex->getMessage());
            }

        });
        toast(transMsg('Created Successfully.'), 'success')->timerProgressBar();
        return back();
    }

    /**
     * @param CreateAdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAdmin(CreateAdminRequest $request)
    {
        $password = $request->password;
        $tb = $this->userService->storeAdmin($request);
        try {
            // Fire event to send welcome email
            // event(new userRegistered($userObject, $plain_password)); // $plain_password(optional)
            if ($request->sendEmail == 'on')
                event(new UserRegistered($tb, $password));
        } catch (\Exception $ex) {
            Log::info('Email failed to send to this address: ' . $tb->email);
        }
        toast(transMsg('Created Successfully.'), 'success')->timerProgressBar();
        return back();
    }

    /**
     * @param CreateTeacherRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function employeeinfo(Request $request)
    {
        if (session('able_registry')) {
            $data['country'] = Country::where('status', '1')->orderBy('name', 'ASC')->pluck('name', 'code');
            return view('teacherEducationInfo.registry', $data);
        }
        return redirect()->back()->with('getSecretKey', true);
    }

    public function employeestore(CreateTeacherRequest $request)
    {
        $request['school_id'] = school('id');
        $request['school_code'] = school('code');
        if (isset($request->registry_type)) {
            $role = $request->registry_type;
        } else {
            $role = 'teacher';
        }
        $password = $request->password;

        $tb = $this->userService->storeStaff($request, $role);
        try {
            // Fire event to send welcome email
            event(new UserRegistered($tb, $password));
        } catch (\Exception $ex) {
            Log::info('Email failed to send to this address: ' . $tb->email);
        }
        toast(transMsg('Your registration was Successful'), 'success')->timerProgressBar();
        return redirect()->back();
    }

    public function storeTeacher(CreateTeacherRequest $request)
    {
        $this->validate($request, [
            'gender' => 'required',
            'blood_group' => 'required',
        ]);

        $password = $request->password; 
        $tb = $this->userService->storeStaff($request, 'teacher');
        
        try {
            // Fire event to send welcome email
            if ($request->sendEmail == 'on')
                event(new UserRegistered($tb, $password));
        } catch (\Exception $ex) {
            Log::info('Email failed to send to this address: ' . $tb->email);
        }

        toast(transMsg('Teacher was added successful.'), 'success')->timerProgressBar();
        return back();
    }

    /**
     * @param CreateAccountantRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAccountant(CreateAccountantRequest $request)
    {
        $password = $request->password;
        $tb = $this->userService->storeStaff($request, 'accountant');
        try {
            // Fire event to send welcome email
            event(new UserRegistered($tb, $password));
        } catch (\Exception $ex) {
            Log::info('Email failed to send to this address: ' . $tb->email);
        }
        toast(transMsg('Created Successfully'), 'success')->timerProgressBar();
        return back();
    }

    /**
     * @param CreateLibrarianRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeLibrarian(CreateLibrarianRequest $request)
    {
        $password = $request->password;
        $tb = $this->userService->storeStaff($request, 'librarian');
        try {
            // Fire event to send welcome email
            event(new UserRegistered($tb, $password));
        } catch (\Exception $ex) {
            Log::info('Email failed to send to this address: ' . $tb->email);
        }
        toast(transMsg('Created Successfully'), 'success')->timerProgressBar();
        return back();
    }

    public function storeStaff(CreateStaffRequest $request)
    { 
        $password = $request->password;
        $role = $request->role ?? 'admin'; 
        $tb = $this->userService->storeStaff($request, $role);

        try {
            // Fire event to send welcome email
            event(new UserRegistered($tb, $password));
        } catch (\Exception $ex) {
            Log::info('Email failed to send to this address: ' . $tb->email);
        }
        toast(transMsg('Created Successfully'), 'success')->timerProgressBar();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return UserResource
     */
    public function show($user_code)
    {

        $user = $this->userService->getUserByUserCode($user_code);
        //return $user;
        if (empty($user))
            goto notfound;

        //  if (Auth::user()->role != 'student' || $user->id == Auth::user()->id)
        return view('students.profile-view', compact('user'));
        //return view('profile.user', compact('user'));
        notfound:
        return abort('404');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($student_code)
    {

        $school_id = auth()->user()->school_id;
        if (auth()->user()->hasRole('master'))
            $user = $this->user->where('student_code', $student_code)->first();
        else
            $user = $this->user->bySchool($school_id)->where('student_code', $student_code)->first();

        if (empty($user)) {
            return redirect()->back();
        }
        if (auth()->user()->role != 'master') {
            if ($user->school->parent_id == 0) {
                if ($user->school_id != $school_id) {
                    return redirect()->back();
                }
            } else {
                if ($user->school->parent_id != $school_id) {
                    return redirect()->back();
                }
            }
            if (auth()->user()->role != 'admin' && auth()->user()->id != $user->id)
                return redirect()->back();
        }
        if ($user->role == 'student') {
            $data['categories'] = Category::bySchool($school_id)->status()->pluck('name', 'id');
            $data['houses'] = House::bySchool($school_id)->status()->pluck('name', 'id');
            $data['state'] = State::whereCountry_id($user->studentInfo->country)->pluck('name', 'id');
            $data['division'] = (new Division())->pluckDivision();
        }
        $data['country'] = Country::pluck('name', 'id');
        $departments = Department::query()->bySchool($user->school_id)->get();
        $classes = Myclass::query()->bySchool($user->school_id)->pluck('name', 'id');
        $data['user'] = $user;
        $data['classes'] = $classes;
        $data['departments'] = $departments;
        return view('profile.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $student_code)
    {

        $student_file_data  = StudentFile::where('student_id','=',$request->id)->get();

        if (count($student_file_data) <= 0){

            DB::transaction(function () use ($request) {

                if($request->user_role == 'student'){
                    if (foqas_setting('admission_additional_file') !== '')
                        $additional_files = explode(',', foqas_setting('admission_additional_file'));
                    else
                        $additional_files = [];
                    foreach ($additional_files as $item) {
                        if ($item != 1) {
                            $field_name = school('code') . $item;
                            if (isset($request[$field_name])) {
                                $student_file = new StudentFile();
                                $student_file->type = 2; // admission
                                $student_file->student_id = $request->id; // admission id
                                $student_file->name = admission_additional_file($item);
                                $student_file->file = Auth::guest() ? $request[$field_name] : multiFileUpload($request->file($field_name), 'ADDITIONAL');
                                $student_file->save();
                            }
                        }
                    }
                }
            });

            $school_id = auth()->user()->school_id;
            $student = $this->user->bySchool($school_id)->where('student_code', $student_code)->first();

            if (empty($student)) {
                return redirect()->back();
            }
            if (auth()->user()->role != 'master') {
                if ($student->school->parent_id == 0) {
                    if ($student->school_id != $school_id)
                        return redirect()->back();
                } else {
                    if ($student->school->parent_id != $school_id)
                        return redirect()->back();
                }
                if (auth()->user()->role != 'admin' && auth()->user()->id != $student->id)
                    return redirect()->back();
            }

            DB::transaction(function () use ($request, $student) {
                $student->name = filter_var($request->name, FILTER_SANITIZE_STRING);
                $student->email = filter_var($request->email, FILTER_VALIDATE_EMAIL);
                $student->nationality = (!empty($request->nationality)) ? $request->nationality : '';
                $student->phone_number = filter_var($request->phone_number, FILTER_SANITIZE_STRING);
                $student->address = (!empty($request->address)) ? $request->address : '';
                $student->about = (!empty($request->about)) ? $request->about : '';
                if (!empty($request->blood_group)) {
                    $student->blood_group = filter_var($request->blood_group, FILTER_SANITIZE_STRING);
                }
                if (!empty($request->gender)) {
                    $student->gender = filter_var($request->gender, FILTER_SANITIZE_STRING);
                }
                if (!empty($request->pic_path)) {
                    $student->pic_path = $request->pic_path;
                }
                if ($student->role == 'teacher') {
                    $student->department_id = $request->department_id;
                    $student->section_id = $request->class_teacher_section_id;
                    $student->cv = (!empty($request->teacher_cv)) ? multiFileUpload($request->teacher_cv, 'CV') : $student->cv;
                }
                if ($student->role == 'teacher' || $student->role == 'staff' || $student->role == 'librarian' || $student->role == 'accountant') {
                    $student->role_title = $request->role_title;

                    if(isset($student->employeeDetail)){
                        $employee = $student->employeeDetail;
                    }else{
                        $employee = new EmployeeDetail();
                        $employee->employee_id = $student->id;
                        $employee->user_id = auth()->user()->id;
                    }
                }
                if ($student->role == 'staff') {
                    $student->role = $request->role;
                    //$student->school_id = $request->school_id;
                }

                if ($student->save()) {
                    if ($request->user_role == 'student') {
                        try {
                            // Fire event to store Student information
                            event(new StudentInfoUpdateRequested($request, $student->id));
                        } catch (\Exception $ex) {
                            Log::info('Failed to update Student information, Id: ' . $student->id . 'err:' . $ex->getMessage());
                        }
                    }elseif($student->role == 'teacher' || $student->role == 'staff' || $student->role == 'librarian' || $student->role == 'accountant'){
                        $employee->house_id = (!empty($request->house_id)) ? $request->house_id : NULL;
                        $employee->joindate = (!empty($request->joindate)) ? $request->joindate : NULL;
                        $employee->save();
                    }

                    toast(transMsg('Updated successfully'), 'success')->timerProgressBar();
                }
            });
            return redirect()->back();

//            return 'not crete a data plase carete' ;
        }else{
//
//            $student_file =  StudentFile::find(26);




            DB::transaction(function () use ($request) {

                if($request->user_role == 'student'){
                    if (foqas_setting('admission_additional_file') !== '')
                        $additional_files = explode(',', foqas_setting('admission_additional_file'));
                    else
                        $additional_files = [];
                    foreach ($additional_files as $item) {
                        if ($item != 1) {
                            $field_name = school('code') . $item;
                            if (isset($request[$field_name])) {
                                $student_file_data  = StudentFile::where('student_id','=',$request->id)->get();
                                foreach($student_file_data as $updatast){


                                    if (admission_additional_file($item) == $updatast->name){

                                        // Storage::delete($updatast->file);
                                        $student_file =  StudentFile::find($updatast->id);
                                        $student_file->type = '2'; // admission
                                        $student_file->student_id = $request->id; // admission id
                                        $student_file->name = admission_additional_file($item);


                                        if ($request->hasFile('file')){
                                            @unlink($updatast->file);
                                        }

                                        $student_file->file = Auth::guest() ? $request[$field_name] : multiFileUpload($request->file($field_name), 'ADDITIONAL');
                                        $student_file->save();
                                    }


                                }



                            }
                        }
                    }
                }
            });

            $school_id = auth()->user()->school_id;
            $student = $this->user->bySchool($school_id)->where('student_code', $student_code)->first();

            if (empty($student)) {
                return redirect()->back();
            }
            if (auth()->user()->role != 'master') {
                if ($student->school->parent_id == 0) {
                    if ($student->school_id != $school_id)
                        return redirect()->back();
                } else {
                    if ($student->school->parent_id != $school_id)
                        return redirect()->back();
                }
                if (auth()->user()->role != 'admin' && auth()->user()->id != $student->id)
                    return redirect()->back();
            }

            DB::transaction(function () use ($request, $student) {
                $student->name = filter_var($request->name, FILTER_SANITIZE_STRING);
                $student->email = filter_var($request->email, FILTER_VALIDATE_EMAIL);
                $student->nationality = (!empty($request->nationality)) ? $request->nationality : '';
                $student->phone_number = filter_var($request->phone_number, FILTER_SANITIZE_STRING);
                $student->address = (!empty($request->address)) ? $request->address : '';
                $student->about = (!empty($request->about)) ? $request->about : '';
                if (!empty($request->blood_group)) {
                    $student->blood_group = filter_var($request->blood_group, FILTER_SANITIZE_STRING);
                }
                if (!empty($request->gender)) {
                    $student->gender = filter_var($request->gender, FILTER_SANITIZE_STRING);
                }
                if (!empty($request->pic_path)) {
                    $student->pic_path = $request->pic_path;
                }
                if ($student->role == 'teacher') {
                    $student->department_id = $request->department_id;
                    $student->section_id = $request->class_teacher_section_id;
                    $student->cv = (!empty($request->teacher_cv)) ? multiFileUpload($request->teacher_cv, 'CV') : $student->cv;
                }
                if ($student->role == 'teacher' || $student->role == 'staff' || $student->role == 'librarian' || $student->role == 'accountant') {
                    $student->role_title = $request->role_title;

                    if(isset($student->employeeDetail)){
                        $employee = $student->employeeDetail;
                    }else{
                        $employee = new EmployeeDetail();
                        $employee->employee_id = $student->id;
                        $employee->user_id = auth()->user()->id;
                    }
                }
                if ($student->role == 'staff') {
                    $student->role = $request->role;
                    //$student->school_id = $request->school_id;
                }

                if ($student->save()) {
                    if ($request->user_role == 'student') {
                        try {
                            // Fire event to store Student information
                            event(new StudentInfoUpdateRequested($request, $student->id));
                        } catch (\Exception $ex) {
                            Log::info('Failed to update Student information, Id: ' . $student->id . 'err:' . $ex->getMessage());
                        }
                    }elseif($student->role == 'teacher' || $student->role == 'staff' || $student->role == 'librarian' || $student->role == 'accountant'){
                        $employee->house_id = (!empty($request->house_id)) ? $request->house_id : NULL;
                        $employee->joindate = (!empty($request->joindate)) ? $request->joindate : NULL;
                        $employee->save();
                    }

                    toast(transMsg('Updated successfully'), 'success')->timerProgressBar();
                }
            });
            return redirect()->back();

        }




    }

    /**
     * Activate admin
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activateAdmin($id)
    {
        if (auth()->user()->role == 'master') {
            $admin = $this->user->find($id);
        } else {
            $admin = $this->user->bySchool(auth()->user()->school_id)->find($id);
        }

        if ($admin->active !== 0) {
            $admin->active = 0;
        } else {
            $admin->active = 1;
        }

        $admin->save();
        toast(transMsg('Activate Successfully'), 'success')->timerProgressBar();
        return back();
    }

    /**
     * Deactivate admin
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deactivateAdmin($id)
    {
        if (auth()->user()->role == 'master') {
            $admin = $this->user->find($id);
        } else {
            $admin = $this->user->bySchool(auth()->user()->school_id)->find($id);
        }

        if ($admin->active !== 1) {
            $admin->active = 1;
        } else {
            $admin->active = 0;
        }

        $admin->save();
        toast(transMsg('Deactivate Successfully'), 'success')->timerProgressBar();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return void
     */
    public function destroy($id)
    {
        // return ($this->user->destroy($id))?response()->json([
        //   'status' => 'success'
        // ]):response()->json([
        //   'status' => 'error'
        // ]);
    }
}
