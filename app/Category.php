<?php

namespace App;

use App\Model;

class Category extends Model
{
    public function studentInfo()
    {
        return $this->hasMany(StudentInfo::class, 'category_id', 'id');
    }
}
