<?php

namespace App;

use App\Model;

class BreakingNews extends Model
{
    protected $table = 'breaking_news';
    protected $fillable = ['title', 'school_id', 'notice_id', 'user_id', 'status','priority'];

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function notice()
    {
        return $this->belongsTo('App\Notice');
    }
}
