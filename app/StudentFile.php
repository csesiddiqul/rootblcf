<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentFile extends Model
{

    public function admission()
    {
        return $this->belongsTo('App\Admission', 'student_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo('App\User', 'student_id', 'id');
    }
}
