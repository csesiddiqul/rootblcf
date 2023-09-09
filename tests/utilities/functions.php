<?php

use App\Degree;
use App\Gradesystem;
use App\Payment;
use App\Section;
use App\Myclass;
use App\School;
use App\User;
use App\Country;
use App\Setting;
use App\Session;
use App\CourseGroup;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Stichoza\GoogleTranslate\GoogleTranslate;

function database_connection()
{
    if (demo_school()) {
        $name = 'mysql2';
    } else {
        $name = 'mysql';
    }
    return $name;
}

include_once 'convert_number.php';
include_once 'image.php';
include_once 'ajax.php';
include_once 'sms.php';
include_once 'sms_list.php';
include_once 'sslcommerz.php';

function p($data = null)
{
    echo '<pre>';
    print_r($data);
    echo '<pre>';
}

function translate()
{
    $tr = new GoogleTranslate();
    return $tr;
}

function localLang()
{
    return App::getLocale();
}

function stripe_secretKey()
{
    return env('STRIPE_SECRET', 'pk_test_bgKhikYjq198nK7ANVChDmOV00z23WJUBV');
}

function stripe_apiKey()
{
    return env('STRIPE_KEY', 'sk_test_tcG2AGWhsacVy8b0oYCf6ypK00nKORleO2');
}

function db_connection()
{
    if (demo_school()) {
        $connection = 'mysql2';
    } else {
        $connection = 'mysql';
    }
    return $connection;
}

function DBConnection()
{
    return DB::connection(db_connection());
}

function transMsg($message, $detect = false, $trans = false)
{
    $lang = session('localLang') ?? localLang();
    if (empty($lang))
        $lang = 'en';
    if ($lang == 'en' && $detect == false) {
        return $message;
    }
    try {
        if ($trans) {
            if (\Lang::has($message)) {
                return trans($message, [], $lang);
            } else {
                if ($detect) {
                    $message = translate()->setSource()->setTarget($lang)->translate($message);
                } else {
                    $message = translate()->setSource('en')->setTarget($lang)->translate($message);
                }
                return $message;
            }
        } else {
            return trans($message, [], $lang);
        }

    } catch (Exception $exception) {
        return trans($message, [], $lang);
    }
}

function transMsgOnline($message, $trans = 'en', $detect = 'en')
{
    try {
        if ($detect)
            $message = translate()->setSource($detect)->setTarget($trans)->translate($message);
        else
            $message = translate()->setSource()->setTarget($trans)->translate($message);
        return $message;
    } catch (Exception $exception) {
        return $message;
    }
}

function defaultSchoolCode()
{
    $school = School::find(14);
    return $school->code ?? '21224907';
}

function faAcademy()
{
    $school = School::find(1);
    return $school;
}

function create($class, $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}

function make($class, $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}

function academy_theme()
{
    return 'flatly';
}

function btnClass()
{
    return 'btn foqas-btn btn-block btn-sm';
}
function btnClassCancel()
{
    return 'btn btn-default btn-block btn-sm';
}

function renderSlug($string, $model = false)
{
    $slug = Str::slug($string);
    $checkSlug = $slug;
    if ($model) {
        $i = 1;
        $model = 'App\\' . $model;
        reCheck:
        if ($model::bySchool(\school('id'))->slug($checkSlug)->exists()) {
            $checkSlug = $slug . '-' . $i;
            $i++;
            goto reCheck;
        }
    }
    return $checkSlug;
}

function renderTransaction()
{
    $old_payment = Payment::bySchool(\school('id'))->orderByDesc('created_at')->first();
    reCheck:
    if ($old_payment) {
        $transaction_id = substr($old_payment->reciept_number, 7);
        $transaction_id = str_pad($transaction_id + 1, 5, '0', STR_PAD_LEFT);
        $transaction_id = date('Ym') . '-' . $transaction_id;
    } else {
        $transaction_id = date('Ym') . '-00001';
    }
    if (Payment::bySchool(\school('id'))->where('reciept_number', $transaction_id)->exists()) {
        $transaction_id++;
        goto reCheck;
    }
    return $transaction_id;
}

function renderTransactionMEM()
{
    $old_payment = \App\Membership::orderByDesc('created_at')->first();
    reCheck:
    if ($old_payment) {
        $transaction_id = substr($old_payment->member_reciept_number, 7);
        $transaction_id = str_pad($transaction_id + 1, 5, '0', STR_PAD_LEFT);
        $transaction_id = date('Ym') . 'A' . $transaction_id;
    } else {
        $transaction_id = date('Ym') . 'A00001';
    }

    return $transaction_id;
}

function getShortName($string)
{
    if (utf8_decode($string))
        $string = transMsgOnline($string, 'en');
    $words = explode(" ", ucwords($string));
    $acronym = "";
    foreach ($words as $w) {
        $acronym .= $w[0];
    }
    return $acronym;
}

