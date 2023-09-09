<?php

namespace App\Http\Controllers;


use App\Admission;
use App\House;
use App\Myclass;
use App\District;
use App\Division;
use App\PreAdmission;
use App\School;
use App\Section;
use App\Setting;
use App\StudentFile;
use App\StudentInfo;
use App\Thana;
use App\Country;
use App\State;
use App\User;
use Carbon\Carbon;
use Dompdf\Exception;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdmissionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['admission'] = $this->admission->bySchool(auth()->user()->school_id)->get();
        return view('admission.index', $data);
    }

    public function admissionActions($value = null, $id = null, $remarks = null)
    {
        $admission = $this->admission->bySchool(auth()->user()->school_id)->where('id', $id)->first();
        if (empty($admission)) {
            return '400';
        }
        if ($value == 3) {
            $admission->remark = $remarks;
        }
        $admission->status = $value;
        if ($admission->save()) {
            $actions = '200';
            if ($value == 2)
                admission_approved_sms($admission);
        } else {
            $actions = '400';
        }
        return $actions;
    }

    public function pendingList()
    {
        if (preAdmissionId() == null) {
            toast(transMsg('There are currently no active admission years, please activate an admission year.'), 'info')->timerProgressBar();
            return redirect()->route('academic.preadmission.index');
        }
        $data['admission'] = $this->admission->bySchool(auth()->user()->school_id)
            ->where('preadmission_id', preAdmissionId())
            ->whereIn('status', [1, 5, 4])
            ->get();
        return view('admission.index', $data);
    }

    public function approveList()
    {
        if (preAdmissionId() == null) {
            toast(transMsg('There are currently no active admission years, please activate an admission year.'), 'info')->timerProgressBar();
            return redirect()->route('academic.preadmission.index');
        }
        $data['admission'] = $this->admission->bySchool(auth()->user()->school_id)
            ->where([['status', '2'], ['preadmission_id', preAdmissionId()]])
            ->get();
        return view('admission.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (preAdmissionId() == null) {
            toast(transMsg('There are currently no active admission years, please activate an admission year.'), 'info')->timerProgressBar();
            return redirect()->route('academic.preadmission.index');
        }
        $data['division'] = (new Division())->pluckDivision();
        $data['country'] = Country::pluck('name', 'id')->sortBy('name');
        $data['housePluck'] = House::pluck('name', 'id')->sortBy('name');
        if (branch_permission()) {
            $data['branchPluck'] = School::where('parent_id', \auth()->user()->school_id)->where('status', 1)->orderBy('name')->pluck('name', 'id');
        }
        return view('admission.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::guest() && empty(session('applicationVal'))) {
            return redirect()->route('apply.admission');
        }
        if (Auth::guest()) {
            $request = session('applicationVal');
        }
        $section = Section::find($request['class_id']);
        if (empty($section)) {
            toast(transMsg('Section not found'), 'info')->timerProgressBar();
            return redirect()->route('apply.admission');
        }
        if ($section->class->school_id != school('id')) {
            toast(transMsg('Section not found'), 'info')->timerProgressBar();
            return redirect()->route('apply.admission');
        }
        $preAdmissionId = preAdmissionId();
        if (empty($preAdmissionId)) {
            toast(transMsg('Admission year not published'), 'info')->timerProgressBar();
            return redirect()->route('apply.admission');
        }
        $admission_roll = admissionRoll();
        $password = (isset($request['password']) ? $request['password'] : '123456');
        $status = foqas_setting('admission_verify') == 1 ? (foqas_setting('add_payment_status') == 1 ? 5 : 1) : (foqas_setting('add_payment_status') == 1 ? 5 : 2);
        $admission = new Admission();
        $admission->school_id = school('id');
        if (isset($request['branch_id']))
            $admission->branch_id = $request['branch_id'];
        $admission->section_id = $section->id;
        $admission->class_id = $section->class_id;
        $admission->name = $request['name'];
        $admission->preadmission_id = $preAdmissionId;
        $admission->roll = $admission_roll;
        $admission->add_pass = substr(number_format(time() * mt_rand(), 0, '', ''), 0, 6);
        $admission->placeBirth = $request['placeBirth'];
        $admission->gender = $request['gender'];
        $admission->religon = $request['religon'];
        $admission->dob = date('Y-m-d', strtotime(str_replace('/', '-', $request['dob'])));
        $admission->bloodgroup = $request['bloodgroup'];
        $admission->mobile = $request['mobile'];
        $admission->email = (!empty($request['email']) ? $request['email'] : $admission_roll . '@' . str_replace('www.', '', $_SERVER['SERVER_NAME']));
        $admission->password = Hash::make($password);
        $admission->photo = (!empty($request['url'])) ? fileUpload($request['url'], 'SP') : '';
        $admission->nationality = $request['nationality'];
        $admission->father_name = $request['father_name'];
        $admission->mother_name = $request['mother_name'];
        $admission->gName = $request['gName'];
        $admission->gNationality = $request['gNationality'];
        $admission->gMobile = $request['gMobile'];
        $admission->gEmail = $request['gEmail'];
        $admission->gdate = isset($request['gdate']) ? date('Y-m-d', strtotime(str_replace('/', '-', $request['gdate']))) : '';
        $admission->gPhone = isset($request['gPhone']) ? $request['gPhone'] : '';
        $admission->gAddress = $request['gAddress'];
        $admission->gOccupation = $request['gOccupation'];
        $admission->contactperson = $request['contactperson'];
        $admission->contactpersonmobile = $request['contactpersonmobile'];
        $admission->realation = $request['realation'];
        $admission->cemail = $request['cemail'];
        $admission->nameAddressofmainSchool = $request['nameAddressofmainSchool'];
        $admission->previous_class = $request['previous_class'];
        if (school('country')->code == 'BD') {
            $admission->country = school('country')->id;
            $admission->presentAddress = $request['presentAddress'];
            $admission->perpostoffice = $request['perpostoffice'];
            $admission->perpostcode = $request['perpostcode'];
            $admission->preDivision = $request['preDivision'];
            $admission->preDistrict = $request['preDistrict'];
            $admission->preThana = $request['preThana'];
            $admission->persent_same = $request['persent_same'] ?? null;
            $admission->last_gpa = $request['last_gpa'];
            if ($request['persent_same']) {
                $admission->pastAddress = $request['presentAddress'];
                $admission->pastpostoffice = $request['perpostoffice'];
                $admission->pastpostcode = $request['perpostcode'];
                $admission->pastDivision = $request['preDivision'];
                $admission->pastDistrict = $request['preDistrict'];
                $admission->pastThana = $request['preThana'];
            } else {
                $admission->pastAddress = $request['pastAddress'];
                $admission->pastpostoffice = $request['pastpostoffice'];
                $admission->pastpostcode = $request['pastpostcode'];
                $admission->pastDivision = $request['pastDivision'];
                $admission->pastDistrict = $request['pastDistrict'];
                $admission->pastThana = $request['pastThana'];
            }
        } elseif (school('country')->code == 'SG') {
            $admission->admissioninbengaliClass = $request['admissioninbengaliClass'];
            $admission->gnrcNo = $request['gnrcNo'];
            $admission->bengaliLang = $request['bengaliLang'];
            $admission->singaporepr = $request['singaporepr'];
            /* $admission->streetAddress_1 = $request['streetAddress_1'];
             $admission->streetAddress_2 = $request['streetAddress_2'];
             $admission->city = $request['city'];
             $admission->state = $request['state'];
             $admission->zipCode = $request['zipCode'];
             $admission->country = $request['country'];*/
        } else {
            $admission->streetAddress_1 = $request['streetAddress_1'];
            $admission->streetAddress_2 = $request['streetAddress_2'];
            $admission->city = $request['city'];
            $admission->state = $request['state'];
            $admission->zipCode = $request['zipCode'];
            $admission->country = $request['country'];
        }
        $admission->birthcertificateNo = $request['birthcertificateNo'];
        $admission->status = $status;
        $admission->save();

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
                    $student_file->student_id = $admission->id; // admission id
                    $student_file->name = admission_additional_file($item);
                    $student_file->file = Auth::guest() ? $request[$field_name] : multiFileUpload($request->file($field_name), 'ADDITIONAL');;
                    $student_file->save();
                }
            }
        }
        admission_submit_sms($admission);
        if (foqas_setting('email')) {
            Mail::send('email.admission.submit', ['admission' => $admission], function ($m) use ($admission) {
                if (school('id') == 14) {
                    $email = ['mgsabur@gmail.com', 'milia_sabed@hotmail.com'];
                } else {
                    $email = foqas_setting('email');
                }
                $subject = 'An Admission Form has been Received #' . $admission->roll . ' Time: ' . date('h:i a',strtotime($admission->created_at)). ' Date: '. date('d M, Y',strtotime($admission->created_at));
                $m->from(config('mail.from.address'), \school('name'));
                $m->to($email)->subject($subject);
                $bccEmails = ['md@ipsitasoft.com'];
                $m->bcc($bccEmails)->subject($subject);
            });
        }
        if (Auth::check()) {
            toast(transMsg('Admission Created successfully'), 'success')->timerProgressBar();
            return redirect()->back();
        }
        session()->put('applicationVal', $admission);
        toast(transMsg('Your application submitted successfully'), 'success')->timerProgressBar();
        return redirect()->route('print.apply');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Admission $admission
     * @return \Illuminate\Http\Response
     */
    public function show(Admission $admission)
    {
        if ($admission->school_id != auth()->user()->school_id) {
            return redirect()->back();
        }
        $data['admission'] = $admission;
        return view('admission.show', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Admission $admission
     * @return \Illuminate\Http\Response
     */
    public function edit(Admission $admission)
    {
        if ($admission->school_id != auth()->user()->school_id) {
            return redirect()->back();
        }
        $data['country'] = Country::pluck('name', 'id');
        $data['state'] = State::whereCountry_id($admission->country)->pluck('name', 'id');
        $data['division'] = (new Division())->pluckDivision();
        $data['preDistrict'] = (new District())->pluckDistrict($admission->preDivision);
        $data['preThana'] = (new Thana())->pluckThana($admission->preDistrict);
        $data['pastDistrict'] = (new District())->pluckDistrict($admission->pastDivision);
        $data['pastThana'] = (new Thana())->pluckThana($admission->pastDistrict);
        $data['pageTitle'] = $admission->name;
        $data['housePluck'] = House::pluck('name', 'id')->sortBy('name');
        $data['admission'] = $admission;
        if (branch_permission()) {
            $data['branchPluck'] = School::where('parent_id', \auth()->user()->school_id)->where('status', 1)->orderBy('name')->pluck('name', 'id');
        }
        return view('admission.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Admission $admission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admission $admission)
    {
        $school_id = auth()->user()->school_id;
        if ($admission->school_id != $school_id) {
            return redirect()->back();
        }
        $this->validate($request, [
            'email' => 'required|email|unique:users,email,' . $admission->id . ',id,school_id,' . $school_id,
            'name' => 'required|string',
            'class_id' => 'required|numeric'
        ], [
            'class_id.required' => transMsg('Class name is required')
        ]);

        $section = Section::find($request->class_id);
        if (empty($section)) {
            return redirect()->route('apply.admission');
        }
        if (isset($request->branch_id))
            $admission->branch_id = $request->branch_id;
        $admission->class_id = $section->class_id;
        $admission->section_id = $section->id;
        $admission->name = $request->name;
        $admission->placeBirth = $request->placeBirth;
        $admission->gender = $request->gender;
        $admission->photo = (!empty($request['url'])) ? fileUpload($request['url'], 'SP') : $admission->photo;
        $admission->religon = $request->religon;
        $admission->dob = date('Y-m-d', strtotime(str_replace('/', '-', $request->dob)));
        $admission->bloodgroup = $request->bloodgroup;
        $admission->mobile = $request->mobile;
        $admission->email = $request->email;
        $admission->nationality = $request->nationality;
        $admission->father_name = $request->father_name;
        $admission->mother_name = $request->mother_name;
        $admission->gName = $request->gName;
        $admission->gNationality = $request->gNationality;
        $admission->gMobile = $request->gMobile;
        $admission->gEmail = $request->gEmail;
        $admission->gdate = date('Y-m-d', strtotime(str_replace('/', '-', $request->gdate)));
        $admission->gPhone = $request->gPhone;
        $admission->gAddress = $request->gAddress;
        $admission->gOccupation = $request->gOccupation;
        $admission->contactperson = $request->contactperson;
        $admission->contactpersonmobile = $request->contactpersonmobile;
        $admission->realation = $request->realation;
        $admission->cemail = $request->cemail;
        $admission->nameAddressofmainSchool = $request->nameAddressofmainSchool;
        $admission->previous_class = $request->previous_class;
        if (school('country')->code == 'BD') {
            $admission->presentAddress = $request->presentAddress;
            $admission->perpostoffice = $request->perpostoffice;
            $admission->perpostcode = $request->perpostcode;
            $admission->preDivision = $request->preDivision;
            $admission->preDistrict = $request->preDistrict;
            $admission->preThana = $request->preThana;
            if ($request->persent_same) {
                $admission->persent_same = $request->persent_same;
                $admission->pastAddress = $request->presentAddress;
                $admission->pastpostoffice = $request->perpostoffice;
                $admission->pastpostcode = $request->perpostcode;
                $admission->pastDivision = $request->preDivision;
                $admission->pastDistrict = $request->preDistrict;
                $admission->pastThana = $request->preThana;
            } else {
                $admission->pastAddress = $request->pastAddress;
                $admission->pastpostoffice = $request->pastpostoffice;
                $admission->pastpostcode = $request->pastpostcode;
                $admission->pastDivision = $request->pastDivision;
                $admission->pastDistrict = $request->pastDistrict;
                $admission->pastThana = $request->pastThana;
            }
        } elseif (school('country')->code == 'SG') {
            $admission->admissioninbengaliClass = $request->admissioninbengaliClass;
            $admission->gnrcNo = $request->gnrcNo;
            $admission->singaporepr = $request->singaporepr;
            $admission->bengaliLang = $request->bengaliLang;
            /*  $admission->streetAddress_1 = $request->streetAddress_1;
              $admission->streetAddress_2 = $request->streetAddress_2;
              $admission->city = $request->city;
              $admission->state = $request->state;
              $admission->zipCode = $request->zipCode;
              $admission->country = $request->country;*/
        } else {
            $admission->streetAddress_1 = $request->streetAddress_1;
            $admission->streetAddress_2 = $request->streetAddress_2;
            $admission->city = $request->city;
            $admission->state = $request->state;
            $admission->zipCode = $request->zipCode;
            $admission->country = $request->country;
        }
        $admission->birthcertificateNo = $request->birthcertificateNo;
        /*  $admission->status = $request->status;
          $admission->remark = $request->remark;*/
        $admission->password = (!empty($request->password) ? Hash::make($request->password) : $admission->password);
        $admission->save();

        if (foqas_setting('admission_additional_file') !== '')
            $additional_files = explode(',', foqas_setting('admission_additional_file'));
        else
            $additional_files = [];

        foreach ($additional_files as $item) {
            if ($item != 1) {
                $field_name = school('code') . $item;
                if (isset($request->$field_name)) {
                    $student_file_name = admission_additional_file($item);;
                    $exist_file = StudentFile::where('student_id', $admission->id)->where('name', 'like', '%' . $student_file_name . '%')->first();
                    if ($exist_file) {
                        $exist_file->file = multiFileUpload($request->file($field_name), 'ADDITIONAL');
                        $exist_file->save();
                    } else {
                        $student_file = new StudentFile();
                        $student_file->type = 2; // admission
                        $student_file->student_id = $admission->id; // admission id
                        $student_file->name = $student_file_name;
                        $student_file->file = multiFileUpload($request->file($field_name), 'ADDITIONAL');
                        $student_file->save();
                    }
                }
            }
        }

        toast(transMsg('Admission updated successfully'), 'success')->timerProgressBar();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Admission $admission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admission $admission)
    {
        if ($admission->school_id != auth()->user()->school_id) {
            return redirect()->back();
        }
        $admission->delete();
        toast(transMsg('Admission Delete successfully'), 'success')->timerProgressBar();
        return redirect()->route('academic.admission.index');


    }

    public function enrollStudent($code, $id, $year)
    {
        if ($code != Auth::user()->school->code) {
            return redirect()->back();
        }
        $school_id = auth()->user()->school_id;
        $data['admissionyear'] = $preAdmission = PreAdmission::bySchool($school_id)->where('status', 1)->find($id);
        if (!empty($preAdmission)) {
            if ($preAdmission->year != $year) {
                toast(transMsg('Pre Admission not found'), 'error')->timerProgressBar();
                return redirect()->back();
            }
            $data['getmessage'] = 'FirstTime';
            if (request()->isMethod('POST')) {
                $data['class_id'] = $class_id = $_REQUEST['class_id'];
                $data['from_st'] = $from_st = $_REQUEST['from_st'];
                if (empty($class_id) || !is_numeric($class_id)) {
                    toast(transMsg('Please select an class'), 'error')->timerProgressBar();
                    goto todo;
                }
                if (!in_array($from_st, [1, 2, 3, 4])) {
                    toast(transMsg('Please select an merit option'), 'error')->timerProgressBar();
                    goto todo;
                }
                $section = Section::find($class_id);
                $students = $this->admission->with(['section'])
                    ->bySchool($school_id)
                    ->where('preadmission_id', $preAdmission->id)
                    ->where('status', 2)
                    ->where('section_id', $class_id)
                    ->orderBy('merit', 'ASC');
                if ($from_st == 1) {
                    $students = $students->where('merit', '!=', null);
                    $admission_total = $section->add_total;
                } else {
                    $from_st = ($from_st - 1);
                    $students = $students->where('waiting_' . $from_st, 1);
                    $admission_total = $section->waiting_ . $from_st;
                }
                if ($admission_total > 0)
                    $students = $students->limit($admission_total);
                $students = $students->get();
                $data['students'] = $students;
                $data['classes'] = $this->class->with('sections')->bySchool($school_id)->status()->orderByRaw('CONVERT(class_number, SIGNED) asc')->get();
                $data['getmessage'] = admissionClass()[$class_id];
            }
            todo:
            view()->share($data);
            return view('admission.enroll');
        }
        return redirect()->back();
    }

    public function enrollPost(Request $request, $preAddID)
    {
        $this->validate($request, [
            'to_section' => 'nullable|array',
            'section_id' => 'required|numeric',
            'add_roll' => 'required|array|distinct',
            'to_session' => 'nullable|array',
            'class_roll' => 'nullable|array|distinct'
        ]);
        $school_id = auth()->user()->school_id;
        $data['admissionyear'] = $preAdmission = PreAdmission::bySchool($school_id)->find($preAddID);
        if (empty($preAdmission)) {
            toast(transMsg('Admission year not found'), 'error')->timerProgressBar();
            return redirect()->back();
        }
        $addRequestRoll = $request->add_roll;
        session()->forget('session_student_code');
        try {
            DB::beginTransaction();
            for ($i = 0; $i < count($addRequestRoll); $i++) {
                $admission = $this->admission->bySchool($school_id)->roll($addRequestRoll[$i])->first();
                if ($admission) {
                    if (isset($request->to_section[$i]) && !empty($request->to_section[$i]) && isset($request->to_session[$i]) && !empty($request->to_session[$i])) {
                        $student_code = generateStudentCode($school_id, false, true);
                        $userDatas = [
                            'name' => $admission->name,
                            'email' => $admission->email,
                            'password' => $admission->password,
                            'role' => 'student',
                            'role_title' => 'Student',
                            'active' => 1,
                            'school_id' => $school_id,
                            'assign_school' => $school_id,
                            'code' => auth()->user()->code,// School Code
                            'student_code' => $student_code,
                            'gender' => $admission->gender,
                            'blood_group' => $admission->bloodgroup,
                            'nationality' => $admission->nationality,
                            'phone_number' => $admission->mobile,
                            'address' => $admission->presentAddress . ',' . $admission->perpostoffice,
                            'pic_path' => $admission->photo,
                            'verified' => 1,
                            'section_id' => $request->to_section[$i],
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                        $user_id = User::insertGetId($userDatas);
                        $studentInfo = [
                            'student_id' => $user_id,
                            'branch_id' => $admission->branch_id,
                            'session' => $request->to_session[$i],
                            'coursegroup_id' => $request->coursegroup_id[$i] ?? '',
                            'birthday' => $admission->dob,
                            'religion' => $admission->religon,
                            'father_name' => $admission->father_name ?? '',
                            'father_phone_number' => $admission->fathercell ?? '',
                            'father_occupation' => $admission->fatheroccupation ?? '',
                            'mother_name' => $admission->mother_name ?? '',
                            'mother_phone_number' => $admission->mothercell ?? '',
                            'mother_occupation' => $admission->motheroccupation ?? '',
                            'user_id' => auth()->user()->id,
                            'height' => $admission->height,
                            'weight' => $admission->weight,
                            'signature' => $admission->signature,
                            'father_email' => $admission->fatheremail,
                            'mother_email' => $admission->motheremail,
                            'father_passport' => $admission->fatherPassport,
                            'contact_person' => $admission->contactperson,
                            'contact_person_mobile' => $admission->contactpersonmobile,
                            'contact_person_email' => $admission->cemail,
                            'relation_with_cperson' => $admission->realation,
                            'present_address' => $admission->presentAddress,
                            'present_post_office' => $admission->perpostoffice,
                            'present_postcode' => $admission->perpostcode,
                            'present_thana' => $admission->preThana,
                            'present_district' => $admission->pastDistrict,
                            'present_division' => $admission->pastDivision,
                            'permanent_address' => $admission->pastAddress,
                            'permanent_post_office' => $admission->pastpostoffice,
                            'permanent_postcode' => $admission->pastpostcode,
                            'permanent_thana' => $admission->pastThana,
                            'permanent_district' => $admission->pastDistrict,
                            'permanent_division' => $admission->pastDivision,
                            'dob_no' => $admission->birthcertificateNo,
                            'gName' => $admission->gName,
                            'gNationality' => $admission->gNationality,
                            'gMobile' => $admission->gMobile,
                            'gEmail' => $admission->gEmail,
                            'gdate' => $admission->gdate,
                            'gnric_no' => $admission->gnrcNo,
                            'gPhone' => $admission->gPhone,
                            'gAddress' => $admission->gAddress,
                            'gOccupation' => $admission->gOccupation,
                            'singaporepr' => $admission->singaporepr,
                            'bengaliLang' => $admission->bengaliLang,
                            'placeBirth' => $admission->placeBirth,
                            'street_address_1' => $admission->streetAddress_1,
                            'street_address_2' => $admission->streetAddress_2,
                            'city' => $admission->city,
                            'state' => $admission->state,
                            'zipCode' => $admission->zipCode,
                            'country' => $admission->country,
                            'admission_mark' => $admission->mark,
                            'main_school_name_address' => $admission->nameAddressofmainSchool,
                            'admission_bengali_class' => $admission->admissioninbengaliClass,
                            'class_roll' => $request->class_roll[$i] ?? '',
                            'previous_class' => $admission->previous_class,
                            'last_gpa' => $admission->last_gpa,
                            'created_at' => now(),
                            'updated_at' => now()
                        ];
                        StudentInfo::insert($studentInfo);
                        $admission->status = 6;
                        $admission->save();
                        $studentFiles = StudentFile::where('student_id', $admission->id)->get();
                        foreach ($studentFiles as $studentFile) {
                            $studentFile->update([['student_id' => $user_id], ['type' => 1]]);
                        }
                        session()->forget('session_student_code');
                        toast(transMsg('Enroll Successfully complete'), 'success')->timerProgressBar();
                    } else {
                        toast(transMsg('Select Section and Course group'), 'error')->timerProgressBar();
                    }
                }
            }
            DB::commit();
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
            toast(Str::limit($exception->getMessage(), 150), 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function markEntry($code, $id, $year)
    {
        if ($code != Auth::user()->school->code) {
            return redirect()->back();
        }
        $data['admissionyear'] = $preAdmission = PreAdmission::bySchool(auth()->user()->school_id)->where('status', 1)->find($id);

        if (!empty($preAdmission)) {
            if ($preAdmission->year != $year) {
                toast(transMsg('Admission year not found'), 'error')->timerProgressBar();
                return redirect()->back();
            }

            $data['getmessage'] = 'FirstTime';
            $data['students'] = array();
            if (request()->isMethod('POST')) {
                //return $_REQUEST['class_id'];
                $data['class_id'] = $class_id = $_REQUEST['class_id'];
                if (empty($class_id) || !is_numeric($class_id)) {
                    goto todo;
                }
                $data['students'] = $this->admission->with(['section'])
                    ->where('preadmission_id', $preAdmission->id)
                    ->where('status', 2)
                    ->where('section_id', $class_id)
                    ->get();
                $data['getmessage'] = admissionClass()[$class_id];
                view()->share($data);
            }
            todo:
            view()->share($data);
            return view('admission.markentry');
        }
        return redirect()->back();
    }

    public function insertMarks()
    {
        $id = $_POST['id'];
        $value = $_POST['editval'];

        $admission = $this->admission->bySchool(auth()->user()->school_id)->find($id);
        if (!empty($admission)) {
            $admission->mark = $value;
            $admission->save();
            return 200;
        } else {
            return 400;
        }
    }

    public function lottery()
    {
        $request = request();
        $school_id = school('id');
        $data = [];
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'class_id' => 'required|numeric',
                'generate_in' => 'required|numeric|in:1,2,3',
                'student_for' => 'nullable|string',
            ]);
            $section_id = $request->class_id;
            $generate_in = $request->generate_in;
            $section = Section::join('classes', 'classes.id', 'sections.class_id')->select('sections.*', 'classes.name')
                ->where([['sections.section_number', 'LIKE', 'admission'], ['classes.school_id', $school_id], ['sections.id', $section_id]])->first();
            if (empty($section)) {
                toast(transMsg('Class not found!'), 'error')->timerProgressBar();
                return back();
            }
            if ($section->add_total == 0) {
                toast(transMsg('Class admission total not set'), 'error')->timerProgressBar();
                return back();
            }
            $students = $this->admission->bySchool($school_id)->where('preadmission_id', preAdmissionId())->where('section_id', $section_id)->where('status', 2);
            if ($section->lottery == 1) {
                $students = $students->orderBy('merit', 'ASC');
                if ($request->student_for == 'on')
                    $students = $students->get();
                else
                    $students = $students->take($section->add_total)->get();
                toast(transMsg('Lottery already generate for class ' . $section->name), 'info')->timerProgressBar();
            } else {
                $students = $students->inRandomOrder($generate_in);
                if ($request->student_for != 'on')
                    $students = $students->limit($section->add_total);
                if ($section->lottery_on_mark == 1)
                    $students = $students->where('mark', '!=', null)->get();
                else
                    $students = $students->get();
                if ($students->count()) {
                    DB::transaction(function () use ($students) {
                        foreach ($students as $key => $student) {
                            $student->update(['lottery' => 1, 'merit' => $key + 1]);
                        }
                    });
                    $section->update(['lottery' => 1]);
                } else {
                    if ($section->lottery_on_mark == 1)
                        toast(transMsg('Student not found with Admission mark for class ' . $section->name), 'info')->timerProgressBar();
                    else
                        toast(transMsg('Student not found for class ' . $section->name), 'info')->timerProgressBar();
                }
            }
            $data['lottery_on_mark'] = $section->lottery_on_mark;
            $data['class_name'] = $section->name;
            $data['students'] = $students;
        }
        return view('admission.lottery', $data);
    }

    public function lottery_sms($section_id, $preAddId)
    {
        $school_id = school('id');
        $section = Section::find($section_id);
        if (empty($section) || $section->class->school_id != $school_id) {
            toast(transMsg('Class not found!'), 'error')->timerProgressBar();
            return back();
        }
        $students = $this->admission->bySchool($school_id)->where('preadmission_id', $preAddId)->where('section_id', $section_id)->where('status', 2)
            ->select('name', 'roll', 'class_id', 'mobile')->take($section->add_total)->get();

        if ($section->lottery_sms == 0) {
            DB::transaction(function () use ($students) {
                foreach ($students as $student) {
                    admission_lottery_sms($student);
                }
            });
            $section->update(['lottery_sms' => 1]);
            toast(transMsg('Message sent successfully'), 'success')->timerProgressBar();
        } else {
            toast(transMsg('Message already sent'), 'info')->timerProgressBar();
        }
        return redirect()->back();
    }

    public function instruction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'instruction_title' => 'nullable|string',
                'instruction_description' => 'nullable|string',
                'form_link' => 'nullable|mimes:pdf,doc,docx,png,jpeg,jpg|max:2048',
            ]);
            $setting = Setting::find(foqas_setting('id'));
            $setting->instruction_title = $request->instruction_title;
            $setting->instruction_description = $request->instruction_description;
            $setting->form_link = $request->hasFile('form_link') ? multiFileUpload($request->file('form_link')) : foqas_setting('form_link');
            $setting->save();
            \Cache::forget('foqas_setting-' . $setting->school_id);
            \Cache::remember('foqas_setting-' . $setting->school_id, 1440 * 30, function () use ($setting) {
                return $setting;
            });
        }
        return view('admission.instruction');
    }
}
