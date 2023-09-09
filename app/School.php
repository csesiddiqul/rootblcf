<?php

namespace App;

use App\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class School extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'schools';
    protected $fillable = [
        'name', 'short_name', 'about', 'medium', 'code', 'theme', 'activeTill', 'country_id', 'secretKey', 'reseller_id', 'branch_per', 'sms_count'
    ];

    public function scopeCode($query, int $code)
    {
        return $query->where('code', $code);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function reseller()
    {
        return $this->belongsTo(Reseller::class, 'reseller_id', 'id');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function breaking_news()
    {
        return $this->hasMany(BreakingNews::class);
    }

    public function attendance()
    {
        return $this->hasMany('App\Attendance');
    }

    public function courseAttendance()
    {
        return $this->hasMany('App\CourseAttendance');
    }

    public function departments()
    {
        return $this->hasMany('App\Department');
    }

    public function gradesystems()
    {
        return $this->hasMany('App\Gradesystem');
    }

    public function admission()
    {
        return $this->hasMany('App\Admission');
    }

    public function setting()
    {
        return $this->hasOne('App\Setting', 'school_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id');
    }

    public function school_payment()
    {
        return $this->hasMany(SchoolPayment::class, 'school_id', 'id');
    }

    public function course_config()
    {
        return $this->hasMany(CourseConfig::class, 'school_id', 'id');
    }

    public function transfer_certificate()
    {
        return $this->hasMany(TransferCertificate::class, 'school_id', 'id');
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function session()
    {
        return $this->hasMany(School::class, 'school_id', 'id');
    }

    public function grade()
    {
        return $this->hasMany(Grade::class, 'school_id', 'id');
    }

    public function promotionHistory()
    {
        return $this->hasMany('App\PromotionHistory', 'school_id', 'id');
    }

    public function letsEncript()
    {
        return $this->hasOne('App\LetsEncript', 'school_id', 'id');
    }

    public function account_sector()
    {
        return $this->hasMany('App\AccountSector', 'school_id', 'id');
    }

    public function financial_year()
    {
        return $this->hasMany('App\FinancialYear', 'school_id', 'id');
    }

    public function account_report()
    {
        return $this->hasMany('App\AccountReport', 'school_id', 'id');
    }

    public function payroll()
    {
        return $this->hasMany('App\EmployeePayroll', 'school_id', 'id');
    }

    public function expense()
    {
        return $this->hasMany(Expense::class, 'school_id', 'id');
    }

    public function createNew($data)
    {
        $about = $data['about'] ?? $data['name'] . ' Established in ' . $data['established'];
        $school = new self();
        $school->name = filter_var($data['name'], FILTER_SANITIZE_STRING);
        $school->short_name = getShortName($data['name']);
        $school->established = filter_var($data['established'], FILTER_SANITIZE_STRING);
        $school->about = filter_var($about, FILTER_SANITIZE_STRING);
        if (isset($data['medium'])) {
            $school->medium = filter_var($data['medium'], FILTER_SANITIZE_STRING);
        }
        $school->address = filter_var($data['address'], FILTER_SANITIZE_STRING);
        if (isset($data['branch_code'])) {
            $school->branch_code = filter_var($data['branch_code'], FILTER_SANITIZE_STRING);
        }
        $school->country_id = $data['country_id'];
        if (isset($data['state_id'])) {
            $school->state_id = $data['state_id'];
        }
        if (isset($data['district_id'])) {
            $school->district_id = $data['district_id'];
        }
        if (isset($data['city'])) {
            $school->city = $data['city'];
        }
        if (isset($data['agentcode'])) {
            $school->agentcode = $data['agentcode'];
        }
        if (isset($data['activeTill'])) {
            $school->activeTill = $data['activeTill'];
        }
        if (isset($data['perStudent'])) {
            $school->perStudent = $data['perStudent'];
        }
        $school->parent_id = Auth::guest() ? '0' : Auth::user()->school_id;
        $school->code = generateSchoolCode();
        $school->theme = academy_theme();
        $school->save();
        return $school;
    }

    public function checkActiveDate()
    {
        $schools = self::where('code', '!=', defaultSchoolCode())->status()->where('parent_id', 0)->get();
        DB::transaction(function () use ($schools) {
            foreach ($schools as $school) {
                if (now()->gt($school->activeTill)) {
                    $school->status = 3;
                    $school->save();
                }
            }
        });
    }

}