function foqas_setting($field)
{
    if (empty($field)) {
        return false;
    }
    $unpublished_msg = transMsg('Sorry! We are currently doing site maintenance!');
    $school_id = \auth()->user()->school_id ?? \school('id');
    if (\Cache::get('foqas_setting-' . $school_id)) {
        $setting = \Cache::get('foqas_setting-' . $school_id);
    } else {
        $setting = Setting::bySchool($school_id)->first();
        \Cache::remember('foqas_setting-' . $school_id, 1440 * 30, function () use ($setting) {
            return $setting;
        });
    }
//    $setting = Setting::bySchool($school_id)->first();

    try {
        if ($field == 'unpublished_msg')
            return empty($setting->$field) ? $unpublished_msg : $setting->$field;
        return $setting->$field;
    } catch (Exception $exception) {
        if ($field == 'unpublished_msg')
            return $unpublished_msg;
        return $field;
    }
}

function reseller()
{
    $school = School::find(\school('id'));
    if ($school) {
        return $school->reseller;
    }
    return '';
}

function useragentMobile()
{
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4)))
        return true;
    else
        return false;
}

function currentCountry($code)
{
    $country = Country::find(school('country_id'));
    if ($country) {
        if ($country->code == $code)
            return true;
    }
    return false;
}

function getSectionByClass($class_id)
{
    if ($class_id) {
        $sections = Section::whereClass_id($class_id)->get();
        return $sections;
    }
    return array();
}

function getSectionAndClassPluck()
{
    $classes = Myclass::query()->bySchool(school('id'))->pluck('id')->toArray();
    $sections = Section::query()
        ->join('classes', 'classes.id', 'sections.class_id')
        ->whereIn('class_id', $classes)->where('section_number', 'not like', 'Admission')->where('sections.status', true)
        ->selectRaw('sections.id, CONCAT(classes.name, " - ",section_number) as name,classes.class_number')->orderByRaw('CONVERT(classes.class_number, SIGNED) asc')->pluck('name', 'id');
    return $sections;
}

function levelofEducation($value = null)
{
    $data = array('1' => transMsg('Secondary'), '2' => transMsg('Higher Secondary'), '3' => transMsg('Diploma'), '4' => transMsg('Bachelor/Honors'), '5' => transMsg('Masters'), '6' => transMsg('PhD (Doctor of Philosophy)'));
    if (empty($value)) {
        return $data;
    } elseif (empty($data[$value])) {
        return 'N/A';
    } else {
        return $data[$value];
    }
}

function getClass($id, $data)
{
    $class = Myclass::bySchool(school('id'))->find($id);
    if (empty($class)) {
        return 'N/A';
    } else {
        if ($class->$data)
            return $class->$data;
        else
            return 'N/A';
    }
}

function getSessionById($id, $data)
{
    if (empty($id)) {
        return 'N/A';
    }
    $session = Session::find($id);
    if (empty($session)) {
        return 'N/A';
    } else {
        if ($session->$data)
            return $session->$data;
        else
            return 'N/A';
    }
}

function courseGroupById($id, $data)
{
    $coursegroup = CourseGroup::find($id);
    if (empty($coursegroup)) {
        return 'N/A';
    } else {
        if ($coursegroup->$data)
            return $coursegroup->$data;
        else
            return 'N/A';
    }
}

function subjectOrCourseNameWithOutS()
{
    return school('country')->code == 'BD' ? 'Subject' : 'Course';
}

function subjectOrCourseName()
{
    return trans(school('country')->code == 'BD' ? 'Subjects' : 'Courses');
}

function courseType($value = null)
{
    $array = ['1' => transMsg('Mandatory'), '2' => transMsg('Optional'), '3' => transMsg('Continuous Assessment')];
    if (isset($array[$value])) {
        return $array[$value];
    } elseif (!empty($value)) {
        return $value;
    } else {
        return $array;
    }
}

function getClassBySection($id, $data)
{
    $class = Myclass::join('sections', 'sections.class_id', 'classes.id')->where('sections.id', $id)->select('classes.*')->first();
    if (empty($class)) {
        return '';
    } else {
        if ($class->$data)
            return $class->$data;
        else
            return '';
    }
}

function levelofDegree($value = null)
{
    $degree = Degree::where('level_of_education', $value)->pluck('exam_degree_title', 'exam_degree_title');
    if (empty($value)) {
        return array();
    } else {
        return $degree;
    }
}


function getExamDegreeTitle($id = null, $ids)
{
    if (empty($ids)) {
        $idss = '0';
    } else {
        $idss = $ids;
    }
    if ($id == 6) {
        echo Form::text('exam_degree_title[]', NULL, array('id' => 'exam_degree_title' . $ids, 'class' => 'form-control', 'placeholder' => trans('PhD Title'), 'required'));
    } else {
        $results = Degree::where('level_of_education', $id)->orderBy('exam_degree_title')->get();
        ?>
        <select onchange="otherstitle(this.value,<?= $idss; ?>)" name="exam_degree_title[]"
                id="exam_degree_title<?= $ids; ?>" class="form-control" required>
            <option value="" selected disabled>Select</option>
            <?php foreach ($results as $result) { ?>
                <option
                        value="<?php echo trim($result->exam_degree_title) ?>"><?php echo transMsg($result->exam_degree_title) ?></option>
            <?php } ?>
        </select>
    <?php }
}

