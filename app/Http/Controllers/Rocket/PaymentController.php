<?php

namespace App\Http\Controllers\Rocket;

use App\Due;
use App\Http\Controllers\Controller;
use App\Payment;
use App\PaymentDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public $ip = '103.11.136.153'; //rocket payment ip

    //http://abc.com/validate?username=xxxx&password=xxxx&&studentid=xxxx
    public function getDue(Request $request)
    {
        if ($request->ip() != $this->ip && env('app_env') == 'production')
            return '02';
        $username = trim($request->get('username'));
        $password = trim($request->get('password'));
        $studentID = trim($request->get('studentid'));
        //$amount = $request->get('amount');

        if ($username == null) {
            return '06';
        } else if ($password == null) {
            return '07';
        } else if ($studentID == null) {
            return '09';
        }

        if ($username === trim(rocketCredentials('username')) && $password === trim(rocketCredentials('password'))) {
            $school_id = school('id');
            $user = User::bySchool($school_id)->active()->student()->where('student_code', $studentID)->select('id', 'name')->first();
            if ($user === null) {
                return '03';
            }
            $dues = Due::join('users', 'users.id', 'dues.student_id')
                ->join('fees', 'fees.id', 'dues.fee_id')
                ->leftJoin('payment_details', 'dues.id', 'payment_details.due_id')
                ->select('dues.id', 'dues.school_id', 'dues.status', 'fees.amount', DB::raw('sum(payment_details.amount) as paid'), DB::raw('sum(payment_details.waiver) as waiver'), DB::raw('fees.amount- CASE WHEN payment_details.amount IS NULL THEN 0 ELSE (sum(payment_details.amount)+sum(payment_details.waiver)) END  as due'))
                ->where('dues.school_id', $school_id)
                ->where('dues.status', 1)
                ->where('users.id', $user->id)->groupBy('dues.id');
            $dues = DBConnection()->table(DB::raw("({$dues->toSql()}) as data"))->mergeBindings($dues->getQuery())->where("due", "!=", 0)->get();
            $amount = 0;
            foreach ($dues as $due) {
                $amount += $due->due;
            }
            /* if ($already_paid) {
                 return 15;
             }*/
            if ($amount == 0) {
                return '09';
            }
            return '00|' . $amount . '|' . ucwords($user->name);
        } else {
            return '01';
        }
    }

//http://abc.com/confirm?username=xxxx&password=xxxx&studentid=xxxx&amount=xxxx&txnid=xxxx&txndate=xxxx
    public function confirmPayment(Request $request)
    {
        if ($request->ip() != $this->ip && env('app_env') == 'production')
            return '02';
        $username = trim($request->get('username'));
        $password = trim($request->get('password'));
        $studentID = trim($request->get('studentid'));
        $amount = trim($request->get('amount'));
        $txnid = trim($request->get('txnid'));
        $txndate = trim($request->get('txndate'));

        if ($username == null) {
            return '06';
        } else if ($password == null) {
            return '07';
        } else if ($studentID == null) {
            return '09';
        } else if ($amount == null) {
            return '10';
        } else if ($txnid == null) {
            return '13';
        }

        if ($username === trim(rocketCredentials('username')) && $password === trim(rocketCredentials('password'))) {
            $school_id = school('id');
            $user = User::bySchool($school_id)->active()->student()->where('student_code', $studentID)->select('id', 'name')->first();

            if ($user === null) {
                return '03';
            }
            $dues = Due::join('users', 'users.id', 'dues.student_id')
                ->join('fees', 'fees.id', 'dues.fee_id')
                ->leftJoin('payment_details', 'dues.id', 'payment_details.due_id')
                ->select('dues.id', 'dues.school_id', 'dues.status', 'fees.amount', DB::raw('sum(payment_details.amount) as paid'), DB::raw('sum(payment_details.waiver) as waiver'), DB::raw('fees.amount- CASE WHEN payment_details.amount IS NULL THEN 0 ELSE (sum(payment_details.amount)+sum(payment_details.waiver)) END  as due'))
                ->where('dues.school_id', $school_id)
                ->where('dues.status', 1)
                ->where('users.id', $user->id)->groupBy('dues.id');
            $dues = DBConnection()->table(DB::raw("({$dues->toSql()}) as data"))->mergeBindings($dues->getQuery())->where("due", "!=", 0)->get();
            $dueamount = 0;
            foreach ($dues as $due) {
                $dueamount += $due->due;
            }

            if ($amount != $dueamount) {
                return '11';
            }
            $payment = new Payment();
            $payment->school_id = $school_id;
            $payment->user_id = $user->id;
            $payment->student_id = $user->id;
            $payment->reciept_number = getShortName(\school('name')) . time();
            $payment->trans_date = date('Y-m-d', strtotime($txndate));
            $payment->trans_status = 'Paid';
            $payment->total = $amount;
            $payment->waiver = 0;
            $payment->card_type = 'Rocket';
            $payment->stripe_fee = 0;
            $payment->payment_type = 5;
            $payment->trans_id = $txnid;
            $payment->fee_pay = 0;
            $payment->currency = 'BDT';
            $payment->save();

            foreach ($dues as $due) {
                $paymentDetail['due_id'] = $due->id;
                $paymentDetail['amount'] = $due->due;
                $paymentDetail['waiver'] = 0;
                $paymentDetail['payment_id'] = $payment->id;
                $paymentDetail['created_at'] = now();
                $paymentDetail['updated_at'] = now();
                $paymentDetails[] = $paymentDetail;
                Due::where('id', $due->id)->update(['status' => 2]);
            }
            PaymentDetail::insert($paymentDetails);
            $sms_data['name'] = $payment->student->name;
            $sms_data['mobile'] = $payment->student->phone_number;
            $sms_data['tranxID'] = $payment->reciept_number;
            $sms_data['amount'] = $amount;
            student_payment_sms($sms_data);
            return 'Success';
        } else {
            return '01';
        }
    }
}
