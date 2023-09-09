<?php

namespace App;

use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, HasApiTokens, Notifiable, Impersonate, Billable, MustVerifyEmail;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'code',/* school code*/
        'student_code', 'active', 'verified', 'school_id', 'section_id', 'address', 'about', 'phone_number', 'blood_group', 'nationality', 'gender', 'department_id', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeStudent($q)
    {
        return $q->where('role', 'student');
    }

    public function scopeAdmin($q)
    {
        return $q->where('role', 'admin');
    }

    public function scopeStudentCode($query, int $student_code)
    {
        return $query->where('student_code', $student_code);
    }

    public function scopeRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    public function section()
    {
        return $this->belongsTo('App\Section', 'section_id', 'id');
    }

    public function school()
    {
        return $this->belongsTo('App\School', 'school_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo('App\Department', 'department_id', 'id');
    }

    public function studentInfo()
    {
        return $this->hasOne('App\StudentInfo', 'student_id', 'id')->orderBy('class_roll');
    }

    public function employeeDetail()
    {
        return $this->hasOne('App\EmployeeDetail', 'employee_id', 'id');
    }

    public function employeePayroll()
    {
        return $this->hasOne('App\EmployeePayroll', 'employee_id', 'id');
    }

    /*public function teacherEducationInfo()
    {
        return $this->hasMany(TeacherEducationInfo::class, 'user_id', 'id');
    }*/

    public function sessionStudent()
    {
        return $this->studentInfo()->where('session', '=', currentSession()->id);
    }

    public function promotionHistory()
    {
        return $this->hasMany('App\PromotionHistory', 'student_id', 'id');
    }

    public function studentBoardExam()
    {
        return $this->hasMany('App\StudentBoardExam', 'student_id', 'id');
    }

    public function studentBoardExamLast()
    {
        return $this->studentBoardExam()->latest()->limit(1);
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification', 'student_id', 'id');
    }

    public function attendance()
    {
        return $this->hasMany('App\Attendance', 'student_id', 'id');
    }

    public function courseAttendanceUser()
    {
        return $this->hasMany(CourseAttendance::class, 'user_id', 'id');
    }

    public function courseAttendance()
    {
        return $this->hasMany('App\CourseAttendance', 'student_id', 'id');
    }

    public function course_config()
    {
        return $this->hasMany(CourseConfig::class, ['user_id', 'teacher_id'], 'id');
    }

    public function transfer_certificate()
    {
        return $this->hasMany(TransferCertificate::class, ['user_id', 'student_id'], 'id');
    }

    public function payment()
    {
        return $this->hasMany(Payment::class, ['student_id', 'user_id'], 'id');
    }

    public function due()
    {
        return $this->hasMany(Due::class, 'student_id', 'id');
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'user_id', 'id');
    }

    public function agent()
    {
        return $this->hasOne(Agent::class, 'user_id', 'id');
    }

    public function school_payment()
    {
        return $this->hasMany(SchoolPayment::class, 'user_id', 'id');
    }

    public function student_payment()
    {
        return $this->hasMany(StudentPayment::class, 'student_id', 'id');
    }

    public function studentFile()
    {
        return $this->hasMany('App\StudentFile', 'student_id', 'id');
    }

    public function grade()
    {
        return $this->hasMany(Grade::class, 'user_id', 'id');
    }

    public function issueBook()
    {
        return $this->hasMany(Issuedbook::class, 'student_code', 'student_code');
    }

    public function hasRole(string $role): bool
    {
        return $this->role == $role ? true : false;
    }

    public function countUser($role)
    {
        return $this->bySchool(\school('id'))->active()->role($role)->count();
    }

    public function getUsers($role = 'student', $active = true, $limit = false, $sort = false, $sortBy = 'asc', $paginate = false)
    {
        $user = $this->bySchool(\school('id'))->whereActive($active)->role($role);
        if ($role == 'student') {
            $user = $user->leftjoin('student_infos', 'users.id', 'student_infos.student_id')
                ->where('student_infos.session', currentSession()->id)->select('users.*');
        }
        if ($sort) {
            $user = $user->orderBy($sort, $sortBy);
        }
        if ($limit) {
            $user = $user->take($limit);
        }
        if ($paginate) {
            $user = $user->paginate($paginate);
        } else {
            $user = $user->get();
        }
        return $user;
    }

    public function getUsersPluck($role, $active = false, $sort = false, $sortBy = 'asc')
    {
        $user = $this->bySchool(\school('id'))->whereActive($active)->role($role);
        if ($sort) {
            $user = $user->orderBy($sort, $sortBy);
        }
        return $user->pluck('name', 'id');
    }

    public function getUser($id = false, $code = false, $role = 'student')
    {
        $school_id = Auth::guest() ? school('id') : Auth::user()->school_id;
        $user = $this->bySchool($school_id)->active();
        if ($role) {
            $user = $user->role($role);
        }
        if ($code) {
            $user = $user->studentCode($code)->first();
        } else {
            $user = $user->find($id);
        }
        return $user;
    }

    public function newUserAdmin($data, $role = 'admin')
    {
        $create = new self();
        $create->name = $data['name'];
        $create->email = $data['email'];
        $create->password = bcrypt($data['password']);
        $create->role = $role;
        $create->active = 1;
        $create->school_id = $data['school_id'];
        $create->code = $data['code'];
        $create->student_code = generateStudentCode($data['school_id']);
        $create->gender = $data['gender'] ?? null;
        $create->blood_group = $data['blood_group'] ?? null;
        $create->nationality = $data['nationality'] ?? null;
        $create->phone_number = $data['phone_number'];
        $create->address = $data['address'] ?? '--';
        $create->verified = 1;
        if (Auth::guest()) {
            $create->isSuper = 1;
        }
        $create->save();
        if (isset($data['agentnew'])) {
            $agent = new Agent();
            $agent->shareOf = $data['shareOf'] ?? '30';
            $create->agent()->save($agent);
        }
        return $create;
    }
}