function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
{
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    if (serverIsLocal()) {
        $ip = '103.220.204.36';
        //$ip = '198.7.59.119'; //US
        //$ip = '118.200.236.168'; //SG
    }
    $purpose = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city" => @$ipdat->geoplugin_city,
                        "state" => @$ipdat->geoplugin_regionName,
                        "country" => @$ipdat->geoplugin_countryName,
                        "country_code" => @$ipdat->geoplugin_countryCode,
                        "continent" => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode,
                        "ip" => $ip
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}


function gender($value = null, $get = false)
{
    $gender = array('1' => transMsg('Male'), '2' => transMsg('Female'), '3' => transMsg('Others'));
    if ($get) {
        if (empty($value)) {
            return 'N/A';
        } elseif (empty($gender[$value])) {
            return 'N/A';
        } else {
            return $gender[$value];
        }
    } else {
        return $gender;
    }
}

function religon($value = null, $get = false)
{
    $religon = array('1' => transMsg('Islam'), '2' => transMsg('Hindu'), '3' => transMsg('Buddha'), '4' => transMsg('Christian'), '5' => transMsg('N/A'));
    if (empty($value) && $get == false) {
        return $religon;
    } elseif (empty($religon[$value])) {
        return 'N/A';
    } elseif (empty($value) && $get) {
        return 'N/A';
    } else {
        return $religon[$value];
    }
}

function role_title($value = null)
{
    $role_title = array('principal' => transMsg('Principal'), 'staff' => transMsg('Staff'), 'admin' => transMsg('Admin'));
    if (empty($value)) {
        return $role_title;
    } elseif (empty($role_title[$value])) {
        return $value;
    } else {
        return $role_title[$value];
    }
}

function getRoleTitle($value = null)
{
    if (empty($value)) {
        return 'N/A';
    }
    $role_title = array('Principal' => transMsg('Principal'), 'Staff' => transMsg('Staff'), 'Admin' => transMsg('Admin'), 'Teacher' => transMsg('Teacher'), 'Accountant' => transMsg('Accountant'), 'Librarian' => transMsg('Librarian'));
    if (empty($role_title[$value])) {
        return $value;
    } else {
        return $role_title[$value];
    }
}

function role($value = null)
{
    $role = array('admin' => transMsg('Admin'), 'accountant' => transMsg('Accountant'), 'librarian' => transMsg('Librarian'), 'staff' => transMsg('Staff'));
    if (empty($value)) {
        return $role;
    } elseif (empty($role[$value])) {
        return 'N/A';
    } else {
        return $role[$value];
    }
}

function bloodgroup($value = null, $get = false)
{
    $bloodgroup = array('1' => transMsg('A+'), '2' => transMsg('A-'), '3' => transMsg('B+'), '4' => transMsg('B-'), '5' => transMsg('AB+'), '6' => transMsg('AB-'), '7' => transMsg('O+'), '8' => transMsg('O-'), '9' => 'N/A');
    if ($get) {
        if (empty($bloodgroup[$value])) {
            return 'N/A';
        } elseif (empty($value)) {
            return 'N/A';
        } else {
            if (is_numeric($value))
                return $bloodgroup[$value];
            else
                return $value;
        }
    } else {
        return $bloodgroup;
    }
}

function residentstatus($value = null, $get = false)
{
    $citizen = transMsg('SC');
    $permanent = transMsg('PR');
    $foreigner = transMsg('FR');
    $temporary = transMsg('TI');
    $other = transMsg('Other');
    $residentstatus = array('1' => $citizen, '2' => $permanent, '3' => $foreigner, '4' => $temporary, '5' => $other);
    if (empty($value) && $get == false) {
        return $residentstatus;
    } elseif (empty($residentstatus[$value])) {
        return 'N/A';
    } elseif (empty($value) && $get) {
        return 'N/A';
    } else {
        return $residentstatus[$value];
    }
}

function status($value = null)
{
    $status = array('1' => transMsg('Active'), '2' => transMsg('Inactive'));
    if (empty($value)) {
        return $status;
    } elseif (empty($status[$value])) {
        return $status;
    } else {
        return $status[$value];
    }
}

function pricingfor($value = null)
{
    $pricing = array('1' => transMsg('Installation'), '2' => transMsg('Service Charge'), '3' => transMsg('Subscription'));
    if (empty($value)) {
        return $pricing;
    } elseif (empty($pricing[$value])) {
        return $pricing;
    } else {
        return $pricing[$value];
    }
}

