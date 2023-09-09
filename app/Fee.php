<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Fee extends Model
{
    protected $fillable = ['school_id', 'user_id', 'financialYear_id', 'type', 'amount', 'cycle', 'cycle_status', 'date'];

    public function account_sector()
    {
        return $this->belongsTo('App\AccountSector', 'type', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function due()
    {
        return $this->hasMany('App\Due', 'fee_id', 'id');
    }

    public function due_one()
    {
        return $this->hasOne('App\Due', 'fee_id', 'id');
    }

    public function financial_year()
    {
        return $this->belongsTo('App\FinancialYear', 'financialYear_id', 'id');
    }

    public function generate_cycle()
    {
        DB::transaction(function () {
            $fees = self::whereRaw('cycle != cycle_status')->get();
            foreach ($fees as $fee) {
                $cycle = $fee->cycle;
                $month = $cycle - 1; // including current month also
                $rangeFrom = date('Y-m-d H:i:s', strtotime('+' . $month . ' month', strtotime($fee->created_at)));
                if (now()->lt($rangeFrom)) {
                    foreach ($fee->due->unique('student_id') as $due) {
                        if ($due) {
                            $new_due = $due->replicate();
                            $new_due->status = 1;
                            $new_due->save();
                        }
                    }
                    $fee->increment('cycle_status');
                }
            }
        });
    }

    public function student_total_dues($student_id, $year)
    {
        return $this->whereYear('created_at', $year)
            ->whereHas('due', function ($q) use ($student_id) {
                $q->where('student_id', $student_id);
            })->sum('amount');
    }
}
