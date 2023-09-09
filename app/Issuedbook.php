<?php

namespace App;

use App\Model;

class Issuedbook extends Model
{
    protected $table = 'issued_books';

    public function student()
    {
        return $this->belongsTo('App\User', 'student_code', 'student_code');
    }

    public function book()
    {
        return $this->belongsTo('App\Book');
    }
}