function subscription($value = null)
{
    $month = array('1' => transMsg('1 Month'), '2' => transMsg('2 Months'), '3' => transMsg('3 Months'), '4' => transMsg('4 Months'), '5' => transMsg('5 Months'), '6' => transMsg('6 Months'), '7' => transMsg('7 Months'), '8' => transMsg('8 Months'), '9' => transMsg('9 Months'), '10' => transMsg('10 Months'), '11' => transMsg('11 Months'), '12' => transMsg('12 Months'));
    if (empty($value)) {
        return $month;
    } elseif (empty($month[$value])) {
        return $month;
    } else {
        return $month[$value];
    }
}

function pricingStatus($value = null)
{
    $status = array('4' => transMsg('Default'), '1' => transMsg('Active'), '2' => transMsg('Inactive'), '0' => transMsg('Pending'));
    if (empty($value)) {
        return $status;
    } elseif (empty($status[$value])) {
        return $status;
    } else {
        return $status[$value];
    }
}


function marritalstatus($value = null)
{
    $marritalstatus = array('1' => transMsg('Married'), '2' => transMsg('Unmarried'));
    if (empty($value)) {
        return $marritalstatus;
    } elseif (empty($marritalstatus[$value])) {
        return $marritalstatus;
    } else {
        return $marritalstatus[$value];
    }
}


function examReportType($value = null)
{
    $local = App::getLocale();
    if ($local == 'bn')
        $array = ['1' => 'মেধা তালিকা', '2' => 'ব্যর্থ তালিকা', '3' => 'মেধা তালিকা একত্রিত করুন', '4' => 'ট্যাবুলেশন শীট'];
    else
        $array = ['1' => 'Merit List', '2' => 'Fail List', '3' => 'Combine Merit List', '4' => 'Tabulation Sheet'];
    if (empty($value)) {
        return $array;
    } elseif (empty($array[$value])) {
        return $array;
    } else {
        return $array[$value];
    }
}

function designation($value = null, $get = false)
{

    $designation = \App\Designation::bySchool(school('id'))->status()->pluck('name', 'id')->map(function ($value) {
        return transMsg($value);
    });
    if (empty($value) && $get == false) {
        return $designation;
    } elseif (empty($designation[$value])) {
        return 'N/A';
    } elseif (empty($value) && $get) {
        return 'N/A';
    } else {
        return $designation[$value];
    }
}

function get_department($id)
{
    return \App\Department::query()->findOrFail($id);
}


function admissionRoll()
{
    $session = \App\PreAdmission::find(preAdmissionId());
    $admissionROll = \App\Admission::where('school_id', \school('id'))->orderBy('roll', 'DESC')->first();
    if (empty($admissionROll)) {
        if (empty($session)) {
            $year = date('Y');
        } else {
            $year = $session->year;
        }
        $roll = $year . '101';
        return $roll;
    }
    $roll = $admissionROll->roll;
    $roll += 1;
    return $roll;
}


function preAdmissionId()
{
    $preAdmissionId = \App\PreAdmission::bySchool(school('id'))->orderBy('created_at', 'DESC')->whereStatus(1)->first();
    if (!empty($preAdmissionId)) {
        return $preAdmissionId->id;
    }
    return null;
}

function currentSession()
{
    $session = \App\Session::bySchool(school('id'))->orderBy('created_at', 'DESC')->whereStatus(1)->first();
    if (!empty($session)) {
        return $session;
    }
    return null;
}

function admissionstatus($value = null)
{
    $admissionstatus = array('1' => transMsg('Pending'), '2' => transMsg('Approve'), '3' => transMsg('Reject'), '4' => transMsg('Paid'), '5' => transMsg('Unpaid'));
    if (empty($value)) {
        return $admissionstatus;
    } elseif (empty($admissionstatus[$value])) {
        return $admissionstatus;
    } else {
        return $admissionstatus[$value];
    }
}

function getUserByCode($code)
{
    return (new User())->getUser(false, $code, false);
}

function getAgentByCode($code)
{
    return User::studentCode($code)->active()->first();
}

function schoolSession($status, $pluck = false)
{
    $school_id = Auth::guest() ? school('id') : Auth::user()->school_id;
    $session = \App\Session::bySchool($school_id)->orderBy('schoolyear');
    if ($status) {
        $session = $session->whereStatus($status);
    }
    if ($pluck) {
        $session = $session->pluck('schoolyear', 'id');
    } else {
        $session = $session->get();
    }
    return $session;

}

function schoolCourseGroup($status = false, $pluck = false)
{
    $school_id = Auth::guest() ? school('id') : Auth::user()->school_id;
    $coursegroup = \App\CourseGroup::bySchool($school_id);
    if ($status) {
        $coursegroup = $coursegroup->whereStatus($status);
    }
    if ($pluck) {
        $coursegroup = $coursegroup->pluck('name', 'id');
    } else {
        $coursegroup = $coursegroup->get();
    }
    return $coursegroup;

}

function serverIsLocal()
{
    try {
        if (isset($_SERVER['SERVER_NAME']) && $_SERVER['SERVER_NAME'] == '127.0.0.1' || $_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '192.168.0.109' || $_SERVER['SERVER_PORT'] == '8001' || $_SERVER['SERVER_PORT'] == '8000') {
            return true;
        }
        return false;
    } catch (Exception $exception) {
        return false;
    }
}

