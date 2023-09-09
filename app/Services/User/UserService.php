<?php

namespace App\Services\User;

use App\PromotionHistory;
use App\Section;
use App\User;
use App\StudentInfo;
use App\EmployeeDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mavinoo\Batch\Batch as Batch;
use Illuminate\Support\Facades\Log;

class UserService
{

    protected $user;
    protected $student_info;
    protected $promotion_histories;
    protected $db;
    protected $batch;
    protected $st, $st2, $past_data;

    public function __construct(User $user, StudentInfo $student_info, PromotionHistory $promotion_histories, DB $db, Batch $batch)
    {
        $this->user = $user;
        $this->student_info = $student_info;
        $this->promotion_histories = $promotion_histories;
        $this->db = $db;
        $this->batch = $batch;
    }

    public function isListOfStudents($school_code, $student_code)
    {
        return !empty($school_code) && $student_code == 1;
    }

    public function isListOfTeachers($school_code, $teacher_code)
    {
        return !empty($school_code) && $teacher_code == 1;
    }

    public function isListOfStaff($school_code, $staff_code)
    {
        return !empty($school_code) && $staff_code == 2;
    }

    public function isListOfaccountant($school_code, $accountant_code)
    {
        return !empty($school_code) && $accountant_code == 3;
    }

    public function isListOflibrarian($school_code, $librarian_code)
    {
        return !empty($school_code) && $librarian_code == 4;
    }

    public function indexView($view, $users)
    {
        return view($view, [
            'users' => $users
        ]);
    }

    public function hasSectionId($section_id)
    {
        if ($section_id > 0) {
            $section = Section::join('classes', 'classes.id', 'sections.class_id')
                ->where('classes.school_id', Auth::user()->school_id)
                ->where('classes.status', 1)
                ->where('sections.status', 1)
                ->where('sections.id', $section_id)
                ->first();
            if (!empty($section)) {
                return true;
            }
        }
        return false;
    }

