<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionHistory extends Model
{
    protected $table = 'promotion_histories';
    protected $primaryKey = 'id';
    protected $fillable = ['school_id', 'student_id', 'past_section', 'present_section', 'past_session', 'present_session', 'past_roll', 'present_roll', 'past_coursegroup_id', 'present_coursegroup_id', 'school_left', 'promoted_by'];

    public function student()
    {
        return $this->belongsTo('App\User', 'student_id', 'id');
    }

    public function school()
    {
        return $this->belongsTo('App\School', 'school_id', 'id');
    }
}