function fileUploadFolder()
{
    if (Auth::guest()) {
        $code = session('current_school')['code'] ?? defaultSchoolCode();
        $school = School::code($code)->first();
    } else {
        $school = Auth::user()->school;
    }
    if ($school->parent_id == 0) {
        $folder = 'FA' . $school->code . 'S/FA' . $school->code . 'H/' . date("Y");
    } else {
        $folder = 'FA' . $school->parent->code . 'S/FA' . $school->code . 'B/' . date("Y");
    }
    return $folder;
}

function access_school()
{
    if (serverIsLocal()) {
        session()->put('cname_code', defaultSchoolCode());
    } else {
        $mainD = explode('.', $_SERVER['SERVER_NAME']);
        if (isset($mainD[0])) {
            $code = trim($mainD[0]);
            if ($code == 'academy') {
                session()->put('cname_demo_mode', true);
                session()->put('cname_code', '1723047878');
                goto define_goto;
            }
        }
        if (isset($_SERVER['SERVER_NAME'])) {
        // $cname = dns_get_record($_SERVER['SERVER_NAME'], DNS_CNAME);
            if (isset($cname[0]['target'])) {
                $cname_target = $cname[0]['target'];
                $target = explode('.', $cname_target);
                $code = trim($target[0]);
            }
            if (isset($code) && is_numeric($code)) {
                session()->put('cname_code', $code);
            } else {
                $mainD = explode('.', $_SERVER['SERVER_NAME']);
                if (isset($mainD[0])) {
                    $code = trim($mainD[0]);
                    if (isset($code) && is_numeric($code)) {
                        session()->put('cname_code', $code);
                    } else {
                        if ($code == 'academy')
                            session()->put('cname_demo_mode', true);
                        session()->put('cname_code', defaultSchoolCode());
                    }
                } else {
                    session()->put('cname_code', defaultSchoolCode());
                }
            }
        } else {
            $code = '';
            session()->put('cname_code', defaultSchoolCode());
        }
    }
    define_goto:
    $oldSchool = session('current_school');
    $newSchool = false;
    if ($oldSchool) {
        if ($oldSchool['code'] != $code)
            $newSchool = true;
    } else {
        $newSchool = true;
    }
    if ($newSchool) {
        $school = School::code(session()->get('cname_code'))->first();
        if (empty($school)) {
            $school = School::code(defaultSchoolCode())->first();
        }
        session()->put('current_school', $school);
    }
}

function school($data)
{
    $data = trim($data);
    if (isset(session('current_school')[$data])) {
        return session('current_school')[$data];
    }
    $code = session('current_school')['code'] ?? defaultSchoolCode();
    $school = School::code($code)->first();
    if (!empty($school)) {
        session()->put('current_school', $school);
        if ($school[$data]) {
            return $school[$data];
        }
    }
    return $data;
}

function generateSchoolCode()
{
    reCheck:
    $code = date("y") . substr(number_format(time() * mt_rand(), 0, '', ''), 0, 6);
    if (School::code($code)->exists()) {
        goto reCheck;
    }
    return $code;
}

function generateStudentCode($school_id, $array = false, $student = false)
{
    $user = User::bySchool($school_id)->latest();
    if ($student)
        $user = $user->student()->first();
    else
        $user = $user->first();
    reCheck:
    if (empty($user)) {
        if (isset($code)) {
            $code++;
            goto newCodeIncrement;
        }
        $setting = Setting::bySchool($school_id)->first();
        if (isset($setting->eiin) && is_numeric($setting->eiin)) {
            $code = $setting->eiin . '101';
        } else {
            $code = date("y") . substr(number_format(time() * mt_rand(), 0, '', ''), 0, 6);
        }
    } else {
        $code = $user->student_code++;
    }
    newCodeIncrement:
    if (User::bySchool($school_id)->whereStudent_code($code)->exists()) {
        goto reCheck;
    }
    if ($array) {
        $session_student_code = session('session_student_code') ?? [];
        sessionCheck:
        if (in_array($code, $session_student_code)) {
            $code++;
            goto sessionCheck;
        }
        array_push($session_student_code, $code);
        session()->put('session_student_code', $session_student_code);
    }
    return $code;
}

function generateTransID($type = false)
{
    reCheck:
    $trans_id = 'txn_' . date('y') . 'FA' . Str::random(20);
    if ($type == 'student') {
        if (\App\Payment::whereTrans_id($trans_id)->exists()) {
            goto reCheck;
        }
    } else {
        if (\App\SchoolPayment::whereTrans_id($trans_id)->exists()) {
            goto reCheck;
        }
    }
    return $trans_id;
}

function getDatesByMonthYear($month, $year)
{
    $list = array();
    for ($d = 1; $d <= 31; $d++) {
        $time = mktime(12, 0, 0, $month, $d, $year);
        if (date('m', $time) == $month)
            $list[] = date('Y-m-d', $time);
    }
    return $list;
}

