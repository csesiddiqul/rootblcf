<?php

namespace App;

use App\Model;

class Notice extends Model
{
    /**
     * Get the school record associated with the user.
     */
    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function breaking_news()
    {
        return $this->hasMany(BreakingNews::class);
    }
}
