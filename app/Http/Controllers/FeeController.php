<?php

namespace App\Http\Controllers;

use App\Due;
use App\Myclass;
use App\Section;
use App\StudentInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Batch;
use Illuminate\Validation\Rule;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['fees'] = $this->fee->bySchool(auth()->user()->school_id)->orderBy('created_at', 'DESC')->limit(150)->get();
        
        // $data['fees'] = $this->fee->bySchool(auth()->user()->school_id)->orderBy('created_at', 'DESC')->get();
        return view('fees.all', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $school_id = auth()->user()->school_id;
        $data['head'] = $this->accountSector->where('type', 'income')->bySchool($school_id)->pluck('name', 'id');
        return view('fees.create', $data);
    }

    public function singalecreate($id)
    {
        $stduntname = User::where('student_code', $id)->first();
        $sn = Section::find( $stduntname->section_id);
        $scl = Myclass::find($sn->class_id);
        $rstatus = StudentInfo::where('student_id', '=', $stduntname->id)->get();
        $rst =  $rstatus->first()->singaporepr;


        $school_id = auth()->user()->school_id;
        $data['head'] = $this->accountSector->where('type', 'income')->bySchool($school_id)->pluck('name', 'id');
        return view('fees.singale_fee_create', $data,compact('stduntname','sn','scl','rst','id'));
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
            'sections' => 'required|numeric',
            'type' => 'required|array',
            'amount' => 'required|array',
            'date' => 'required|array',
            'cycle' => 'required|numeric',
            'student' => 'required|array|distinct',
            'r_status' => 'numeric|' . Rule::requiredIf(function () use ($request) {
                    return school('country')->code == 'SG';
                }),
        ], [
            'student.required' => 'The Student filed is required',
            'sections.required' => 'The Section filed is required',
            'r_status.required' => 'The Resident Status filed is required',
            'r_status.numeric' => 'The Resident Status is numeric value',
        ]);
        $school_id = auth()->user()->school_id;
        $types = $request->type;
        $fSection = $this->section->find($request->sections);
        $section = $fSection->id;
        $class = $fSection->class_id;
        $session = currentSession();
        $user_id = Auth::user()->id;
        $financialYear = current_financial_year();

        for ($i = 0; $i < count($types); $i++) {

            if($types[$i] == 8){

                for ($ni = 0 ; $ni < $request->cycle; $ni++){

//                    $endate=date('Y-m-d',strtotime('+'.$ni.'month',strtotime($request->date[$i])));

                    $fee = new $this->fee;
                    $fee->type = $types[$i];
                    $fee->amount = $request->amount[$i];
                    $fee->cycle = 1;
                    $fee->school_id = $school_id;
                    $fee->date = date('Y-m-d',strtotime('+'.$ni.'month',strtotime($request->date[$i])));
                    $fee->user_id = $user_id;
                    $fee->financialYear_id = $financialYear->id;
                    $fee->save();

                    $students = $this->user->bySchool($school_id)->whereRole('student')->select('id as student_id', 'school_id', 'section_id')
                        ->addSelect(DB::raw($class . " as class_id, " . $fee->id . " as fee_id, " . $user_id . " as user_id"))
                        ->whereHas('studentInfo', function ($q) use ($session) {
                            $q->where('session', $session->id);
                        })->whereSection_id($section);

                    $student = $request->student;

                    if (count($student) > 1) {
                        $students = $students->whereIn('id', $student);
                        $students = $students->get()->toArray();
                        $batchSize = count($students);
                    } else {
                        if ($student[0] === "all") {
                            $students = $students->get()->toArray();
                            $batchSize = count($students);
                        } else {
                            $students = $students->whereIn('id', $student);
                            $students = $students->get()->toArray();
                            $batchSize = 1;
                        }
                    }


                    if (count($students) > 0) {
                        $due = new $this->due;
                        $columns = [
                            'student_id',
                            'school_id',
                            'section_id',
                            'class_id',
                            'fee_id',
                            'user_id',
                        ];
                        // insert 500 (default), 100 minimum rows in one query
                        $result = Batch::insert($due, $columns, $students, $batchSize);
                    }

                }
            }

            if($types[$i] != 8){

                $fee = new $this->fee;
                $fee->type = $types[$i];
                $fee->amount = $request->amount[$i];
                $fee->cycle = 1;
                $fee->school_id = $school_id;
                $fee->date = date('Y-m-d', strtotime($request->date[$i]));
                $fee->user_id = $user_id;
                $fee->financialYear_id = $financialYear->id;
                $fee->save();



                $students = $this->user->bySchool($school_id)->whereRole('student')->select('id as student_id', 'school_id', 'section_id')
                    ->addSelect(DB::raw($class . " as class_id, " . $fee->id . " as fee_id, " . $user_id . " as user_id"))
                    ->whereHas('studentInfo', function ($q) use ($session) {
                        $q->where('session', $session->id);
                    })->whereSection_id($section);

                $student = $request->student;

                if (count($student) > 1) {
                    $students = $students->whereIn('id', $student);
                    $students = $students->get()->toArray();
                    $batchSize = count($students);
                } else {
                    if ($student[0] === "all") {
                        $students = $students->get()->toArray();
                        $batchSize = count($students);
                    } else {
                        $students = $students->whereIn('id', $student);
                        $students = $students->get()->toArray();
                        $batchSize = 1;
                    }
                }


                if (count($students) > 0) {
                    $due = new $this->due;
                    $columns = [
                        'student_id',
                        'school_id',
                        'section_id',
                        'class_id',
                        'fee_id',
                        'user_id',
                    ];
                    // insert 500 (default), 100 minimum rows in one query
                    $result = Batch::insert($due, $columns, $students, $batchSize);
                }
            }



        }
        toast('Dues Generated successfully', 'success')->timerProgressBar();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['fee'] = $this->fee->bySchool(auth()->user()->school_id)->find($id);
        return view('fees.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $stduntname = User::where('student_code', $id)->first();
        $sn = Section::find( $stduntname->section_id);

        $deudata = Due::where('status', 'Like', 1)->where('student_id', '=', $stduntname->id)->get();


        $scl = Myclass::find($sn->class_id);
        $school_id = auth()->user()->school_id;

        $data['head'] = $this->accountSector->where('type', 'income')->bySchool($school_id)->pluck('name', 'id');
        return view('fees.singale_deu_edit', $data,compact('stduntname','sn','scl','deudata'));
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
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return back();
    }
}