function age_calculation($date)
{
    $date = date('Y-m-d', strtotime($date));
    $diff = abs(strtotime(now()) - strtotime($date));
    $years = floor($diff / (365 * 60 * 60 * 24));
    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    return $years . " years, " . $months . " months, " . $days . " days";
}

function branchPluck($school_id)
{
    $branch = School::whereParent_id($school_id)->whereStatus('1')->orderBy('name')->pluck('name', 'id');
    if (count($branch) > 0) {
        return $branch;
    }
    return array();
}

function pluckVersion($data = null)
{
    $version = array('bangla' => transMsg('Bangla'), 'english' => transMsg('English'), 'hindi' => transMsg('Hindi'), 'spanish' => transMsg('Spanish'), 'chinese' => transMsg('Chinese'), 'arabic' => transMsg('Arabic'));
    if (count($version) > 0) {
        if (!empty($data) && $version[$data]) {
            return $version[$data];
        }
        return $version;
    }
    return array();
}

function getDivisionName($id)
{
    $result = \App\Division::find($id);
    $localLang = session('localLang') ?? 'en';
    if (!empty($result)) {
        return ($localLang == 'bn' ? $result->namebn : $result->name);
    }
    return $id;
}

function getCountryName($id, $name = true)
{
    $result = \App\Country::find($id);
    if (!empty($result)) {
        if ($name) {
            return $result->name;
        }
        return $result;
    }
    return $id;
}

function getCountryByCode($code)
{
    $result = \App\Country::whereCode($code)->first();
    return $result;
}

function getCountryByName($name)
{
    $result = \App\Country::where('name', 'LIKE', $name)->first();
    return $result;
}

function getStateName($id)
{
    $result = \App\State::find($id);
    if (!empty($result)) {
        return $result->name;
    }
    return $id;
}

function getDistrictName($id)
{
    $result = \App\District::find($id);
    $localLang = session('localLang') ?? 'en';
    if (!empty($result)) {
        return ($localLang == 'bn' ? $result->namebn : $result->name);
    }
    return $id;
}

function getDivisionByDistrict($id)
{
    $result = \App\District::find($id);
    if (!empty($result)) {
        $division = \App\Division::find($result->division_id);
        return $division;
    }
    return $id;
}

function getThanaName($id)
{
    $result = \App\Thana::find($id);
    $localLang = session('localLang') ?? 'en';
    if (!empty($result)) {
        return ($localLang == 'bn' ? $result->namebn : $result->name);
    }
    return $id;
}

function admissionClass()
{
    if (Auth::check())
        $school_id = Auth::user()->school->id;
    else
        $school_id = school('id');
    try {
        $class = Section::join('classes', 'classes.id', 'sections.class_id')
            ->select('sections.id', 'classes.name')
            ->where([['sections.section_number', 'LIKE', 'admission'], ['classes.school_id', $school_id], ['sections.status', 1]])
            ->orderBy('sections.section_number', 'ASC')->orderByRaw('CONVERT(classes.class_number, SIGNED) asc')->pluck('name', 'id');
    } catch (Exception $exception) {
        $class = array();
    }
    return $class;
}


function remove_http($url)
{
    $url = trim($url, '/');

    // If not have http:// or https:// then prepend it
    if (!preg_match('#^http(s)?://#', $url)) {
        $url = 'http://' . $url;
    }
    $urlParts = parse_url($url);
    // Remove www.
    //$domain_name = preg_replace('/^www\./', '', $urlParts['host']);

    return $urlParts['host'];
}


function studentPhoto($value = null)
{
    $studentPhoto = array('1' => transMsg('Right side of heading'), '2' => transMsg('Bottom of right logo'));
    if (empty($value)) {
        return $studentPhoto;
    } elseif (empty($studentPhoto[$value])) {
        return $studentPhoto;
    } else {
        return $studentPhoto[$value];
    }
}

function infoPosition($value = null)
{
    $infoPosition = array('1' => transMsg('Horizontal'), '2' => transMsg('Vertical'));
    if (empty($value)) {
        return $infoPosition;
    } elseif (empty($infoPosition[$value])) {
        return $infoPosition;
    } else {
        return $infoPosition[$value];
    }
}

function templateType($value = null)
{
    $templateType = array('1' => transMsg('Admission Template'), '2' => transMsg('Examination Template'), '3' => transMsg('Marksheet Template'));
    if (empty($value)) {
        return $templateType;
    } elseif (empty($templateType[$value])) {
        return $templateType;
    } else {
        return $templateType[$value];
    }
}


