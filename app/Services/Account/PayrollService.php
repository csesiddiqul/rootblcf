<?php

namespace App\Services\Account;

use function auth;
use App\School;
use App\User;
use App\EmployeeDetail;
use App\EmployeePayroll;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PayrollService
{ 
    protected $school;
    protected $user;
    protected $payroll;
    public $request;

    public function __construct(School $school, User $user, EmployeePayroll $payroll)
    {
        $this->school = $school;
        $this->user = $user;
        $this->payroll = $payroll; 
    }

    public function getSchoolDetails()
    { 
        $getschool = $this->school->select('id','name','payrollMonth','payFor','bonus')->findOrfail(\auth()->user()->school_id);
        if($getschool){
            return $getschool;
        }else{ 
            return 0;
        }
    }

    public function payrollDetail($date,$sch_id)
    {
        
    }

    public function firstEmployee($id)
    {
        return $this->payroll->find($id);
    }

    public function getEmployee()
    {
        $schooldetail = $this->getSchoolDetails();

        $payMonth = date('Y-m',strtotime($schooldetail->payrollMonth));

        $processed = $this->payroll->where('payDate', 'LIKE', '%' . $payMonth . '%')->where('school_id',$schooldetail->id)->where('empType',$schooldetail->payFor)->whereIn('status',[0,1,2])->pluck('employee_id')->toArray();
        
        if($schooldetail->payFor == 1){ 
            return $this->user->where('code', auth()->user()->school->code)
            ->where('role', 'teacher')
            ->where('active', 1)
            ->whereNotIn('id', $processed)
            ->orderBy('name', 'asc')
            ->get();
        }else{
            return $this->user->where('code', auth()->user()->school->code)
            ->whereIn('role', ['admin', 'accountant', 'librarian', 'staff'])
            ->where('active', 1)
            ->whereNotIn('id', $processed)
            ->orderBy('name', 'asc')
            ->get();
        }
        
    }

    public function getPendingList()
    {
        $schooldetail = $this->getSchoolDetails(); 
        $payMonth = date('Y-m',strtotime($schooldetail->payrollMonth));

        return $this->payroll->where('payDate', 'LIKE', '%' . $payMonth . '%')
            ->where('school_id',$schooldetail->id)
            ->where('empType',$schooldetail->payFor)
            ->where('status',2)
            ->orderBy('id', 'asc')
            ->get();
    }

    public function getpending()
    {
        $schooldetail = $this->getSchoolDetails();
        $payMonth = date('Y-m',strtotime($schooldetail->payrollMonth));
        return $this->payroll->where('payDate', 'LIKE', '%' . $payMonth . '%')
            ->where('school_id',$schooldetail->id)
            ->where('empType',$schooldetail->payFor)
            ->where('status',2)
            ->orderBy('id', 'asc')
            ->get();
    }




    public function getApproveList()
    {
        $schooldetail = $this->getSchoolDetails(); 
        $payMonth = date('Y-m',strtotime($schooldetail->payrollMonth));

        return $this->payroll->where('payDate', 'LIKE', '%' . $payMonth . '%')
            ->where('school_id',$schooldetail->id)
            ->where('empType',$schooldetail->payFor)
            ->where('status',0)
            ->orderBy('id', 'asc')
            ->get();
    }

    public function searchPaidList($type,$form,$to,$selected)
    { 
        $schooldetail = $this->getSchoolDetails(); 

        $payMonth = date('Y-m-01',strtotime($form));

        if($to != 'blank'){
            $toMonth = date('Y-m-t',strtotime($to));  
        }else{
            $toMonth = date('Y-m-t',strtotime($form));  
        }

        if($selected != 'blank'){
            return $this->payroll->whereBetween('payDate',[$payMonth,$toMonth])
            ->where('school_id',$schooldetail->id)
            ->where('employee_id',$selected)
            ->where('empType',$type)
            ->where('status',1)
            ->orderBy('id', 'asc')
            ->get(); 
        }else{
            return $this->payroll->whereBetween('payDate',[$payMonth,$toMonth])
            ->where('school_id',$schooldetail->id)
            ->where('empType',$type)
            ->where('status',1)
            ->orderBy('id', 'asc')
            ->get();
        } 
    }

    public function getPaidList($type)
    {
        $schooldetail = $this->getSchoolDetails(); 
        $payMonth = date('Y-m',strtotime($schooldetail->payrollMonth));

        return $this->payroll->where('payDate', 'LIKE', '%' . $payMonth . '%')
            ->where('school_id',$schooldetail->id)
            ->where('empType',$type)
            ->where('status',1)
            ->orderBy('id', 'asc')
            ->get();
    }

    public function getFirstPay($id)
    {  
        return $this->payroll->where('id', $id)
            ->where('school_id', auth()->user()->school->id) 
            ->where('status',1) 
            ->first();
    }

    public function getAllPay($id)
    {  
        return $this->payroll->where('employee_id', $id)
            ->where('school_id', auth()->user()->school->id) 
            ->where('status',1) 
            ->orderBy('payDate', 'DESC')
            ->get();
    }
    
}
