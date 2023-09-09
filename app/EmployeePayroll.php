<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeePayroll extends Model
{
    protected $table = 'employee_payrolls';
    protected $fillable = ['school_id', 'employee_id', 'user_id', 'payDate', 'payScale', 'weekNumber', 'exScale', 'exNumber', 'arrears', 'arrearsPay', 'bonus', 'netPayable', 'amountPaid', 'amountDue', 'bank_name', 'account_no', 'remarks', 'empType', 'status'];

    public function school()
    {
        return $this->belongsTo('App\School', 'school_id', 'id');
    }

    public function payrollUser()
    {
        return $this->belongsTo('App\User', 'employee_id', 'id');
    }
}