function nationalityArray($key = false)
{
    $arr = array('Afghan', 'Albanian', 'Algerian', 'American', 'Andorran', 'Angolan', 'Antiguans', 'Argentinean', 'Armenian', 'Australian', 'Austrian', 'Azerbaijani', 'Bahamian', 'Bahraini', 'Bangladeshi', 'Barbadian', 'Barbudans', 'Batswana', 'Belarusian', 'Belgian', 'Belizean', 'Beninese', 'Bhutanese', 'Bolivian', 'Bosnian', 'Brazilian', 'British', 'Bruneian', 'Bulgarian', 'Burkinabe', 'Burmese', 'Burundian', 'Cambodian', 'Cameroonian', 'Canadian', 'Cape Verdean', 'Central African', 'Chadian', 'Chilean', 'Chinese', 'Chinese', 'Comoran', 'Congolese', 'Costa Rican', 'Croatian', 'Cuban', 'Cypriot', 'Czech', 'Danish', 'Djibouti', 'Dominican', 'Dutch', 'East Timorese', 'Ecuadorean', 'Egyptian', 'Emirian', 'Equatorial Guinean', 'Eritrean', 'Estonian', 'Ethiopian', 'Fijian', 'Filipino', 'Finnish', 'French', 'Gabonese', 'Gambian', 'Georgian', 'German', 'Ghanaian', 'Greek', 'Grenadian', 'Guatemalan', 'Guinea-Bissauan', 'Guinean', 'Guyanese', 'Haitian', 'Herzegovinian', 'Honduran', 'Hungarian', 'Icelander', 'Indian', 'Indonesian', 'Iranian', 'Iraqi', 'Irish', 'Israeli', 'Italian', 'Ivorian', 'Jamaican', 'Japanese', 'Jordanian', 'Kazakhstani', 'Kenyan', 'Kittian and Nevisian', 'Kuwaiti', 'Kyrgyz', 'Laotian', 'Latvian', 'Lebanese', 'Liberian', 'Libyan', 'Liechtensteiner', 'Lithuanian', 'Luxembourger', 'Macedonian', 'Malagasy', 'Malawian', 'Malaysian', 'Maldivan', 'Malian', 'Maltese', 'Marshallese', 'Mauritanian', 'Mauritian', 'Mexican', 'Micronesian', 'Moldovan', 'Monacan', 'Mongolian', 'Moroccan', 'Mosotho', 'Motswana', 'Mozambican', 'Namibian', 'Nauruan', 'Nepalese', 'Netherlander', 'New Zealander', 'Ni-Vanuatu', 'Nicaraguan', 'Nigerian', 'Nigerien', 'North Korean', 'Northern Irish', 'Norwegian', 'Omani', 'Pakistani', 'Palauan', 'Panamanian', 'Papua New Guinean', 'Paraguayan', 'Peruvian', 'Polish', 'Portuguese', 'Qatari', 'Romanian', 'Russian', 'Rwandan', 'Saint Lucian', 'Salvadoran', 'Samoan', 'San Marinese', 'Sao Tomean', 'Saudi', 'Scottish', 'Senegalese', 'Serbian', 'Seychellois', 'Sierra Leonean', 'Singaporean', 'Slovakian', 'Slovenian', 'Solomon Islander', 'Somali', 'South African', 'South Korean', 'Spanish', 'Sri Lankan', 'Sudanese', 'Surinamer', 'Swazi', 'Swedish', 'Swiss', 'Syrian', 'Taiwanese', 'Tajik', 'Tanzanian', 'Thai', 'Togolese', 'Tongan', 'Trinidadian or Tobagonian', 'Tunisian', 'Turkish', 'Tuvaluan', 'Ugandan', 'Ukrainian', 'Uruguayan', 'Uzbekistani', 'Venezuelan', 'Vietnamese', 'Welsh', 'Yemenite', 'Zambian', 'Zimbabwean');
    if ($key)
        if (isset($arr[$key]))
            return $arr[$key];
        else
            return 'N/A';
    return $arr;
}

function nationalityPluck()
{
    $lang = session('localLang') ?? localLang();
    $array = nationalityArray();
    if ($lang == 'en') {
        return $array;
    } else {
        foreach ($array as $item) {
            $newarray [] = transMsg($item);
        }
        return $newarray;
    }
}

function exchangeRate($currency = 'BDT')
{
    $req_url = 'https://v6.exchangerate-api.com/v6/9d3943daa84646c2efa37724/latest/USD';
    $response_json = file_get_contents($req_url);
// Continuing if we got a result
    if (false !== $response_json) {
        // Try/catch for json_decode operation
        try {
            // Decoding
            $response = json_decode($response_json);
            // Check for success
            if ('success' === trim($response->result)) {
                // YOUR APPLICATION CODE HERE, e.g.
                $base_price = 1; // Your price in USD
                $current_price = round(($base_price * $response->conversion_rates->$currency), 2);
                return $current_price;
            }
        } catch (Exception $e) {
            // Handle JSON parse error...
        }
    }
    return '84.50';
}

function convert_ordinary($number)
{
    $ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
    if (($number % 100) >= 11 && ($number % 100) <= 13)
        $abbreviation = $number . 'th';
    else
        $abbreviation = $number . $ends[$number % 10];
    return $abbreviation;
}

