<?php

namespace App;

use App\Model;

class Content extends Model
{
    protected $fillable = ['school_id', 'menu_id', 'title', 'description', 'image'];

    public function menu()
    {
        return $this->belongsTo('App\Menu', 'menu_id');
    }
}
