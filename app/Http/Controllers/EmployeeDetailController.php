<?php

namespace App\Http\Controllers;

use App\EmployeeDetail;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EmployeeDetailController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    public function index()
    {
        return redirect('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeeDetail  $employeeDetail
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeDetail $employeeDetail)
    {
        return redirect('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeDetail  $employeeDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $code)
    {         
        $user = User::whereStudent_code($code)->first();
       
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
            if (isset($user->employeeDetail)) {
                $employee = $user->employeeDetail; 
            } else {
                $employee = new EmployeeDetail();
                $employee->employee_id = $user->id;
                $employee->user_id = auth()->user()->id;
            }
            
            $employee->payScale = $request->payScale;
            $employee->exScale = $request->exScale;
            $employee->bank_name = $request->bank_name;
            $employee->account_no = $request->account_no;
            $employee->remarks = $request->remarks;
            $employee->save();
            toast(transMsg('Salary information updated successfully'), 'success')->timerProgressBar();
            return redirect()->back();
        }
        if ($user->role == "teacher") {
            $emplists = $this->userService->getTeachers();
        } else if($user->role == "admin" || $user->role == "accountant" || $user->role == "librarian" || $user->role == "staff"){
            $emplists = $this->userService->getStaffs();
        }
        
        return view('employeedetail.edit', compact('user','emplists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeDetail  $employeeDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeDetail $employeeDetail)
    {
        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeDetail  $employeeDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeDetail $employeeDetail)
    {
        return redirect('home');
    }
}
