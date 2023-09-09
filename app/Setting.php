<?php

namespace App;

use App\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = ['school_id','timezone'];

    public function school()
    {
        return $this->belongsTo('App\School', 'school_id', 'id');
    }

    public static function createNew($school_id)
    {
        $code = null;
        if (isset(session('step1')['nationality'])) {
            $code = getCountryByCode(session('step1')['nationality'])['code'];
        }
        $setting = new self();
        $setting->school_id = $school_id;
        $setting->email = session('step1')['email'] ?? 'info@demo.com';
        $setting->phone = '***********';
        $setting->telephone = '***********';
        $setting->timezone = ($code == 'BD' ? 'Asia/Dhaka' : 'UTC');
        $setting->language = 'en';
        $setting->eiin = session('step2')['eiin'] ?? null;
        $setting->save();
    }
}