function enTobn($int)
{
    $bangNumber = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
    $engNumber = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');
    $converted = str_replace($bangNumber, $engNumber, $int);
    return $converted;
}

function enTobnLang($int)
{
    if (localLang() == 'bn') {
        $bangNumber = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
        $engNumber = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');
        $converted = str_replace($bangNumber, $engNumber, $int);
        return $converted;
    }
    return $int;
}

//this function converts string from UTC time zone to current user timezone
function convertTimeToUSERzone($str, $userTimezone, $format = 'Y-m-d h:i a')
{
    if (empty($str)) {
        return '';
    }
    return \Carbon\Carbon::createFromTimestamp(strtotime($str))
        ->timezone($userTimezone)->format($format);
}

function total_student_current_school()
{
    if (isset(currentSession()->id)) {
        $students = User::join('student_infos', 'users.id', '=', 'student_infos.student_id')
            ->where('student_infos.session', currentSession()->id)->bySchool(\school('id'))
            ->active()->student()->count();
        return $students;
    }
    return 0;
}

function setEnv($key, $value)
{
    $path = base_path('.env');
    if (file_exists($path)) {
        file_put_contents($path, str_replace(
            $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
        ));
    }
}

function demo_school()
{
    return config('app.env') == 'production' && session('cname_demo_mode') && $_SERVER['SERVER_NAME'] == 'foqasmail.com';
}

function ssl_bd_amount($amount)
{
    $total = $amount / (1 - 0.025);
    $amount = round($total, 2);
    return $amount;
}

function stripe_amount($amount)
{
    $total = ($amount + 0.30) / (1 - 0.029);
    $amount = round($total, 2) * 100;
    $amount = $amount / 100;
    return $amount;
}

function branch_permission()
{
    if (school('parent_id') == 0 && school('branch_per') == 1)
        return true;

    return false;
}

function rocketCredentials($type)
{
    if ($type == 'username')
        return school('code');
    if ($type == 'password')
        return base64_encode('597143');
    return $type;
}

function admission_additional_file($value = null)
{
    $files = array('1' => transMsg('Student Photo'), '2' => transMsg('Birth Certificate'), '3' => transMsg('Transfer Certificate'), '4' => transMsg('Citizenship Certificate'), '5' => transMsg('MOE Approval for taking Bangla as Mother Tongue'));
    if (empty($value)) {
        return $files;
    } elseif (empty($files[$value])) {
        return $files;
    } else {
        return $files[$value];
    }
}

function getSchool($id, $field)
{
    $result = \App\School::find($id);
    if (!empty($result)) {
        return $result->$field;
    }
    return $id;
}

function get_combined_grade($grade_system_name)
{
    $gradeSystem = Gradesystem::bySchool(school('id'))->where('grade_system_name', $grade_system_name)->get();
    return $gradeSystem;
}

function getExamComment($student_id, $exam_id)
{
    $result = \App\ExamComment::query()->bySchool(school('id'))->where('student_id', $student_id)->where('exam_id', $exam_id)->first();
    if ($result)
        return $result->comment;
    return null;
}

function get_static_grade_system()
{
    if (\school('id') == 11)
        $array = [
            ['grade' => 'A+', 'point' => 5, 'percentage_from' => 80, 'percentage_to' => 100],
            ['grade' => 'A', 'point' => 4, 'percentage_from' => 70, 'percentage_to' => 79],
            ['grade' => 'A-', 'point' => 3.5, 'percentage_from' => 60, 'percentage_to' => 69],
            ['grade' => 'B', 'point' => 3, 'percentage_from' => 50, 'percentage_to' => 59],
            ['grade' => 'C', 'point' => 2, 'percentage_from' => 40, 'percentage_to' => 49],
            ['grade' => 'F', 'point' => 0, 'percentage_from' => 0, 'percentage_to' => 39]
        ];
    else
        $array = [
            ['grade' => 'A+', 'point' => 5, 'percentage_from' => 80, 'percentage_to' => 100],
            ['grade' => 'A', 'point' => 4, 'percentage_from' => 70, 'percentage_to' => 79],
            ['grade' => 'A-', 'point' => 3.5, 'percentage_from' => 60, 'percentage_to' => 69],
            ['grade' => 'B', 'point' => 3, 'percentage_from' => 50, 'percentage_to' => 59],
            ['grade' => 'C', 'point' => 2, 'percentage_from' => 40, 'percentage_to' => 49],
            ['grade' => 'D', 'point' => 1, 'percentage_from' => 33, 'percentage_to' => 39],
            ['grade' => 'F', 'point' => 0, 'percentage_from' => 0, 'percentage_to' => 32]
        ];
    return $array;
}

function current_financial_year()
{
    $result = \App\FinancialYear::bySchool(\school('id'))->where('is_close', 1)->where('status', 1)->first();
    return $result;
}

function active_financial_year()
{
    $result = \App\FinancialYear::bySchool(\school('id'))->where('status', 1)->first();
    return $result;
}
