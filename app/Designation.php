<?php

namespace App;

use App\Model;

class Designation extends Model
{
    protected $table = 'designations';
    protected $fillable = ['school_id', 'name', 'status'];
}
