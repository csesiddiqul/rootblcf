<?php

namespace App;

use App\Model;

class TransferCertificate extends Model
{

    protected $fillable = ['school_id','student_id','user_id','remark','first_ad_class','laststudied','dues','behaviour','reason','date','date_lastclass'];

     public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
     public function student()
    {
        return $this->belongsTo('App\User', 'student_id', 'id');
    }
     public function school()
    {
        return $this->belongsTo('App\School', 'school_id', 'id');
    }
}
