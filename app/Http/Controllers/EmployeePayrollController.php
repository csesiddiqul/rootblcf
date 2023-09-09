<?php

namespace App\Http\Controllers;

use App\EmployeePayroll;
use Illuminate\Http\Request;
use App\User;
use App\School;
use App\EmployeeDetail;
use App\Services\Account\PayrollService;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EmployeePayrollController extends Controller
{
    protected $payrollService;
    protected $userService;

    public function __construct(PayrollService $payrollService, UserService $userService)
    {
        parent::__construct();
        $this->payrollService = $payrollService;
        $this->userService = $userService;
    } 

    public function updateSetting(Request $request)
    { 
        $school = $this->payrollService->getSchoolDetails();
        
        if($school){
            $school->payrollMonth = $request->payrollMonth;
            $school->payFor = $request->emptype;

            if(isset($request->bonus)){
                $school->bonus = $request->bonus;
            }else{
                $school->bonus = 0;
            }
            
            $school->save(); 
        }  
        return back();
        //return redirect()->route('payroll.index.process','first'); 
    }

    public function index($ids)
    {
        $schData = $this->payrollService->getSchoolDetails();

        if(empty($schData)){
            toast(transMsg('Your request is not valid.'), 'success')->timerProgressBar();
            return back();
        }

        $employee = $this->payrollService->getEmployee();
        
        if($employee->count() > 0 && $ids == 'first'){
            $firstEmployee = $this->userService->getUserByUserCode($employee[0]->student_code);
        }else if($employee->count() > 0 && $ids != 'first'){
            $firstEmployee = $this->userService->getUserByUserCode($ids);
        }else{
            $firstEmployee = [];
        }
        
        return view('payrolls.process',compact('schData','firstEmployee','employee'));
    }

    public function pending($ids, $pid=null)
    {
        $schData = $this->payrollService->getSchoolDetails();

        if(empty($schData)){
            toast(transMsg('Your request is not valid.'), 'success')->timerProgressBar();
            return back();
        }

        $pendings = $this->payrollService->getpending();
        $firstEmployee = $this->userService->getEmpByUserCode($ids,$pid);
        
        return view('payrolls.pending',compact('schData','pendings','firstEmployee')); 
    }

    public function approve($ids, $pid=null)
    {
//        return $ids;

        $schData = $this->payrollService->getSchoolDetails();

        if(empty($schData)){
            toast(transMsg('Your request is not valid.'), 'success')->timerProgressBar();
            return back();
        }

        $pendings = $this->payrollService->getApproveList();

        $firstEmployee = $this->userService->getEmpByUserCode($ids,$pid);
        //return $firstEmployee;



      //$emprosessdata =  EmployeePayroll::where('employee_id','=',$firstEmployee->id)->whereNotIn('status',[1])->latest()->first();





        return view('payrolls.approve',compact('schData','pendings','firstEmployee'));
    }

    public function paidlist(Request $request, $ids)
    {
        $schData = $this->payrollService->getSchoolDetails();

        if(empty($schData)){
            toast(transMsg('Your request is not valid.'), 'success')->timerProgressBar();
            return back();
        }

        if ($request->isMethod('post')) { 
            $form = $form_val = $request->formMonth;
            $to = $empid = "blank";

            if(!empty($request->toMonth)){
                $to = $to_val =  $request->toMonth; 
            }else{
                $to_val = "";
            }

            if(!empty($request->emplistget)){
                $empid = $request->emplistget;
            }
            
            $paidlists = $this->payrollService->searchPaidList($ids,$form,$to,$empid); 
            $selected = $request->emplistget; 
        }else{
            $paidlists = $this->payrollService->getPaidList($ids);
            $selected = '';
            $form_val = date('Y-m-01',strtotime($schData->payrollMonth ? $schData->payrollMonth : date('Y-m-d')));
            $to_val = date('Y-m-t',strtotime($schData->payrollMonth ? $schData->payrollMonth : date('Y-m-d')));
        }
        
        //return $to_val;

        if ($ids == 1) {
            $emplists = $this->userService->getTeachers();
        } else if($ids == 2){
            $emplists = $this->userService->getStaffs();
        }else{
            $emplists = [];
        }
        
        return view('payrolls.paidlist',compact('schData','paidlists','emplists','selected','ids','form_val','to_val')); 
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $schData = $this->payrollService->getSchoolDetails();

        if(empty($schData)){
            toast(transMsg('Your request is not valid.'), 'success')->timerProgressBar();
            return back();
        }
        
        $request['school_id'] = auth()->user()->school_id;
        $request['user_id'] = auth()->user()->id;
        $request['payDate'] = $schData->payrollMonth;
        $request['empType'] = $schData->payFor;
        
        //return $request;
        
        EmployeePayroll::create($request->all());
        toast(transMsg('Salary process completed.'), 'success')->timerProgressBar();
        return redirect()->route('payroll.index.process','first');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeePayroll  $employeePayroll
     * @return \Illuminate\Http\Response
     */
    public function show($ids)
    {
        $id = explode('-',$ids); 

        if(count($id) != 2){
            toast(transMsg('Your request is not valid.'), 'success')->timerProgressBar();
            return back();
        }
        
        $firstSlip = $this->payrollService->getFirstPay($id[0]); 

        if(empty($firstSlip) || $firstSlip->payrollUser->student_code != $id[1]){
            toast(transMsg('Your request is not valid.'), 'success')->timerProgressBar();
            return back();
        }
        
        $allSlips = $this->payrollService->getAllPay($firstSlip->employee_id);
        //return $firstSlip->school['name'];
        return view('payrolls.show',compact('firstSlip','allSlips')); 
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeePayroll  $employeePayroll
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {



        $schData = $this->payrollService->getSchoolDetails();

        if(empty($schData)){
            toast(transMsg('Your request is not valid.'), 'success')->timerProgressBar();
            return back();
        }

        $process = $this->payrollService->getApproveList(); 

        foreach($process as $proces){ 
            $arrear = 0; 
            $payroll = EmployeePayroll::find($proces->id);  
            $payroll->approved = date('Y-m-d'); 
            $payroll->status = 1; 
            

            if($payroll->arrearsPay < $payroll->arrears){ 
                $arrear = $payroll->arrears - $payroll->arrearsPay;
            }else if($payroll->arrearsPay == $payroll->arrears){
                $arrear = 0; 
            }

            $carry_arrear = $arrear + $payroll->amountDue;  
            $payroll->save(); 

            EmployeeDetail::whereEmployeeId($payroll->employee_id)->update(['arrears'=>$carry_arrear]);
        }

        toast(transMsg('Approved the statement.'), 'success')->timerProgressBar();
        return redirect()->route('payroll.index.approve','first');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeePayroll  $employeePayroll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $back)
    {
      

        $schData = $this->payrollService->getSchoolDetails();

        if(empty($schData)){
            toast(transMsg('Your request is not valid.'), 'success')->timerProgressBar();
            return back();
        }
        
        $input = $request->all(); 
        $input['payDate'] = $schData->payrollMonth;  
        
        $payroll = EmployeePayroll::find($input['id']);
        

        if($input['status'] == 1){
            $arrear = 0; 
            $payroll->approved = date('Y-m-d'); 
            
            if($input['arrearsPay'] < $input['arrears']){ 
                $arrear = $input['arrears'] - $input['arrearsPay'];
            }else if($input['arrearsPay'] == $input['arrears']){
                $arrear = 0; 
            }

            $carry_arrear = $arrear + $input['amountDue'];
            
            EmployeeDetail::whereEmployeeId($payroll->employee_id)->update(['arrears'=>$carry_arrear]);
            toast(transMsg('Salary process completed.'), 'success')->timerProgressBar();
        }else{
            toast(transMsg('Update process completed.'), 'success')->timerProgressBar();
        } 
        
        $payroll->update($input); 

        if($back == 'pending'){ 
            return redirect()->route('payroll.index.pending','first');
        } 
        
        return redirect()->route('payroll.index.approve','first'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeePayroll  $employeePayroll
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeePayroll $employeePayroll)
    {
        //
    }
}
