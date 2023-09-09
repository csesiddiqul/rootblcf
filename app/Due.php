<?php

namespace App;

use App\Model;
use Illuminate\Support\Facades\DB;

class Due extends Model
{

    protected $table = 'dues';
    protected $fillable = ['status'];

    public function fee()
    {
        return $this->belongsTo(Fee::class, 'fee_id', 'id');
    }

    public function fee_sum($type, $section_id, $from, $to)
    {
        $from = date('Y-m-d', strtotime($from));
        $to = date('Y-m-d', strtotime($to));
        return $total_dues = $this->where('section_id', $section_id)
            ->leftjoin('fees', 'fees.id', 'dues.fee_id')
            ->where('fees.type', $type)
            ->whereBetween('fees.date', [$from, $to])
            ->sum('fees.amount');
    }

    public function paid_sum($type, $section_id, $from, $to)
    {
        $from = date('Y-m-d', strtotime($from));
        $to = date('Y-m-d', strtotime($to));
        return $total_paid = $this->where('section_id', $section_id)
            ->leftjoin('fees', 'fees.id', 'dues.fee_id')
            ->leftjoin('payment_details', function ($q) {
                $q->on('dues.id', 'payment_details.due_id')
                    ->whereRaw('(CASE WHEN payment_details.amount IS NOT NULL THEN true ELSE false END )');
            })
            ->where('fees.type', $type)
            ->whereBetween('fees.date', [$from, $to])
            ->sum('payment_details.amount');
    }

    public function waiver_sum($type, $section_id, $from, $to)
    {
        $from = date('Y-m-d', strtotime($from));
        $to = date('Y-m-d', strtotime($to));
        return $total_paid = $this->where('section_id', $section_id)
            ->leftjoin('fees', 'fees.id', 'dues.fee_id')
            ->leftjoin('payment_details', function ($q) {
                $q->on('dues.id', 'payment_details.due_id')
                    ->whereRaw('(CASE WHEN payment_details.amount IS NOT NULL THEN true ELSE false END )');
            })
            ->where('fees.type', $type)
            ->whereBetween('fees.date', [$from, $to])
            ->sum('payment_details.waiver');
    }

    public function class()
    {
        return $this->belongsTo(Myclass::class, 'class_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function paymentDetail()
    {
        return $this->hasMany(PaymentDetail::class, 'due_id', 'id');
    }
}
