<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeDetail extends Model
{
    protected $table = 'employee_details';
    protected $fillable = ['employee_id', 'house_id', 'joindate','arrears'];

    public function employeeuser()
    {
        return $this->belongsTo('App\User', 'employee_id', 'id');
    }

    public function house()
    {
        return $this->belongsTo(House::class, 'house_id', 'id');
    }
}
