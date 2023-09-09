<?php

namespace App;

use App\Model;

class Committee extends Model
{
    protected $table = 'committees';
    protected $fillable = ['school_id', 'type', 'name', 'gender', 'religon', 'dob', 'place_of_birth', 'bloodgroup', 'email', 'nid', 'mobile', 'profession', 'education', 'image', 'priority', 'designation', 'marritalstatus', 'startdate', 'enddate', 'father_name', 'mother_name', 'address', 'office_address', 'status', 'nationality'];
}