    public function updateStudentInfo($request, $id)
    {
        $info = StudentInfo::firstOrCreate(['student_id' => $id]);
        $info->student_id = $id;
        $info->session = (!empty($request->session)) ? $request->session : '';
        $info->coursegroup_id = (!empty($request->coursegroup_id)) ? $request->coursegroup_id : '';
        $info->version = (!empty($request->version)) ? $request->version : '';
        $info->group = (!empty($request->group)) ? $request->group : '';
        $info->birthday = (!empty($request->birthday)) ? date('Y-d-m', strtotime(str_replace('/', '-', $request->birthday))) : '';
        $info->placeBirth = (!empty($request->placeBirth)) ? $request->placeBirth : '';
        $info->dob_no = (!empty($request->dob_no)) ? $request->dob_no : '';
        $info->religion = (!empty($request->religion)) ? $request->religion : '';
        $info->father_name = (!empty($request->father_name)) ? $request->father_name : '';
        $info->father_phone_number = (!empty($request->father_phone_number)) ? $request->father_phone_number : '';
        $info->father_national_id = (!empty($request->father_national_id)) ? $request->father_national_id : '';
        $info->father_occupation = (!empty($request->father_occupation)) ? $request->father_occupation : '';
        $info->father_designation = (!empty($request->father_designation)) ? $request->father_designation : '';
        $info->father_annual_income = (!empty($request->father_annual_income)) ? $request->father_annual_income : '';
        $info->mother_name = (!empty($request->mother_name)) ? $request->mother_name : '';
        $info->mother_phone_number = (!empty($request->mother_phone_number)) ? $request->mother_phone_number : '';
        $info->mother_national_id = (!empty($request->mother_national_id)) ? $request->mother_national_id : '';
        $info->mother_occupation = (!empty($request->mother_occupation)) ? $request->mother_occupation : '';
        $info->mother_designation = (!empty($request->mother_designation)) ? $request->mother_designation : '';
        $info->mother_annual_income = (!empty($request->mother_annual_income)) ? $request->mother_annual_income : '';
        $info->main_school_name_address = (!empty($request->main_school_name_address)) ? $request->main_school_name_address : '';
        $info->previous_class = (!empty($request->previous_class)) ? $request->previous_class : '';
        $info->singaporepr = (!empty($request->singaporepr)) ? $request->singaporepr : '';
        $info->bengaliLang = (!empty($request->bengaliLang)) ? $request->bengaliLang : '';
        $info->last_gpa = (!empty($request->last_gpa)) ? $request->last_gpa : '';
        $info->class_roll = (!empty($request->class_roll)) ? $request->class_roll : '';
        $info->contact_person = (!empty($request->contact_person)) ? $request->contact_person : '';
        $info->contact_person_mobile = (!empty($request->contact_person_mobile)) ? $request->contact_person_mobile : '';
        $info->contact_person_email = (!empty($request->class_roll)) ? $request->contact_person_email : '';
        $info->relation_with_cperson = (!empty($request->relation_with_cperson)) ? $request->relation_with_cperson : '';
        $info->category_id = (!empty($request->category_id)) ? $request->category_id : '';
        $info->house_id = (!empty($request->house_id)) ? $request->house_id : '';
        if (school('country')->code == 'BD') {
            $info->present_address = (!empty($request->present_address)) ? $request->present_address : '';
            $info->present_post_office = (!empty($request->present_post_office)) ? $request->present_post_office : '';
            $info->present_postcode = (!empty($request->present_postcode)) ? $request->present_postcode : '';
            $info->present_thana = (!empty($request->present_thana)) ? $request->present_thana : '';
            $info->present_district = (!empty($request->present_district)) ? $request->present_district : '';
            $info->present_division = (!empty($request->present_division)) ? $request->present_division : '';
            $info->permanent_address = (!empty($request->permanent_address)) ? $request->permanent_address : '';
            $info->permanent_post_office = (!empty($request->permanent_post_office)) ? $request->permanent_post_office : '';
            $info->permanent_postcode = (!empty($request->permanent_postcode)) ? $request->permanent_postcode : '';
            $info->permanent_thana = (!empty($request->permanent_thana)) ? $request->permanent_thana : '';
            $info->permanent_district = (!empty($request->permanent_district)) ? $request->permanent_district : '';
            $info->permanent_division = (!empty($request->permanent_division)) ? $request->permanent_division : '';
        } else {
            $info->street_address_1 = (!empty($request->street_address_1)) ? $request->street_address_1 : '';
            $info->street_address_2 = (!empty($request->street_address_2)) ? $request->street_address_2 : '';
            $info->country = (!empty($request->country)) ? $request->country : '';
            $info->state = (!empty($request->state)) ? $request->state : '';
            $info->city = (!empty($request->city)) ? $request->city : '';
            $info->zipCode = (!empty($request->zipCode)) ? $request->zipCode : '';
            $info->stream = (!empty($request->stream)) ? $request->stream : '';
            $info->weekEnd = (!empty($request->weekEnd)) ? $request->weekEnd : '';
        }
        $info->user_id = auth()->user()->id;
        $info->save();
    }

    public function promoteSectionStudentsView($students, $classes, $section_id)
    {
        return view('school.promote-students', compact('students', 'classes', 'section_id'));
    }

