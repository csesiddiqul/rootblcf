<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    protected $token;

    public function __construct()
    {
        parent::__construct();
        $this->token = Str::random(40);
    }

    public function store(Request $request)
    {
        $token = $request->token;
        $deviceID = $request->deviceID;
        $attendanceID = $request->attendanceID;
        $date = $request->date;
        if ($token == null)
            return '01';
        if ($deviceID == null)
            return '02';
        if ($attendanceID == null)
            return '03';
        if ($date == null)
            return '04';
        if ($token != $this->token)
            return '05';
        return response()->json(['status' => '200', 'data' => $date]);
    }

}