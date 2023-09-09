<?php

namespace App;

use App\Model;

class Payment extends Model
{
    protected $fillable = ["school_id", "user_id", "student_id", 'trans_date', 'trans_status', "reciept_number", "total", "waiver", "payment_type", "remark", "ledger_id"];

    public function paymentDetail()
    {
        return $this->hasMany(PaymentDetail::class, 'payment_id', 'id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(Myclass::class, 'class_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function ledger()
    {
        return $this->belongsTo(Ledger::class, 'ledger_id', 'id');
    }

    public function student_month_payment($student_id, $year, $month)
    {
        return $this->whereYear('trans_date', $year)->whereMonth('trans_date', $month)
            ->where('student_id', $student_id)->sum('total');
    }
}
