<?php

namespace App\Http\Controllers;

use App\Due;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Payment;
use App\PaymentDetail;
use App\StudentPayment;
use Illuminate\Http\Request;

class StudentPaymentController extends Controller
{
    public function payOnlineNow_hosted($student_code, $payment_type, $section_id, $due_ids)
    {
        $school_id = school('id');
        $student = $this->user->bySchool($school_id)->active()->where('section_id', $section_id)->studentCode($student_code)
            ->join('student_infos', 'users.id', '=', 'student_infos.student_id')
            ->where('student_infos.session', $this->current_session->id)->select('users.*')->first();
        if (empty($student)) {
            toast(transMsg('Student not found'), 'info')->timerProgressBar();
            return response()->json(['msg' => 'Student not found']);
        }
        $decode_due_ids = base64_decode($due_ids);

        $dues = Due::join('users', 'users.id', 'dues.student_id')
            ->join('fees', 'fees.id', 'dues.fee_id')
            ->join('account_sectors', 'account_sectors.id', 'fees.type')
            ->leftJoin('payment_details', 'dues.id', 'payment_details.due_id')
            ->select('dues.id', 'dues.school_id', 'dues.user_id', 'dues.class_id', 'dues.section_id', 'dues.student_id', 'dues.fee_id', 'dues.status', 'fees.amount', 'fees.type', 'fees.created_at', 'users.name', 'users.student_code', 'account_sectors.name as account_sectors', \DB::raw('sum(payment_details.amount) as paid'), \DB::raw('sum(payment_details.waiver) as waiver'), \DB::raw('fees.amount- CASE WHEN payment_details.amount IS NULL THEN 0 ELSE (sum(payment_details.amount)+sum(payment_details.waiver)) END  as due'))
            ->where('dues.school_id', $school_id)
            ->where('dues.status', 1)
            ->where('users.id', $student->id)->groupBy('dues.id');
        if ($payment_type != 0)
            $dues = $dues->where('account_sectors.id', $payment_type);
        $dues = DBConnection()->table(\DB::raw("({$dues->toSql()}) as data"))->mergeBindings($dues->getQuery())->where("due", "!=", 0)->get();
        $due_amount_total = 0;
        foreach ($dues as $due) {
            $due_amount_total += $due->due;
        }
        if (foqas_setting('add_amount_charge') == 1) {
            $total = $due_amount_total / (1 - 0.025);
            $amount = round($total, 2);
            $tran_fee = round($total, 2) - $due_amount_total;
        } else {
            $amount = $due_amount_total;
            $tran_fee = 0;
        }
        session([
            'SSL_SUCCESS_URL' => 'student/pay/success',
            'SSL_FAIL_URL' => 'student/pay/fail',
            'SSL_CANCEL_URL' => 'student/pay/cancel',
        ]);

        $post_data = array();
        $post_data['total_amount'] = $amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = generateTransID('student'); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $student->name;
        $post_data['cus_email'] = $student->email;
        $post_data['cus_add1'] = $student->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $student->phone_number ?? '+8801554320637';

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = $student->name;
        $post_data['ship_add1'] = 'Ipsita Computers Pte Ltd.';
        $post_data['ship_city'] = "25/A, 7th Floor, Green Road, Dhaka-1205";
        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "ICPL Academy";
        $post_data['product_category'] = "Student Payment";
        $post_data['product_profile'] = "foqas_academy";
        # OPTIONAL PARAMETERS
        $post_data['value_a'] = $student->id;
        $post_data['value_b'] = $decode_due_ids;
        $post_data['value_c'] = $payment_type;

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $student_payment = StudentPayment::bySchool($school_id)->firstOrCreate(['trans_id' => $post_data['tran_id'], 'student_id' => $student->id]);
        $student_payment->school_id = $school_id;
        $student_payment->student_id = $student->id;
        $student_payment->trans_number = getShortName(\school('name')) . time();
        $student_payment->trans_id = $post_data['tran_id'];
        $student_payment->trans_type = 2; // SSL
        $student_payment->amount = $amount;
        $student_payment->fee_pay = foqas_setting('add_amount_charge');
        $student_payment->stripe_fee = $tran_fee;
        $student_payment->trans_status = 'Pending';
        $student_payment->currency = 'BDT';
        $student_payment->save();

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payment gateway here )
        return $payment_options = $sslc->makePayment($post_data, 'hosted');

    }

    public function payOnlineNow($student_code, $payment_type, $section_id, $due_ids)
    {
        $school_id = school('id');
        $student = $this->user->bySchool($school_id)->active()->where('section_id', $section_id)->studentCode($student_code)
            ->join('student_infos', 'users.id', '=', 'student_infos.student_id')
            ->where('student_infos.session', $this->current_session->id)->select('users.*')->first();
        if (empty($student)) {
            toast(transMsg('Student not found'), 'info')->timerProgressBar();
            return response()->json(['msg' => 'Student not found']);
        }
        $decode_due_ids = base64_decode($due_ids);

        $dues = Due::join('users', 'users.id', 'dues.student_id')
            ->join('fees', 'fees.id', 'dues.fee_id')
            ->join('account_sectors', 'account_sectors.id', 'fees.type')
            ->leftJoin('payment_details', 'dues.id', 'payment_details.due_id')
            ->select('dues.id', 'dues.school_id', 'dues.user_id', 'dues.class_id', 'dues.section_id', 'dues.student_id', 'dues.fee_id', 'dues.status', 'fees.amount', 'fees.type', 'fees.created_at', 'users.name', 'users.student_code', 'account_sectors.name as account_sectors', \DB::raw('sum(payment_details.amount) as paid'), \DB::raw('sum(payment_details.waiver) as waiver'), \DB::raw('fees.amount- CASE WHEN payment_details.amount IS NULL THEN 0 ELSE (sum(payment_details.amount)+sum(payment_details.waiver)) END  as due'))
            ->where('dues.school_id', $school_id)
            ->where('dues.status', 1)
            ->where('users.id', $student->id)->groupBy('dues.id');
        if ($payment_type != 0)
            $dues = $dues->where('account_sectors.id', $payment_type);
        $dues = DBConnection()->table(\DB::raw("({$dues->toSql()}) as data"))->mergeBindings($dues->getQuery())->where("due", "!=", 0)->get();
        $due_amount_total = 0;
        foreach ($dues as $due) {
            $due_amount_total += $due->due;
        }
        if (foqas_setting('add_amount_charge') == 1) {
            $total = $due_amount_total / (1 - 0.025);
            $amount = round($total, 2);
            $tran_fee = round($total, 2) - $due_amount_total;
        } else {
            $amount = $due_amount_total;
            $tran_fee = 0;
        }
        session([
            'SSL_SUCCESS_URL' => 'student/pay/success',
            'SSL_FAIL_URL' => 'student/pay/fail',
            'SSL_CANCEL_URL' => 'student/pay/cancel',
        ]);

        $post_data = array();
        $post_data['total_amount'] = $amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = generateTransID('student'); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $student->name;
        $post_data['cus_email'] = $student->email;
        $post_data['cus_add1'] = $student->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $student->phone_number ?? '+8801554320637';

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = $student->name;
        $post_data['ship_add1'] = 'Ipsita Computers Pte Ltd.';
        $post_data['ship_city'] = "25/A, 7th Floor, Green Road, Dhaka-1205";
        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "ICPL Academy";
        $post_data['product_category'] = "Student Payment";
        $post_data['product_profile'] = "foqas_academy";
        # OPTIONAL PARAMETERS
        $post_data['value_a'] = $student->id;
        $post_data['value_b'] = $decode_due_ids;
        $post_data['value_c'] = $payment_type;

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $student_payment = StudentPayment::bySchool($school_id)->firstOrCreate(['trans_id' => $post_data['tran_id'], 'student_id' => $student->id]);
        $student_payment->school_id = $school_id;
        $student_payment->student_id = $student->id;
        $student_payment->trans_number = getShortName(\school('name')) . time();
        $student_payment->trans_id = $post_data['tran_id'];
        $student_payment->trans_type = 2; // SSL
        $student_payment->amount = $amount;
        $student_payment->fee_pay = foqas_setting('add_amount_charge');
        $student_payment->stripe_fee = $tran_fee;
        $student_payment->trans_status = 'Pending';
        $student_payment->currency = 'BDT';
        $student_payment->save();

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payment gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function success(Request $request)
    {
        $this->clearSSLSession();
        $tran_id = $request->tran_id;
        $amount = $request->amount;
        $store_amount = $request->store_amount;
        $currency = $request->currency;
        $card_type = $request->card_type;
        $tran_date = $request->tran_date;
        $student_id = $request->value_a;
        $due_ids = $request->value_b;
        $payment_type = $request->value_c;

        $sslc = new SslCommerzNotification();
        $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);
        $student_payment = StudentPayment::bySchool(school('id'))->where('trans_id', $tran_id)->where('student_id', $student_id)->first();

        if ($validation == TRUE) {
            if ($student_payment->trans_status == 'Pending') {
                $payment = new Payment();
                $payment->school_id = $student_payment->school_id;
                $payment->user_id = $student_id;
                $payment->student_id = $student_id;
                $payment->reciept_number = $student_payment->trans_number;
                $payment->trans_date = date('Y-m-d',strtotime($tran_date));
                $payment->trans_status = 'Paid';
                $payment->total = $store_amount;
                $payment->waiver = 0;
                $payment->card_type = $card_type;
                $payment->stripe_fee = $amount - $store_amount;
                $payment->payment_type = 2;
                $payment->trans_id = $tran_id;
                $payment->fee_pay = $student_payment->fee_pay;
                $payment->currency = $currency;
                $payment->save();
                $student_payment->delete();

                $due_ids = explode(',', $due_ids);
                for ($i = 0; $i < count($due_ids); $i++) {
                    $due = Due::find($due_ids[$i]);
                    $paymentDetail['due_id'] = $due->id;
                    $paymentDetail['amount'] = $due->fee->amount;
                    $paymentDetail['waiver'] = 0;
                    $paymentDetail['payment_id'] = $payment->id;
                    $paymentDetail['created_at'] = now();
                    $paymentDetail['updated_at'] = now();
                    $paymentDetails[] = $paymentDetail;
                    $due->update(['status' => 2]);
                }
                PaymentDetail::insert($paymentDetails);
                toast(transMsg('Your payment was completed!'), 'success')->timerProgressBar();
                $sms_data['name'] = $payment->student->name;
                $sms_data['mobile'] = $payment->student->phone_number;
                $sms_data['tranxID'] = $payment->reciept_number;
                $sms_data['amount'] = $amount;
                student_payment_sms($sms_data);
                session()->put('invoice_show',true);
                return redirect()->route('invoice', $payment->reciept_number);
            } else {
                $student_payment->delete();
                toast(transMsg('Invalid Transaction!'), 'warning')->timerProgressBar();
                return redirect()->route('pay_online');
            }
        } else {
            $student_payment->delete();
            toast(transMsg('Validation Failed!'), 'warning')->timerProgressBar();
            return redirect()->route('pay_online');
        }
    }

    public function fail(Request $request)
    {
        $this->clearSSLSession();
        $tran_id = $request->tran_id;
        $student_id = $request->value_a;

        $admission_payment = StudentPayment::bySchool(school('id'))->where('trans_id', $tran_id)->where('student_id', $student_id)->delete();
        toast(transMsg('Your Transaction is failed!'), 'warning')->timerProgressBar();
        return redirect()->route('pay_online');
    }

    public function cancel(Request $request)
    {
        $this->clearSSLSession();
        $tran_id = $request->tran_id;
        $student_id = $request->value_a;

        $admission_payment = StudentPayment::bySchool(school('id'))->where('trans_id', $tran_id)->where('student_id', $student_id)->delete();
        toast(transMsg('Your Transaction is Cancel!'), 'warning')->timerProgressBar();
        return redirect()->route('pay_online');
    }

    protected function clearSSLSession()
    {
        session()->forget('SSL_SUCCESS_URL');
        session()->forget('SSL_FAIL_URL');
        session()->forget('SSL_CANCEL_URL');
    }
}
