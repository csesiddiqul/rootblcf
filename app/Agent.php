<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $fillable = ['shareOf'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
