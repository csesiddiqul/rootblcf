<?php

namespace App\Http\Controllers;

use App\Country;
use App\LetsEncript;
use App\Setting;
use App\User;
use App\School;
use App\Myclass;
use App\Section;
use App\Department;
use App\TempleteDesign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class SettingController extends Controller
{
    public function index()
    {
        $school = Auth::user()->school;
        $classes = Myclass::all();
        $sections = Section::all();
        $departments = Department::bySchool(\Auth::user()->school_id)->get();
        $teachers = User::select('departments.*', 'users.*')
            ->join('departments', 'departments.id', '=', 'users.department_id')
            ->where('role', 'teacher')
            ->orderBy('name', 'ASC')
            ->where('active', 1)
            ->get();

        return view('settings.index', compact('school', 'classes', 'sections', 'departments', 'teachers'));
    }

    public function website()
    {
        // $columns = Schema::getColumnListing('settings');
        $school_id = Auth::user()->school_id;
        $sms_balance = sms_balance();
        if (school('country')->code == 'BD')
            $sms_balance = \GuzzleHttp\json_decode($sms_balance);
        else
            $sms_balance = false;
        $setting = Setting::with('school')->bySchool($school_id)->first();
        $country = Country::pluck('name', 'id');
        $letEcript = LetsEncript::bySchool($school_id)->first();
        $admi_card_template = TempleteDesign::bySchool($school_id)->where('type', 1)->pluck("name", "id");
        return view('settings.website', compact('setting', 'country', 'letEcript', 'admi_card_template', 'sms_balance'));
    }

    public function updateInfo()
    {
        $stt = 0;
        $icon = 'success';
        $msg = trans('validation.success');
        $data = request()->all();
        $type = $data['pk']; //1 = School, 2 = Setting,3 = Add Domain Lets Encript, 4=Let's Encript
        $field = $data['name'];
        $value = $data['value'] ?? '';
        $school_id = \auth()->user()->school_id;
        if ($type == 1) {
            $update = School::findOrfail(\auth()->user()->school_id);
        } elseif ($type == 3) {
            return (new LetsEncriptController())->customWeb($value);
        } elseif ($type == 4 && $value == '00100') {
            return (new LetsEncriptController())->letsEncrypt();
        } else {
            $update = Setting::where('school_id', $school_id)->first();
            if ($field == 'logo_type') {
                $value = ($value == 1 ? 1 : 2);
            }
            if ($field == 'language') {
                session()->forget('localLang');
            }
            if ($field == 'admission_additional_file') {
                if ($value == '')
                    $value = array();
                if (count($value) > 0)
                    $value = implode(',', $value);
                else
                    $value = '';
            }
        }
        if (empty($update)) {
            return response()->json([
                'stt' => $stt,
                'msg' => 'Update data not found !'
            ]);
        }
        try {
            $update->$field = filter_var($value, FILTER_SANITIZE_STRING);
            if ($update->save()) {
                $stt = 1;
            }
        } catch (\Exception $exception) {
            $msg = 'Field not found';
            $icon = 'error';
        }
        if ($type == 1) {
            session()->put('current_school', $update);
        } else {
            \Cache::forget('foqas_setting-' . $school_id);
            \Cache::remember('foqas_setting-' . $school_id, 1440 * 30, function () use ($update) {
                return $update;
            });
        }
        return response()->json([
            'stt' => $stt,
            'field' => $field,
            'value' => $value,
            'icon' => $icon,
            'msg' => transMsg($msg)
        ]);
    }

    public function secret_key(Request $request)
    {
        if ($request->ajax() && $request->isMethod('POST')) {
            $secret_key = rand(11111, 99999);
            $school = $this->school->find(auth()->user()->school_id);
            $school->secretKey = $secret_key;
            $school->save();
            session()->put('current_school', $school);
            return response()->json([
                'stt' => 200,
                'msg' => transMsg('Successfully Update'),
                'secretKey' => $school->secretKey
            ]);
        }
        return response()->json([
            'stt' => 419,
            'msg' => 'not allowed !'
        ]);

    }
}
