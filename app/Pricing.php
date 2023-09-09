<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    protected $fillable = ["price_type", "code", "title", "price", "country", "details", "subsMonth", "perStudent", "status"];
}
