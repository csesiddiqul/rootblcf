<?php

namespace App;

use App\Model;
use Illuminate\Support\Facades\DB;

class Admission extends Model
{
    protected $fillable = ['school_id', 'branch_id', 'section_id', 'class_id', 'name', 'gender', 'religon', 'lottery', 'merit', 'waiting_1', 'waiting_2', 'waiting_3'];

    public function scopeRoll($query, int $roll)
    {
        return $query->where('roll', $roll);
    }

    public function school()
    {
        return $this->belongsTo('App\School', 'school_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo('App\School', 'branch_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo('App\Myclass', 'class_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo('App\Section', 'section_id', 'id');
    }

    public function admissionPayment()
    {
        return $this->hasOne('App\AdmissionPayment', 'admission_id', 'id')->latest();
    }

    public function studentFile()
    {
        return $this->hasMany('App\StudentFile', 'student_id', 'id');
    }

    public function house()
    {
        return $this->belongsTo('App\House', 'previous_class', 'id');
    }

    public function cal_merit_with_mark()
    {
        if (foqas_setting('admission_result')) {
            $preAddID = preAdmissionId();
            $school_id = school('id');
            if ($preAddID) {
                $admissions = self::bySchool($school_id)->where('preadmission_id', $preAddID)->where('status', 2)->get();
                $merit = false;
                foreach ($admissions as $admission) {
                    if ($admission->merit == null && $admission->mark > 0) {
                        $merit = true;
                        break;
                    }

                }
                if ($merit) {
                    $admissions = self::bySchool($school_id)->where('preadmission_id', $preAddID)->where('status', 2)
                        ->orderBy('mark', 'DESC')->get();
                    DB::transaction(function () use ($admissions) {
                        foreach ($admissions as $key => $student) {
                            $student->update(['merit' => $key + 1]);
                        }
                    });
                }
            }
        }
    }

    public function waiting_1()
    {
        if (foqas_setting('waiting1_status')) {
            $preAddID = preAdmissionId();
            $school_id = school('id');
            if ($preAddID) {
                $admissions = self::with(['section'])
                    ->where('preadmission_id', preAdmissionId())
                    ->where('school_id', $school_id)
                    ->where('status', 2)
                    ->orderBy('merit', 'ASC')
                    ->orderBy('mark', 'DESC')
                    ->get()->groupBy('section_id');
                foreach (admissionClass()->sort() as $key => $value) {
                    if (isset($admissions[$key])) {
                        $waiting1_total = $merit_total = 0;
                        foreach ($admissions[$key] as $result) {
                            $waiting1_total = $result->section->waiting_1;
                            $merit_total = $result->section->add_total;
                            break;
                        }
                        if ($waiting1_total > 0) {
                            foreach ($admissions[$key] as $loop => $result) {
                                if (($loop + 1) > $merit_total) {
                                    if (($loop) < ($merit_total + $waiting1_total))
                                        $result->update(['waiting_1' => 1]);
                                    else
                                        break;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function waiting_2()
    {
        if (foqas_setting('waiting2_status')) {
            $preAddID = preAdmissionId();
            $school_id = school('id');
            if ($preAddID) {
                $admissions = self::with(['section'])
                    ->where('preadmission_id', preAdmissionId())
                    ->where('school_id', $school_id)
                    ->where('status', 2)
                    ->orderBy('merit', 'ASC')
                    ->orderBy('mark', 'DESC')
                    ->get()->groupBy('section_id');
                foreach (admissionClass()->sort() as $key => $value) {
                    if (isset($admissions[$key])) {
                        $waiting1_total = $waiting2_total = $merit_total = 0;
                        foreach ($admissions[$key] as $result) {
                            $waiting1_total = $result->section->waiting_1;
                            $waiting2_total = $result->section->waiting_2;
                            $merit_total = $result->section->add_total;
                            break;
                        }
                        if ($waiting2_total > 0) {
                            foreach ($admissions[$key] as $loop => $result) {
                                if (($loop + 1) > ($merit_total + $waiting1_total)) {
                                    if (($loop) < ($merit_total + $waiting1_total + $waiting2_total))
                                        $result->update(['waiting_2' => 1]);
                                    else
                                        break;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function waiting_3()
    {
        if (foqas_setting('waiting3_status')) {
            $preAddID = preAdmissionId();
            $school_id = school('id');
            if ($preAddID) {
                $admissions = self::with(['section'])
                    ->where('preadmission_id', preAdmissionId())
                    ->where('school_id', $school_id)
                    ->where('status', 2)
                    ->orderBy('merit', 'ASC')
                    ->orderBy('mark', 'DESC')
                    ->get()->groupBy('section_id');
                foreach (admissionClass()->sort() as $key => $value) {
                    if (isset($admissions[$key])) {
                        $waiting1_total = $waiting2_total = $waiting3_total = $merit_total = 0;
                        foreach ($admissions[$key] as $result) {
                            $waiting1_total = $result->section->waiting_1;
                            $waiting2_total = $result->section->waiting_2;
                            $waiting3_total = $result->section->waiting_3;
                            $merit_total = $result->section->add_total;
                            break;
                        }
                        if ($waiting3_total > 0) {
                            foreach ($admissions[$key] as $loop => $result) {
                                if (($loop + 1) > ($merit_total + $waiting1_total + $waiting2_total)) {
                                    if (($loop) < ($merit_total + $waiting1_total + $waiting2_total + $waiting3_total))
                                        $result->update(['waiting_3' => 1]);
                                    else
                                        break;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
