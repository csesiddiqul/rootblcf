<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Menu;
use App\School;
use App\Setting;
use App\User;
use App\Pricing;
use App\SchoolPayment;
use App\Subscription;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SslCommerzPaymentController extends Controller
{
    public function index(Request $request)
    {
        $country = trim(getCountryByCode(session('step1')['nationality'])['name']);
        $shareOf = 0;

        if (!empty($request->ref_number)) {
            $pricing = Pricing::where([['country', $country], ['code', trim($request->ref_number)], ['price_type', 1], ['status', 1]])->first();
            if (empty($pricing)) {
                session()->forget('validPrices');
                $message = ['ref_number' => transMsg('Reference code does not exists.')];
                toast(transMsg('Reference code does not exists.'), 'warning')->timerProgressBar();
                return redirect()->back()->withErrors($message)->withInput();
            }
        } else {
            $pricing = Pricing::where([['country', $country], ['status', 4]])->first();
        }

        if (!empty($request->agentcode)) {
            $agents = User::where([['nationality', $country], ['student_code', trim($request->agentcode)], ['role', 'agent'], ['active', 1]])->first();
            if (empty($agents)) {
                session()->put('validPrices', $pricing);
                $message = ['agentcode' => transMsg('Agent number does not exists.')];
                toast(transMsg('Agent number does not exists.'), 'warning')->timerProgressBar();
                return redirect()->back()->withErrors($message)->withInput();
            } else {
                session()->forget('validPrices');
            }
            $shareOf = getAgentByCode($request->agentcode)->agent->shareOf;
        } else {
            session()->forget('validPrices');
        }

        $total = $pricing->price / (1 - 0.025);
        $amount = round($total, 2);
        $tran_fee = round($total, 2) - $pricing->price;

        $post_data = array();
        $post_data['total_amount'] = $amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = generateTransID(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = session('step1')['name'];
        $post_data['cus_email'] = session('step1')['email'];
        $post_data['cus_add1'] = session('step2')['address'] ?? 'ICPL';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = session('step2')['phone_number'] ?? '+8801554320637';

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = session('step1')['name'];
        $post_data['ship_add1'] = 'Ipsita Computers Pte Ltd.';
        $post_data['ship_city'] = "25/A, 7th Floor, Green Road, Dhaka-1205";
        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "ICPL Academy";
        $post_data['product_category'] = "Registration";
        $post_data['product_profile'] = "Foqas Academy";
        # OPTIONAL PARAMETERS
        $post_data['value_a'] = $request->ref_number;
        $post_data['value_b'] = $request->agentcode;
        $post_data['value_c'] = $pricing->subsMonth;
        $post_data['value_d'] = $pricing->perStudent ?? 5;

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $school_payment = SchoolPayment::firstOrCreate(['trans_id' => $post_data['tran_id']]);
        $school_payment->trans_number = 'FA' . time();
        $school_payment->trans_id = $post_data['tran_id'];
        $school_payment->trans_type = 2;
        $school_payment->amount = $pricing->price;
        $school_payment->stripe_fee = $tran_fee;
        $school_payment->trans_status = 'Pending';
        $school_payment->purpose_id = 1;
        $school_payment->currency = 'bdt';
        $school_payment->month = $pricing->subsMonth;
        $school_payment->ref_number = trim($request->ref_number);
        $school_payment->agentcode = trim($request->agentcode);
        $school_payment->shareOf = $shareOf;
        $school_payment->save();

        $sslc = new SslCommerzNotification();

        $payment_options = $sslc->makePayment($post_data, 'hosted');
        return $payment_options;
        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = $request->ref_number;
        $post_data['value_b'] = $request->agentcode;

        #Before  going to initiate the payment order status need to update as Pending.
        /*  $update_product = DB::table('orders')
              ->where('transaction_id', $post_data['tran_id'])
              ->updateOrInsert([
                  'name' => $post_data['cus_name'],
                  'email' => $post_data['cus_email'],
                  'phone' => $post_data['cus_phone'],
                  'amount' => $post_data['total_amount'],
                  'status' => 'Pending',
                  'address' => $post_data['cus_add1'],
                  'transaction_id' => $post_data['tran_id'],
                  'currency' => $post_data['currency']
              ]);*/

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        //Transaction is Successful 
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $store_amount = $request->input('store_amount');
        $currency = $request->input('currency');
        $card_type = $request->input('card_type');
        $tran_date = $request->input('tran_date');
        $agentcode = $request->input('value_b');
        $perStudent = $request->input('value_d');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $emailScPayment['scPayment'] = $school_payment = SchoolPayment::where('trans_id', $tran_id)->first();

        $month = $school_payment->month;
        $rangeParse = \Carbon\Carbon::parse($tran_date);
        $rangedate = $rangeParse->addMonths($month);
        $rangeTo = date('Y-m-d H:i:s', strtotime($rangedate));

        /*date give in school table, update school_payment and save in subscription table*/

        if ($school_payment->trans_status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                //return $validation;
                $name = session('step1')['name'];
                $email = session('step1')['email'];
                $established = session('step2')['established'];
                $address = session('step2')['address'];
                $country_id = getCountryByCode(session('step1')['nationality'])['id'];
                $district_id = session('step2')['district_id'];

                $schoolData['name'] = $name;
                $schoolData['established'] = $established;
                $schoolData['address'] = $address;
                $schoolData['country_id'] = $country_id;
                $schoolData['district_id'] = $district_id;
                $schoolData['agentcode'] = $agentcode;
                $schoolData['activeTill'] = $rangeTo;
                $schoolData['perStudent'] = $perStudent;
                $school = (new School())->createNew($schoolData);

                Setting::createNew($school->id);

                (new Menu())->insertMenusFirst($school->id);

                $userData['name'] = getShortName($name);
                $userData['email'] = $email;
                $userData['password'] = session('step1')['password'];
                $userData['school_id'] = $school->id;
                $userData['code'] = $school->code;
                $userData['phone_number'] = session('step1')['phone_number'];
                $userData['nationality'] = getCountryByCode(session('step1')['nationality'])['name'];
                $user = (new User())->newUserAdmin($userData);

                $school_payment->school_id = $school->id;
                $school_payment->user_id = $user->id;
                $school_payment->amount = $store_amount;
                $school_payment->card_type = $card_type;
                $school_payment->trans_date = $tran_date;
                $school_payment->month = $month;
                $school_payment->rangeFrom = $tran_date;
                $school_payment->rangeTo = $rangeTo;
                $school_payment->trans_status = 'Paid';
                $school_payment->save();

                $subscription = new Subscription();
                $subscription->user_id = $user->id;
                $subscription->school_id = $school->id;
                $subscription->school_payment_id = $school_payment->id;
                $subscription->month = $month;
                $subscription->price = $store_amount;
                $subscription->rangeFrom = $tran_date;
                $subscription->rangeTo = $rangeTo;
                $subscription->save();

                $completed = array('school' => $name, 'email' => $email, 'password' => session('step1')['password'], 'sp_id' => $school_payment->id, 'sc_code' => $school->code);
                session()->put('completed', $completed);

                //Registration confirm email
                Mail::send('email.user.regconfirm', $emailScPayment, function ($message) use ($email, $name) {
                    $message->from(config('mail.from.address'), school('name'));
                    $message->to($email, $name)->subject('School Registration Confirmation');
                });

                session()->forget('step1');
                session()->forget('step2');

                toast(transMsg('Your payment & registration completed!'), 'success')->timerProgressBar();
                return redirect()->route('payment.register');
            } else {
                $school_payment->trans_status = 'Failed';
                $school_payment->save();
                toast(transMsg('Validation Failed!'), 'warning')->timerProgressBar();
                return redirect()->route('payment.info');
            }
        } else if ($school_payment->trans_status == 'Paid') {
            toast(transMsg('Your payment & registration completed!'), 'success')->timerProgressBar();
            return redirect()->route('payment.register');
        } else {
            toast(transMsg('Invalid Transaction!'), 'warning')->timerProgressBar();
            return redirect()->route('payment.info');
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $school_payment = SchoolPayment::where('trans_id', $tran_id)->first();

        if ($school_payment->trans_status == 'Pending') {
            $school_payment->trans_status = 'Failed';
            $school_payment->save();
            toast(transMsg('Validation Failed!'), 'warning')->timerProgressBar();
            return redirect()->route('payment.info');
        } else if ($school_payment->trans_status == 'Paid') {
            toast(transMsg('Your payment & registration completed!'), 'success')->timerProgressBar();
            return redirect()->route('payment.register');
        } else {
            toast(transMsg('Invalid Transaction!'), 'warning')->timerProgressBar();
            return redirect()->route('payment.info');
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $school_payment = SchoolPayment::where('trans_id', $tran_id)->first();

        if ($school_payment->trans_status == 'Pending') {
            $school_payment->trans_status = 'Canceled';
            $school_payment->save();
            toast(transMsg('Transaction is Cancel!'), 'warning')->timerProgressBar();
            return redirect()->route('payment.info');
        } else if ($school_payment->trans_status == 'Paid') {
            toast(transMsg('Your payment & registration completed!'), 'success')->timerProgressBar();
            return redirect()->route('payment.register');
        } else {
            toast(transMsg('Invalid Transaction!'), 'warning')->timerProgressBar();
            return redirect()->route('payment.info');
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'trans_status', 'currency', 'amount')->first();

            if ($order_details->trans_status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($tran_id, $order_details->amount, $order_details->currency, $request->all());
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['trans_status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['trans_status' => 'Failed']);

                    echo "validation Fail";
                }

            } else if ($order_details->trans_status == 'Processing' || $order_details->trans_status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
