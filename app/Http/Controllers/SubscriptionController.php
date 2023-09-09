<?php

namespace App\Http\Controllers;

use App\Pricing;
use App\User;
use App\SchoolPayment;
use App\Subscription;
use App\School;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    protected function clearSSLSession()
    {
        session()->forget('SSL_SUCCESS_URL');
        session()->forget('SSL_FAIL_URL');
        session()->forget('SSL_CANCEL_URL');
    }

    public function renewNow($scode, $pcode)
    {
        $user = User::whereCode($scode)->where('isSuper', 1)->first();
        $pricing = Pricing::whereCode($pcode)->first();
        $shareOf = $percentTk = $pStatus = 0;
        if ($user && $pricing) {

            if (!empty($user->school->agentcode)) {
                $shareOf = getAgentByCode($user->school->agentcode)->agent->shareOf;
            }
            $total_chage = $pricing->price;
            if (request()->isMethod('post')) {
                if (request()->mypercent == 1) {
                    $percent = $shareOf / 100;
                    $percents = $pricing->price * $percent;
                    $percentTk = round($percents, 2);
                    $total_chage = $pricing->price - $percentTk;
                } elseif (!empty(request()->mypercent) && request()->mypercent != 1) {
                    toast(transMsg('If you want to pay without your percentage, Please checked the box.'), 'error')->timerProgressBar();
                    return redirect()->back()->with('checked', true);
                }
            }

            if ($pricing->country == 'Bangladesh') {
                session([
                    'SSL_SUCCESS_URL' => 'rewnew_subs/success',
                    'SSL_FAIL_URL' => 'rewnew_subs/fail',
                    'SSL_CANCEL_URL' => 'rewnew_subs/cancel',
                ]);
                $total = $total_chage / (1 - 0.025);
                $amount = round($total, 2);
                $tran_fee = round($total, 2) - $total_chage;
                $post_data = array();
                $post_data['total_amount'] = $amount; # You cant not pay less than 10
                $post_data['currency'] = "BDT";
                $post_data['tran_id'] = generateTransID(); // tran_id must be unique

                # CUSTOMER INFORMATION
                $post_data['cus_name'] = $user->school->name;
                $post_data['cus_email'] = $user->email;
                $post_data['cus_add1'] = $user->address ?? 'ICPL';
                $post_data['cus_add2'] = "";
                $post_data['cus_city'] = "";
                $post_data['cus_state'] = "";
                $post_data['cus_postcode'] = "";
                $post_data['cus_country'] = "Bangladesh";
                $post_data['cus_phone'] = $user->phone_number ?? '+8801554320637';

                # SHIPMENT INFORMATION
                $post_data['ship_name'] = $user->school->name;
                $post_data['ship_add1'] = 'Ipsita Computers Pte Ltd.';
                $post_data['ship_city'] = "25/A, 7th Floor, Green Road, Dhaka-1205";
                $post_data['shipping_method'] = "NO";
                $post_data['product_name'] = "ICPL Academy";
                $post_data['product_category'] = "Renew Subscription";
                $post_data['product_profile'] = "Foqas Academy";
                # OPTIONAL PARAMETERS
                $post_data['value_a'] = $user->code;
                $post_data['value_b'] = $user->school->agentcode;
                $post_data['value_c'] = $pricing->subsMonth;

                #Before  going to initiate the payment order status need to insert or update as Pending.
                $school_payment = SchoolPayment::firstOrCreate(['trans_id' => $post_data['tran_id']]);
                $school_payment->school_id = $user->school_id;
                $school_payment->user_id = $user->id;
                $school_payment->trans_number = 'FA' . time();
                $school_payment->trans_id = $post_data['tran_id'];
                $school_payment->trans_date = date('Y-m-d H:i:s', strtotime(now()));
                $school_payment->trans_type = 2;
                $school_payment->amount = $pricing->price;
                $school_payment->stripe_fee = $tran_fee;
                $school_payment->trans_status = 'Pending';
                $school_payment->purpose_id = 3;
                $school_payment->currency = 'bdt';
                $school_payment->month = $pricing->subsMonth;
                $school_payment->ref_number = $pricing->code;
                $school_payment->agentcode = $user->school->agentcode;
                $school_payment->shareOf = $shareOf;
                $school_payment->percentTk = $percentTk;
                if (auth()->user()->role == 'agent') {
                    $school_payment->transBy = 'Agent';
                }
                $school_payment->save();

                $sslc = new SslCommerzNotification();

                $payment_options = $sslc->makePayment($post_data, 'hosted');
                return $payment_options;

            } else {
                toast(transMsg('You are not able to renew your subscription.'), 'error')->timerProgressBar();
                return redirect()->back();
            }
        } else {
            toast(transMsg('Something went wrong, Try again!'), 'success')->timerProgressBar();
            return back();
        }
    }

    public function renewNowCheckout($scode, $pcode)
    {
        $user = User::whereCode($scode)->where('isSuper', 1)->first();
        $pricing = Pricing::whereCode($pcode)->first();
        $shareOf = $percentTk = $pStatus = 0;

        if ($user && $pricing) {
            if (!empty($user->school->agentcode)) {
                $shareOf = getAgentByCode($user->school->agentcode)->agent->shareOf;
            }
            $total_chage = $pricing->price;
            if (request()->mypercent == 1) {
                $percent = $shareOf / 100;
                $percents = $pricing->price * $percent;
                $percentTk = round($percents, 2);
                $total_chage = $pricing->price - $percentTk;
            } elseif (!empty(request()->mypercent) && request()->mypercent != 1) {
                toast(transMsg('If you want to pay without your percentage, Please checked the box.'), 'error')->timerProgressBar();
                return redirect()->back()->with('checked', true);
            }


            if ($pricing->country == 'Bangladesh') {
                toast(transMsg('You are not able to renew your subscription.'), 'error')->timerProgressBar();
                return redirect()->back();
            } else {
                $token = $_REQUEST['stripeToken'];
                $email = $_REQUEST['stripeEmail'];

                if (empty($token)) {
                    toast(transMsg('Stripe Token required'), 'error')->timerProgressBar();
                    return redirect()->back();
                }

                \Stripe\Stripe::setApiKey(stripe_apiKey());

                //Passing the Stripe fee on to customers
                $total = ($total_chage + 0.30) / (1 - 0.029);
                $amount = round($total, 2) * 100;
                $stripe_fee = round($total, 2) - $total_chage;

                try {
                    $charge = \Stripe\Charge::create([
                        'amount' => $amount,
                        'currency' => 'usd',
                        'description' => $user->school->name . ' (' . $user->email . ')',
                        'source' => $token,
                    ]);

                    $status = $charge->status;
                    $charge_id = $charge->id;
                    $transaction_id = $charge->balance_transaction;
                    $tran_date = $created = $charge->created;
                    $currency = $charge->currency;

                    if (strtotime(now()) < strtotime($user->school->activeTill)) {
                        $tran_date = $user->school->activeTill;
                    }
                    $rangeParse = \Carbon\Carbon::parse($tran_date);
                    $rangedate = $rangeParse->addMonths($pricing->subsMonth);

                    $rangeTo = date('Y-m-d H:i:s', strtotime($rangedate));

                    if (!empty($user->school->agentcode)) {
                        $agentData = getAgentByCode($user->school->agentcode);
                    } else {
                        $agentData = null;
                    }

                    if ($status == 'succeeded') {
                        $emailScPayment['scPayment'] = $school_payment = SchoolPayment::firstOrCreate(['trans_id' => $transaction_id]);

                        $school_payment->school_id = $user->school_id;
                        $school_payment->user_id = $user->id;
                        $school_payment->trans_number = 'FA' . time();
                        $school_payment->stripe_charge = $charge_id;
                        $school_payment->trans_id = $transaction_id;
                        $school_payment->trans_type = 1;
                        $school_payment->amount = $pricing->price;
                        $school_payment->stripe_fee = $stripe_fee;
                        $school_payment->trans_status = 'Paid';
                        $school_payment->purpose_id = 3;
                        $school_payment->currency = $currency;
                        $school_payment->month = $pricing->subsMonth;
                        $school_payment->ref_number = $pricing->code;
                        $school_payment->agentcode = $user->school->agentcode;
                        $school_payment->trans_date = date('Y-m-d H:i:s', $created);
                        $school_payment->rangeFrom = date('Y-m-d H:i:s', strtotime($tran_date));
                        $school_payment->rangeTo = $rangeTo;
                        $school_payment->shareOf = $shareOf;
                        $school_payment->percentTk = $percentTk;

                        if (request()->mypercent == 1) {
                            $school_payment->pStatus = 1;
                            $school_payment->tranCheque = 'AP' . time();
                            $school_payment->sNote = 'Agent keep his/her percentage and pay to us!';
                        }

                        if (auth()->user()->role == 'agent') {
                            $school_payment->transBy = 'Agent';
                        }

                        $school_payment->save();

                        $subscription = new Subscription();
                        $subscription->user_id = $user->id;
                        $subscription->school_id = $user->school_id;
                        $subscription->school_payment_id = $school_payment->id;
                        $subscription->month = $pricing->subsMonth;
                        $subscription->price = $pricing->price;
                        $subscription->rangeFrom = date('Y-m-d H:i:s', strtotime($tran_date));
                        $subscription->rangeTo = $rangeTo;
                        $subscription->save();

                        $schoolupdate = School::find($user->school_id);
                        $schoolupdate->activeTill = $rangeTo;
                        $schoolupdate->save();

                        //Registration confirm email
                        Mail::send('email.user.renew', $emailScPayment, function ($message) use ($user, $agentData) {
                            $message->from(config('mail.from.address'), faAcademy()->name);
                            $message->to($user->email, $user->school->short_name)->subject('Renew Subscription');
                            if (!empty($agentData)) {
                                $message->bcc($agentData->email, $agentData->name)->subject('Renew Subscription');
                            }
                        });

                        toast(transMsg('Subscription renewed successfully completed!'), 'success')->timerProgressBar();

                        if (auth()->user()->role == 'agent') {
                            return redirect()->route('school.payments.subscriptionlist', $scode);
                        }
                        return redirect()->route('school.subscription');
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
        } else {
            toast(transMsg('Something went wrong, Try again!'), 'success')->timerProgressBar();
            return back();
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
        $tran_date = $tran_create = $request->input('tran_date');
        $agentcode = $request->input('value_b');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $emailScPayment['scPayment'] = $school_payment = SchoolPayment::where('trans_id', $tran_id)->first();

        $user_id = $school_payment->user_id;
        $users = User::find($user_id);

        $school_id = $school_payment->school_id;
        $month = $school_payment->month;

        if (strtotime(now()) < strtotime($users->school->activeTill)) {
            $tran_date = $users->school->activeTill;
        }

        $rangeParse = \Carbon\Carbon::parse($tran_date);
        $rangedate = $rangeParse->addMonths($month);

        $rangeTo = date('Y-m-d H:i:s', strtotime($rangedate));

        if (!empty($school_payment->agentcode)) {
            $agentData = getAgentByCode($school_payment->agentcode);
        } else {
            $agentData = null;
        }

        if ($school_payment->trans_status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                $school_payment->amount = $store_amount;
                $school_payment->card_type = $card_type;
                $school_payment->trans_date = $tran_create;
                $school_payment->month = $month;
                $school_payment->rangeFrom = $tran_date;
                $school_payment->rangeTo = $rangeTo;
                $school_payment->trans_status = 'Paid';

                if (!empty($school_payment->percentTk)) {
                    $school_payment->pStatus = 1;
                    $school_payment->tranCheque = 'AP' . time();
                    $school_payment->sNote = 'Agent keep his/her percentage and pay to us!';
                }

                $school_payment->save();

                $subscription = new Subscription();
                $subscription->user_id = $user_id;
                $subscription->school_id = $school_id;
                $subscription->school_payment_id = $school_payment->id;
                $subscription->month = $month;
                $subscription->price = $store_amount;
                $subscription->rangeFrom = $tran_date;
                $subscription->rangeTo = $rangeTo;
                $subscription->save();

                $schoolupdate = School::find($school_id);
                $schoolupdate->activeTill = $rangeTo;
                $schoolupdate->status = 1; // active
                $schoolupdate->save();

                //Registration confirm email
                Mail::send('email.user.renew', $emailScPayment, function ($message) use ($users, $agentData) {
                    $message->from(config('mail.from.address'), faAcademy()->name);
                    $message->to($users->email, $users->school->short_name)->subject('Renew Subscription');
                    if (!empty($agentData)) {
                        $message->bcc($agentData->email, $agentData->name)->subject('Renew Subscription');
                    }
                });

                $this->clearSSLSession();
                session()->forget('school_expired');
                toast(transMsg('Subscription renewed successfully completed!'), 'success')->timerProgressBar();
                if (auth()->user()->role == 'agent') {
                    return redirect()->route('school.payments.subscriptionlist', $school_payment->school->code);
                }
                return redirect()->route('school.subscription');
            } else {
                $school_payment->trans_status = 'Failed';
                $school_payment->save();
                toast(transMsg('Validation Failed!'), 'warning')->timerProgressBar();
                if (auth()->user()->role == 'agent') {
                    return redirect()->route('school.payments.subscriptionplan', $school_payment->school->code);
                }
                return redirect()->route('school.subscription.plans');
            }
        } else if ($school_payment->trans_status == 'Paid') {
            toast(transMsg('Subscription renewed successfully completed!'), 'success')->timerProgressBar();
            if (auth()->user()->role == 'agent') {
                return redirect()->route('school.payments.subscriptionlist', $school_payment->school->code);
            }
            return redirect()->route('school.subscription');
        } else {
            toast(transMsg('Invalid Transaction!'), 'warning')->timerProgressBar();
            if (auth()->user()->role == 'agent') {
                return redirect()->route('school.payments.subscriptionplan', $school_payment->school->code);
            }
            return redirect()->route('school.subscription.plans');
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $user_code = $request->input('value_a');

        $school_payment = SchoolPayment::where('trans_id', $tran_id)->first();
        $school_payment->trans_status = 'Failed';
        $school_payment->save();

        toast(transMsg('Subscription renewal failed!'), 'warning')->timerProgressBar();
        if (auth()->user()->role == 'agent') {
            return redirect()->route('school.payments.subscriptionplan', $user_code);
        }
        return redirect()->route('school.subscription.plans');
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $user_code = $request->input('value_a');

        SchoolPayment::where('trans_id', $tran_id)->delete();

        toast(transMsg('Subscription renewed canceled!'), 'warning')->timerProgressBar();
        if (auth()->user()->role == 'agent') {
            return redirect()->route('school.payments.subscriptionplan', $user_code);
        }
        return redirect()->route('school.subscription.plans');
    }
}
