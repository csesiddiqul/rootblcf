<?php

namespace App\Http\Controllers;

use App\Admission;
use App\AdmissionPayment;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdmissionPaymentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $admission = $this->admission->bySchool(school('id'))->find($id);
        $admission_amount = $admission->section->add_amount;
        if (foqas_setting('add_amount_charge') == 1) {
            $total = $admission_amount / (1 - 0.025);
            $amount = round($total, 2);
            $tran_fee = round($total, 2) - $admission_amount;
        } else {
            $amount = $admission_amount;
            $tran_fee = 0;
        }

        $post_data = array();
        $post_data['total_amount'] = $amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = generateTransID(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $admission->name;
        $post_data['cus_email'] = $admission->email;
        $post_data['cus_add1'] = $admission->presentAddress;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $admission->gPhone ?? '+8801554320637';

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = $admission->name;
        $post_data['ship_add1'] = 'Ipsita Computers Pte Ltd.';
        $post_data['ship_city'] = "25/A, 7th Floor, Green Road, Dhaka-1205";
        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "ICPL Academy";
        $post_data['product_category'] = "Registration";
        $post_data['product_profile'] = "foqas_academy";
        # OPTIONAL PARAMETERS
        $post_data['value_a'] = $admission->id;

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $admission_payment = $this->admissionPayment::bySchool(school('id'))->firstOrCreate(['trans_id' => $post_data['tran_id'], 'admission_id' => $admission->id]);
        $admission_payment->school_id = school('id');
        $admission_payment->admission_id = $admission->id;
        $admission_payment->trans_number = getShortName(\school('name')) . time();
        $admission_payment->trans_id = $post_data['tran_id'];
        $admission_payment->trans_type = 2; // SSL
        $admission_payment->amount = $amount;
        $admission_payment->fee_pay = foqas_setting('add_amount_charge');
        $admission_payment->stripe_fee = $tran_fee;
        $admission_payment->trans_status = 'Pending';
        $admission_payment->currency = 'BDT';
        $admission_payment->save();
        $sslc = new SslCommerzNotification();
        $payment_options = $sslc->makePayment($post_data, 'hosted');
        return $payment_options;
    }

    public function payViaAjax(Request $request, $roll)
    {
        $roll = base64_decode(base64_decode(str_replace(base64_encode(date('Y')), '', $roll)));
        $admission = $this->admission->bySchool(school('id'))->whereRoll($roll)->first();
        if (empty($admission)) {
            toast(transMsg('Nothing found payment details'), 'info')->timerProgressBar();
            return response()->json(['msg' => 'Nothing found payment details']);
        }
        if ($admission->status == 4) {
            toast(transMsg('Payment Already successfully'), 'info')->timerProgressBar();
            return response()->json(['msg' => 'Payment Already successfully']);
        }
        if ($admission->status == 5) {
            // status unpaid
            session([
                'SSL_SUCCESS_URL' => 'admission/payment/success',
                'SSL_FAIL_URL' => 'admission/payment/fail',
                'SSL_CANCEL_URL' => 'admission/payment/cancel',
            ]);
            $admission_amount = $admission->section->add_amount;
            if (foqas_setting('add_amount_charge') == 1) {
                $total = $admission_amount / (1 - 0.025);
                $amount = round($total, 2);
                $tran_fee = round($total, 2) - $admission_amount;
            } else {
                $amount = $admission_amount;
                $tran_fee = 0;
            }

            $post_data = array();
            $post_data['total_amount'] = $amount; # You cant not pay less than 10
            $post_data['currency'] = "BDT";
            $post_data['tran_id'] = generateTransID(); // tran_id must be unique

            # CUSTOMER INFORMATION
            $post_data['cus_name'] = $admission->name;
            $post_data['cus_email'] = $admission->email;
            $post_data['cus_add1'] = $admission->presentAddress;
            $post_data['cus_add2'] = "";
            $post_data['cus_city'] = "";
            $post_data['cus_state'] = "";
            $post_data['cus_postcode'] = "";
            $post_data['cus_country'] = "Bangladesh";
            $post_data['cus_phone'] = $admission->gPhone ?? '+8801554320637';

            # SHIPMENT INFORMATION
            $post_data['ship_name'] = $admission->name;
            $post_data['ship_add1'] = 'Ipsita Computers Pte Ltd.';
            $post_data['ship_city'] = "25/A, 7th Floor, Green Road, Dhaka-1205";
            $post_data['shipping_method'] = "NO";
            $post_data['product_name'] = "ICPL Academy";
            $post_data['product_category'] = "Registration";
            $post_data['product_profile'] = "foqas_academy";
            # OPTIONAL PARAMETERS
            $post_data['value_a'] = $admission->id;

            #Before  going to initiate the payment order status need to insert or update as Pending.
            $admission_payment = $this->admissionPayment::bySchool(school('id'))->firstOrCreate(['trans_id' => $post_data['tran_id'], 'admission_id' => $admission->id]);
            $admission_payment->school_id = school('id');
            $admission_payment->admission_id = $admission->id;
            $admission_payment->trans_number = getShortName(\school('name')) . time();
            $admission_payment->trans_id = $post_data['tran_id'];
            $admission_payment->trans_type = 2; // SSL
            $admission_payment->amount = $amount;
            $admission_payment->fee_pay = foqas_setting('add_amount_charge');
            $admission_payment->stripe_fee = $tran_fee;
            $admission_payment->trans_status = 'Pending';
            $admission_payment->currency = 'BDT';
            $admission_payment->save();
            $sslc = new SslCommerzNotification();
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payment gateway here )
            $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
            }
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
        $admissionID = $request->value_a;

        $sslc = new SslCommerzNotification();
        $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);
        $admission_payment = $this->admissionPayment->bySchool(school('id'))->where('trans_id', $tran_id)->where('admission_id', $admissionID)->first();

        if ($validation == TRUE) {
            if ($admission_payment->trans_status == 'Pending') {
                $admission_payment->trans_date = $tran_date;
                $admission_payment->trans_status = 'Paid';
                $admission_payment->amount = $store_amount;
                $admission_payment->card_type = $card_type;
                $admission_payment->stripe_fee = $amount - $store_amount;
                $admission_payment->save();
                $admission = $this->admission->find($admissionID);
                $admission->status = 2; //approve // 4 = Paid
                $admission->save();
                toast(transMsg('Your payment was completed!'), 'success')->timerProgressBar();
                admission_payment_sms($admission);
                return redirect()->route('verify.admission')->with('admission', $admission);
            } else if ($admission_payment->trans_status == 'Paid') {
                toast(transMsg('Your payment already completed!'), 'success')->timerProgressBar();
                return redirect()->route('verify.admission');
            } else {
                toast(transMsg('Invalid Transaction!'), 'warning')->timerProgressBar();
                return redirect()->route('verify.admission');
            }
        } else {
            $admission_payment->trans_status = 'Failed';
            $admission_payment->save();
            toast(transMsg('Validation Failed!'), 'warning')->timerProgressBar();
            return redirect()->route('verify.admission');
        }
    }

    public function cancel(Request $request)
    {
        $this->clearSSLSession();
        $tran_id = $request->tran_id;
        $admissionID = $request->value_a;
        $admission_payment = $this->admissionPayment->bySchool(school('id'))->where('trans_id', $tran_id)->where('admission_id', $admissionID)->first();
        if ($admission_payment) {
            if ($admission_payment->trans_status == 'Pending') {
                $admission_payment->delete();
                $admission_payment = $this->admissionPayment->orderBy('id', 'DESC')->first();
                if (isset($admission_payment->id)) {
                    DB::connection(db_connection())->statement("ALTER TABLE admission_payments AUTO_INCREMENT = " . ($admission_payment->id + 1));
                }
                $admission = $this->admission->find($admissionID);
                toast(transMsg('Transaction is ' . $request->error), 'error')->timerProgressBar();
                return redirect()->route('verify.admission')->with('admission', $admission);
            } else if ($admission_payment->trans_status == 'Paid') {
                toast(transMsg('Your payment already completed!'), 'success')->timerProgressBar();
                return redirect()->route('verify.admission');
            } else {
                toast(transMsg('Invalid Transaction!'), 'warning')->timerProgressBar();
                return redirect()->route('verify.admission');
            }
        } else {
            toast(transMsg('Invalid Transaction!'), 'warning')->timerProgressBar();
            return redirect()->route('verify.admission');
        }

    }

    public function fail(Request $request)
    {
        $this->clearSSLSession();
        $tran_id = $request->tran_id;
        $admissionID = $request->value_a;

        $admission_payment = $this->admissionPayment->bySchool(school('id'))->where('trans_id', $tran_id)->where('admission_id', $admissionID)->first();
        if ($admission_payment->trans_status == 'Pending') {
            $admission_payment->trans_status = 'Failed';
            $admission_payment->save();
            $admission = $this->admission->find($admissionID);
            toast(transMsg('Transaction is ' . $request->error), 'error')->timerProgressBar();
            return redirect()->route('verify.admission')->with('admission', $admission);
        } else if ($admission_payment->trans_status == 'Paid') {
            toast(transMsg('Your payment already completed!'), 'success')->timerProgressBar();
            return redirect()->route('verify.admission');
        } else {
            toast(transMsg('Invalid Transaction!'), 'warning')->timerProgressBar();
            return redirect()->route('verify.admission');
        }
    }

    protected function clearSSLSession()
    {
        session()->forget('SSL_SUCCESS_URL');
        session()->forget('SSL_FAIL_URL');
        session()->forget('SSL_CANCEL_URL');
    }

    public function stripe_pay(Request $request, $roll)
    {
        $roll = base64_decode(base64_decode(str_replace(base64_encode(date('Y')), '', $roll)));
        $token = $request->stripeToken;
        if (empty($token)) {
            toast(transMsg('Stripe Token required'), 'error')->timerProgressBar();
            return back();
        }
        $admission = $this->admission->whereRoll($roll)->first();
        if (empty($admission)) {
            toast(transMsg("Roll doesn't exists."), 'error')->timerProgressBar();
            return back();
        }
        $name = $admission->name;
        $email = $admission->email;
        \Stripe\Stripe::setApiKey(stripe_apiKey());

        //Passing the Stripe fee on to customers
        $admission_amount = $admission->section->add_amount;
        if (foqas_setting('add_amount_charge') == 1) {
            //  charge create with amount
            $total = ($admission_amount + 0.30) / (1 - 0.029);
            $amount = round($total, 2) * 100;
            $stripe_fee = round($total, 2) - $admission_amount;
        } else {
            //  charge create without amount
            $amount = round($admission_amount, 2) * 100;
        }

        try {
            $charge = \Stripe\Charge::create([
                'amount' => $amount,
                'currency' => 'usd',
                'description' => $name . ' (' . $email . ')',
                'source' => $token,
                "expand" => array("balance_transaction")
            ]);
            $status = $charge->status;
            $charge_id = $charge->id;
            $transaction_id = $charge->balance_transaction->id;
            $created = $charge->created;
            $currency = $charge->currency;
            $brand = $charge->payment_method_details->card->brand;
            $type = $charge->payment_method_details->type;
            if (foqas_setting('add_amount_charge') == 0) {
                $stripe_fee = $charge->balance_transaction->fee / 100;
                $admission_amount = round($admission_amount - $stripe_fee, 2);
            }
            $rangeParse = \Carbon\Carbon::parse($created);
            $trans_date = date('Y-m-d H:i:s', strtotime($rangeParse));

            if ($status == 'succeeded') {
                $admission_payment = $this->admissionPayment::bySchool(school('id'))->firstOrCreate(['trans_id' => $transaction_id, 'admission_id' => $admission->id]);
                $admission_payment->school_id = school('id');
                $admission_payment->admission_id = $admission->id;
                $admission_payment->trans_number = getShortName(\school('name')) . time();
                $admission_payment->stripe_charge = $charge_id;
                $admission_payment->trans_id = $transaction_id;
                $admission_payment->trans_date = $trans_date;
                $admission_payment->trans_type = 1; // Stripe
                $admission_payment->trans_status = 'Paid';
                $admission_payment->fee_pay = foqas_setting('add_amount_charge');
                $admission_payment->amount = $admission_amount;
                $admission_payment->stripe_fee = $stripe_fee;
                $admission_payment->currency = strtoupper($currency);
                $admission_payment->card_type = ucfirst($brand) . '-' . ucfirst($type);
                $admission_payment->save();
                $admission = $this->admission->find($admission->id);
                $admission->status = 4;
                $admission->save();
                toast(transMsg('Your payment was completed!'), 'success')->timerProgressBar();
                admission_payment_sms($admission);
                return redirect()->route('verify.admission')->with('admission', $admission);
            } else {
                toast('Payment failed, Please try again!', 'warning')->timerProgressBar();
                return redirect()->back();
            }
        } catch (\Stripe\Exception\CardException $e) {
            toast($e->getError()->message, 'warning')->timerProgressBar();
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            toast($e->getError()->message, 'warning')->timerProgressBar();
        } catch (Exception $e) {
            toast('Something went wrong, Please try again!', 'warning')->timerProgressBar();
        }
        return redirect()->back();
    }
}