    public function promoteSectionStudentsPost($request)
    {
        if ($request->section_id > 0) {
            $students = $this->getSectionStudentsWithStudentInfo($request, $request->section_id);
            $i = 0;
            foreach ($students as $student) {
                $this->st[] = [
                    'id' => $student->id,
                    'section_id' => $request->to_section[$i],
                    'active' => isset($request["left_school$i"]) ? 0 : 1,
                ];
                $this->st2[] = [
                    'student_id' => $student->id,
                    'session' => $request->to_session[$i],
                    'coursegroup_id' => $request->coursegroup_id[$i],
                    'class_roll' => $request->class_roll[$i],
                ];
                $this->past_data[] = [
                    'school_id' => auth()->user()->school_id,
                    'student_id' => $student->id,
                    'past_session' => $student->session,
                    'present_session' => $request->to_session[$i],
                    'past_section' => $student->section_id,
                    'present_section' => $request->to_section[$i],
                    'past_roll' => $student->class_roll,
                    'present_roll' => $request->class_roll[$i],
                    'past_coursegroup_id' => $student->coursegroup_id,
                    'present_coursegroup_id' => $request->coursegroup_id[$i],
                    'school_left' => isset($request["left_school$i"]) ? 1 : 0,
                    'promoted_by' => auth()->user()->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                ++$i;
            }
            $this->promotion_histories->insert((array)$this->past_data);
            $this->promoteSectionStudentsPostDBTransaction();
            toast(transMsg('Promotion Successfully'), 'success')->timerProgressBar();
            return back();
        }
    }

    public function promoteSectionStudentsPostDBTransaction()
    {
        return $this->db::transaction(function () {
            // $table1 = 'users';
            $this->batch->update($this->user, (array)$this->st, 'id');
            // $table2 = 'student_infos';
            $this->batch->update($this->student_info, (array)$this->st2, 'student_id');
        });
    }

    public function isAccountant($role)
    {
        return $role == 'accountant';
    }

    public function isLibrarian($role)
    {
        return $role == 'librarian';
    }

    public function isStaff($role)
    {
        return $role == 'admin';
    }

    public function indexOtherView($view, $users)
    {
        return view($view, [
            'users' => $users
        ]);
    }

    public function getStudents($limit = false, $status = 1)
    {
        $user = $this->user->with(['section.class', 'school', 'studentInfo'])
            ->join('student_infos', 'users.id', '=', 'student_infos.student_id')
            ->where('student_infos.session', '=', currentSession()->id)
            ->where('users.code', auth()->user()->school->code)
            ->where('users.role', 'student')
            ->orderBy('users.name', 'asc')
            ->select('users.*')->where('active', $status);
        if ($limit) {
            $user->limit($limit);
        }
        return $user->get();
    }

    public function getTeachers()
    {
        return $this->user->with(['section', 'school'])
            ->where('code', auth()->user()->school->code)
            ->where('role', 'teacher')
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function getEmployees($status, $rolename)
    {
        if ($rolename == 'teacher') {
            return $this->user->with(['section', 'school'])
                ->where('code', auth()->user()->school->code)
                ->where('role', $rolename)
                ->where('active', $status)
                ->orderBy('active', 'DESC')
                ->get();
        } elseif ($rolename == 'staff') {
            return $this->user->with(['section', 'school'])
                ->where('code', auth()->user()->school->code)
                ->whereIn('role', ['accountant', 'librarian'])
                ->where('active', $status)
                ->orderBy('active', 'DESC')
                ->get();
        }
    }

    public function getAccountants()
    {
        return $this->user->with('school')
            ->where('code', auth()->user()->school->code)
            ->where('role', 'accountant')
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function getLibrarians()
    {
        return $this->user->with('school')
            ->where('code', auth()->user()->school->code)
            ->where('role', 'librarian')
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->get();
    }


    public function getStaffs()
    {
        return $this->user->with('school')
            ->where('code', auth()->user()->school->code)
            ->whereIn('role', ['admin', 'accountant', 'librarian', 'staff'])
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function getSectionStudentsWithSchool($section_id)
    {
        return $this->user->with('school')
            ->bySchool(auth()->user()->school_id)
            ->join('student_infos', 'users.id', '=', 'student_infos.student_id')
            ->where('student_infos.session', currentSession()->id)
            ->student()
            ->where('section_id', $section_id)
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function getSectionStudentsWithStudentInfo($request, $section_id)
    {
        $ignoreSessions = $request->session()->get('ignoreSessions');

        if (isset($ignoreSessions) && $ignoreSessions == "true") {
            return $this->user->with(['section'])
                ->join('student_infos', 'users.id', '=', 'student_infos.student_id')
                //->where('student_infos.session', '<=', now()->year)
                ->where('users.section_id', $section_id)
                ->where('users.active', 1)
                ->select('users.*', 'student_infos.class_roll', 'student_infos.session', 'student_infos.coursegroup_id')
                ->orderBy('class_roll')
                ->get();
        } else {
            return $this->user->with(['section'])
                ->join('student_infos', 'users.id', '=', 'student_infos.student_id')
                ->where('student_infos.session', currentSession()->id)
                ->where('users.section_id', $section_id)
                ->where('users.active', 1)
                ->select('users.*', 'student_infos.class_roll', 'student_infos.session', 'student_infos.coursegroup_id')
                ->orderBy('class_roll')
                ->get();
        }
    }

    public function getSectionStudents($section_id)
    {
        return $this->user->where('section_id', $section_id)
            ->where('active', 1)
            ->get();
    }

    public function getUserByUserCode($user_code)
    {
        return $this->user->with('section', 'studentInfo','studentFile')->bySchool(Auth::user()->school_id)
            ->where('student_code', $user_code)
            ->where('active', 1)
            ->first();
    }

    public function getEmpByUserCode($user_code,$pid)
    {
        return $this->user->with(['section', 'studentInfo','employeePayroll'=>function($emproll) use ($pid){
            return $emproll->find($pid);
        }])->bySchool(Auth::user()->school_id)
            ->where('student_code', $user_code)
            ->where('active', 1)
            ->first();
    }

    public function storeAdmin($request)
    {
        $tb = new $this->user;
        $tb->name = $request->name;
        $tb->email = $request->email;
        $tb->password = bcrypt($request->password);
        $tb->role = 'admin';
        $tb->active = 1;
        $tb->isSuper = ($request->isSuper == 1 ? 1 : 0);
        $tb->role = ($request->role ?? '');
        $tb->role_title = ($request->role_title ?? '');
        $tb->school_id = session('register_school_id');
        $tb->code = session('register_school_code');
        $tb->student_code = generateStudentCode(session('register_school_id'));
        $tb->gender = $request->gender;
        $tb->blood_group = $request->blood_group;
        $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
        $tb->phone_number = $request->phone_number;
        $tb->pic_path = (!empty($request->url)) ? fileUpload($request->url, 'AP') : '';
        $tb->verified = 1;
        $tb->assign_school = Auth::guest() ? school('id') : Auth::user()->school_id;
        $tb->save();
        return $tb;
    }

    public function storeStudent($request)
    {
        $school_id = auth()->user()->school_id;
        $student_code = generateStudentCode($school_id, false, true);
        $email = (!empty($request->email) ? $request->email : ($student_code . '@' . str_replace('www.', '', $_SERVER['SERVER_NAME'])));
        $password = (isset($request->password) ? $request->password : '123456');
        $tb = new $this->user;
        $tb->name = $request->name;
        $tb->email = $email;
        $tb->password = bcrypt($password);
        $tb->role = 'student';
        $tb->active = 1;
        $tb->school_id = $school_id;
        $tb->code = auth()->user()->code;// School Code
        $tb->student_code = $student_code;
        $tb->gender = $request->gender;
        $tb->blood_group = $request->blood_group;
        $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
        $tb->phone_number = $request->phone_number;
        $tb->address = (!empty($request->address)) ? $request->address : '';
        $tb->about = (!empty($request->about)) ? $request->about : '';
        $tb->pic_path = (!empty($request->url)) ? fileUpload($request->url, 'SP') : '';
        $tb->verified = 1;
        $tb->section_id = $request->section;
        $tb->save();
        self::updateStudentInfo($request, $tb->id);
        return $tb;
    }

    public function storeStaff($request, $role)
    {
        $tb = new $this->user;
        $tb->name = $request->name;
        $tb->email = (!empty($request->email)) ? $request->email : '';
        $tb->password = bcrypt($request->password);
        $tb->role = $role;
        if (Auth::check()) {
            $school_id = auth()->user()->school_id;
            $tb->assign_school = $school_id;
            $tb->school_id = $request->school_id ?? $school_id;
            $tb->code = auth()->user()->code;
            $tb->student_code = generateStudentCode($school_id);
            $tb->gender = $request->gender;
            $tb->role_title = $request->role_title ?? ucfirst($role);
            $tb->blood_group = $request->blood_group;
            $tb->verified = 1;
            $tb->active = 1;
        } else {
            $tb->assign_school = $request->school_id;
            $tb->school_id = $request->school_id;
            $tb->code = $request->school_code;
            $tb->student_code = generateStudentCode($request->school_id);
            $tb->verified = 0;
            $tb->active = 2;
            $tb->role_title = ucfirst($role);
        }
        $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
        $tb->phone_number = $request->phone_number;
        $tb->pic_path = (!empty($request->url)) ? fileUpload($request->url, 'STP') : '';
        $tb->cv = (!empty($request->teacher_cv)) ? multiFileUpload($request->teacher_cv, 'CV') : '';
        $tb->department_id = (!empty($request->department_id)) ? $request->department_id : 0;
        if ($role == 'teacher') {
            $tb->section_id = ($request->class_teacher_section_id != 0) ? $request->class_teacher_section_id : 0;
        }

        $tb->save();
        
        $detail = EmployeeDetail::firstOrCreate(['employee_id' => $tb->id]);
        $detail->employee_id = $tb->id;
        $detail->user_id = auth()->user()->id;
        $detail->house_id = (!empty($request->house_id)) ? $request->house_id : '';
        $detail->joindate = (!empty($request->joindate)) ? $request->joindate : '';
        $detail->save();
        
        return $tb;
    }

}