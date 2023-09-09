<?php

namespace App\Http\Controllers;

use App\SchoolPayment;
use App\School;
use App\Subscription;
use App\Pricing;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Mail;

class SchoolPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['receiveds'] = SchoolPayment::where('trans_status', 'Paid')->orderByRaw("trans_date DESC,purpose_id ASC")->get();
        return view('schoolpayment.index', $data);
    }

    public function indexPaymentsUnpaid()
    {
        $data['receiveds'] = SchoolPayment::where('trans_status', 'Pending')->orderByRaw("trans_date DESC,purpose_id ASC")->get();
        return view('schoolpayment.index-unpaid', $data);
    }

    public function indexPaymentsFailed()
    {
        $data['receiveds'] = SchoolPayment::where('trans_status', 'Failed')->orderByRaw("trans_date DESC,purpose_id ASC")->get();
        return view('schoolpayment.index-failed', $data);
    }

    public function indexList($code)
    {
        $data['schools'] = $schools = School::whereCode($code)->first();
        $data['rangemonth'] = 5;

        if (auth()->user()->role == 'agent' && auth()->user()->student_code != $schools->agentcode) {
            toast(transMsg('You are not able to access.'), 'error')->timerProgressBar();
            return redirect()->back();
        }

        if ($schools) {
            $data['receiveds'] = SchoolPayment::where('school_id', $schools->id)->orderByRaw("trans_date DESC,purpose_id ASC")->get();
            return view('schoolpayment.indexlist', $data);
        } else {
            toast(transMsg('You are not able to access.'), 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function subscriptionList($code)
    {
        $data['schools'] = $schools = School::whereCode($code)->first();

        if (auth()->user()->role == 'agent' && auth()->user()->student_code != $schools->agentcode) {
            toast(transMsg('You are not able to access.'), 'error')->timerProgressBar();
            return redirect()->back();
        }
        //return $schools->activeTill;
        if ($schools) {
            $data['subscriptions'] = Subscription::where('school_id', $schools->id)->orderBy('rangeTo', 'desc')->get();
            return view('schoolpayment.subscriptionlist', $data);
        } else {
            toast(transMsg('You are not able to access.'), 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function subscriptionPlan($code)
    {
        $data['schools'] = $schools = School::whereCode($code)->first();

        if (auth()->user()->role == 'agent' && auth()->user()->student_code != $schools->agentcode) {
            toast(transMsg('You are not able to access.'), 'error')->timerProgressBar();
            return redirect()->back();
        }

        if ($schools) {
            $country = $schools->country->name;
            $data['pricings'] = Pricing::where([['country', $country], ['status', 1], ['price_type', 3]])->orderByRaw("title ASC,price ASC")->get();
            return view('schoolpayment.subscriptionplan', $data);
        } else {
            toast(transMsg('You are not able to access.'), 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function subscriptionPlandetails($scode, $pcode)
    {
        $data['schools'] = $schools = School::whereCode($scode)->first();

        if (auth()->user()->role == 'agent' && auth()->user()->student_code != $schools->agentcode) {
            toast(transMsg('You are not able to access.'), 'error')->timerProgressBar();
            return redirect()->back();
        }

        if ($schools) {
            $country = $schools->country->name;
            $data['pricing'] = Pricing::whereCode($pcode)->where([['country', $country], ['status', 1], ['price_type', 3]])->first();

            return view('schoolpayment.plandetails', $data);
        } else {
            toast(transMsg('You are not able to access.'), 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function makePaymentSchool()
    {
        $data['schools'] = School::whereCode(auth()->user()->code)->first();
        return view('schoolpayment.make_payment_school', $data);
    }

    public function makePaymentFa($code)
    {
        $data['schools'] = $schools = School::whereCode($code)->first();
        if ($schools) {
            return view('schoolpayment.make_payment_fa', $data);
        } else {
            toast(transMsg('Something went wrong, try again!'), 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function makePaymentAgent($code)
    {
        $data['schools'] = $schools = School::whereCode($code)->first();
        if ($schools && auth()->user()->student_code == $schools->agentcode) {
            return view('schoolpayment.make_payment_agent', $data);
        } else {
            toast(transMsg('Something went wrong, try again!'), 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    protected function clearSSLSession()
    {
        session()->forget('SSL_SUCCESS_URL');
        session()->forget('SSL_FAIL_URL');
        session()->forget('SSL_CANCEL_URL');
    }

    public function serviceCharge($scode)
    {
        $user = User::whereCode($scode)->where('isSuper', 1)->first();
        $shareOf = $percentTk = $pStatus = 0;

        if ($user) {

            if (auth()->user()->role == 'admin' && auth()->user()->code != $scode) {
                toast(transMsg('Invalid request, Please try again!'), 'warning')->timerProgressBar();
                return redirect()->back();
            }
            if (auth()->user()->role == 'agent' && auth()->user()->student_code != $user->school->agentcode) {
                toast(transMsg('Invalid request, Please try again!'), 'warning')->timerProgressBar();
                return redirect()->back();
            }

            if (!empty($user->school->agentcode)) {
                $shareOf = getAgentByCode($user->school->agentcode)->agent->shareOf;
            }

            if (request()->isMethod('post')) {
                if (empty(request()->month_of)) {
                    toast(transMsg('Please select the month of range for service charge and try again!'), 'warning')->timerProgressBar();
                    return redirect()->back();
                }
                $month = request()->month_of;
                if (!empty($user->school->lastCharged)) {
                    $rangeFrom = date('Y-m-01 H:i:s', strtotime('+1 month', strtotime($user->school->lastCharged)));
                    $rangeTo = date('Y-m-28 H:i:s', strtotime('+' . $month . ' month', strtotime($user->school->lastCharged)));
                } else {
                    $createday = date('d', strtotime($user->school->created_at));
                    $createdmy = strtotime($user->school->created_at);
                    if ($createday >= 16) {
                        if ($createday > 28) {
                            $lastCharged = date('Y-m-d H:i:s', strtotime('-3 day', $createdmy));
                        } else {
                            $lastCharged = date('Y-m-d H:i:s', strtotime($user->school->created_at));
                        }
                    } else {
                        $lastCharged = date('Y-m-d H:i:s', strtotime('-1 month', $createdmy));
                    }
                    $rangeFrom = date('Y-m-01 H:i:s', strtotime('+1 month', strtotime($lastCharged)));
                    $rangeTo = date('Y-m-28 H:i:s', strtotime('+' . $month . ' month', strtotime($lastCharged)));
                }

                $totla_stdnt = total_student_current_school();
                $per_stdnt = $user->school->perStudent;
                $total_amount = ($totla_stdnt * $per_stdnt) * $month;
                $total_chage = $amount = round($total_amount, 2);

                //For agent
                if (request()->mypercent == 1) {
                    $percent = $shareOf / 100;
                    $percents = $amount * $percent;
                    $percentTk = round($percents, 2);
                    $total_chage = $amount - $percentTk;
                } elseif (!empty(request()->mypercent) && request()->mypercent != 1) {
                    toast(transMsg('If you want to pay without your percentage, Please checked the box.'), 'error')->timerProgressBar();
                    return redirect()->back()->with('checked', true);
                }
            }


            if ($user->school->country->code == 'BD') {
                session([
                    'SSL_SUCCESS_URL' => 'service_charge/success',
                    'SSL_FAIL_URL' => 'service_charge/fail',
                    'SSL_CANCEL_URL' => 'service_charge/cancel',
                ]);

                $total = $total_chage / (1 - 0.025);
                $pay_amount = round($total, 2);
                $tran_fee = round($total, 2) - $total_chage;
                $post_data = array();
                $post_data['total_amount'] = $pay_amount; # You cant not pay less than 10
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
                $post_data['product_category'] = "School Service Charge";
                $post_data['product_profile'] = "Foqas Academy";
                # OPTIONAL PARAMETERS
                $post_data['value_a'] = $user->code;
                $post_data['value_b'] = $user->school->agentcode;
                $post_data['value_c'] = $month;

                #Before  going to initiate the payment order status need to insert or update as Pending.
                $school_payment = SchoolPayment::firstOrCreate(['trans_id' => $post_data['tran_id']]);
                $school_payment->school_id = $user->school_id;
                $school_payment->user_id = $user->id;
                $school_payment->trans_number = 'FA' . time();
                $school_payment->trans_id = $post_data['tran_id'];
                $school_payment->trans_date = date('Y-m-d H:i:s', strtotime(now()));
                $school_payment->trans_type = 2;
                $school_payment->amount = $amount;
                $school_payment->stripe_fee = $tran_fee;
                $school_payment->trans_status = 'Pending';
                $school_payment->purpose_id = 2;
                $school_payment->currency = 'bdt';
                $school_payment->month = $month;
                $school_payment->agentcode = $user->school->agentcode;
                $school_payment->rangeFrom = $rangeFrom;
                $school_payment->rangeTo = $rangeTo;
                $school_payment->shareOf = $shareOf;
                $school_payment->percentTk = $percentTk;
                if (auth()->user()->role == 'agent') {
                    $school_payment->transBy = 'Agent';
                } elseif (auth()->user()->role == 'master') {
                    $school_payment->transBy = 'FA';
                }
                $school_payment->save();
                session()->put('fa_academy_payment', true);
                $sslc = new SslCommerzNotification();
                $payment_options = $sslc->makePayment($post_data, 'hosted');
                return $payment_options;

            } else {
                toast(transMsg('You are not able to pay service charge.'), 'error')->timerProgressBar();
                return redirect()->back();
            }
        } else {
            toast(transMsg('Something went wrong, Try again!'), 'success')->timerProgressBar();
            return back();
        }
    }

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $card_type = $request->input('card_type');
        $tran_create = $request->input('tran_date');
        $agentcode = $request->input('value_b');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $emailScPayment['scPayment'] = $school_payment = SchoolPayment::where('trans_id', $tran_id)->first();
        $users = $school_payment->user;
        $school_id = $school_payment->school_id;
        $transBy = $school_payment->transBy;

        if (!empty($school_payment->agentcode)) {
            $agentData = getAgentByCode($school_payment->agentcode);
        } else {
            $agentData = null;
        }

        if ($school_payment->trans_status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                $school_payment->card_type = $card_type;
                $school_payment->trans_date = $tran_create;
                $school_payment->trans_status = 'Paid';

                if (!empty($school_payment->percentTk)) {
                    $school_payment->pStatus = 1;
                    $school_payment->tranCheque = 'AP' . time();
                    $school_payment->sNote = 'Agent keep his/her percentage and pay to us!';
                }

                $school_payment->save();

                $schoolupdate = School::find($school_id);
                $schoolupdate->lastCharged = $school_payment->rangeTo;
                $schoolupdate->save();

                //Service Charge confirm email 
                Mail::send('email.user.service', $emailScPayment, function ($message) use ($users, $agentData, $transBy) {
                    $message->from(config('mail.from.address'), faAcademy()->name);
                    $message->to($users->email, $users->school->short_name)->subject('Paid Service Charge');
                    if (!empty($agentData) && $transBy != 'Agent') {
                        $message->bcc($agentData->email, $agentData->name)->subject('School Service Charge');
                    }
                });

                $this->clearSSLSession();

                toast(transMsg('Service charge successfully paid!'), 'success')->timerProgressBar();
                if ($transBy == 'Agent') {
                    return redirect()->route('school.make.payment.agent', $school_payment->school->code);
                } elseif ($transBy == 'FA') {
                    return redirect()->route('school.make.payment.fa', $school_payment->school->code);
                }
                return redirect()->route('make.payment.school');
            } else {
                $school_payment->trans_status = 'Failed';
                $school_payment->save();
                toast(transMsg('Validation Failed!'), 'warning')->timerProgressBar();
                if ($transBy == 'Agent') {
                    return redirect()->route('school.make.payment.agent', $school_payment->school->code);
                } elseif ($transBy == 'FA') {
                    return redirect()->route('school.make.payment.fa', $school_payment->school->code);
                }
                return redirect()->route('make.payment.school');
            }
        } else if ($school_payment->trans_status == 'Paid') {
            toast(transMsg('Service charge successfully paid!'), 'success')->timerProgressBar();
            if ($transBy == 'Agent') {
                return redirect()->route('school.make.payment.agent', $school_payment->school->code);
            } elseif ($transBy == 'FA') {
                return redirect()->route('school.make.payment.fa', $school_payment->school->code);
            }
            return redirect()->route('make.payment.school');
        } else {
            toast(transMsg('Invalid Transaction!'), 'warning')->timerProgressBar();
            if ($transBy == 'Agent') {
                return redirect()->route('school.payments.subscriptionplan', $school_payment->school->code);
            } elseif ($transBy == 'FA') {
                return redirect()->route('school.make.payment.fa', $school_payment->school->code);
            }
            return redirect()->route('make.payment.school');
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $user_code = $request->input('value_a');

        $school_payment = SchoolPayment::where('trans_id', $tran_id)->first();
        $school_payment->trans_status = 'Failed';
        $school_payment->save();

        toast(transMsg('Service Charge payment failed!'), 'warning')->timerProgressBar();
        if ($school_payment->transBy == 'Agent') {
            return redirect()->route('school.make.payment.agent', $user_code);
        } elseif ($school_payment->transBy == 'FA') {
            return redirect()->route('school.make.payment.fa', $user_code);
        }
        return redirect()->route('make.payment.school');
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $user_code = $request->input('value_a');

        SchoolPayment::where('trans_id', $tran_id)->delete();

        toast(transMsg('Service Charge payment canceled!'), 'warning')->timerProgressBar();

        if (auth()->user()->role == 'agent') {
            return redirect()->route('school.make.payment.agent', $user_code);
        } elseif (auth()->user()->role == 'master') {
            return redirect()->route('school.make.payment.fa', $user_code);
        }
        return redirect()->route('make.payment.school');
    }

    public function servicesCharge($scode)
    {
        $user = User::whereCode($scode)->where('isSuper', 1)->first();
        $shareOf = $percentTk = $pStatus = 0;

        if ($user) {

            if (auth()->user()->role == 'admin' && auth()->user()->code != $scode) {
                toast(transMsg('Invalid request, Please try again!'), 'warning')->timerProgressBar();
                return redirect()->back();
            }
            if (auth()->user()->role == 'agent' && auth()->user()->student_code != $user->school->agentcode) {
                toast(transMsg('Invalid request, Please try again!'), 'warning')->timerProgressBar();
                return redirect()->back();
            }

            if (!empty($user->school->agentcode)) {
                $shareOf = getAgentByCode($user->school->agentcode)->agent->shareOf;
            }

            if (empty(request()->month_of)) {
                toast(transMsg('Please select the month of range for service charge and try again!'), 'warning')->timerProgressBar();
                return redirect()->back();
            }
            $month = request()->month_of;
            if (!empty($user->school->lastCharged)) {
                $rangeFrom = date('Y-m-01 H:i:s', strtotime('+1 month', strtotime($user->school->lastCharged)));
                $rangeTo = date('Y-m-28 H:i:s', strtotime('+' . $month . ' month', strtotime($user->school->lastCharged)));
            } else {
                $createday = date('d', strtotime($user->school->created_at));
                $createdmy = strtotime($user->school->created_at);
                if ($createday >= 16) {
                    if ($createday > 28) {
                        $lastCharged = date('Y-m-d H:i:s', strtotime('-3 day', $createdmy));
                    } else {
                        $lastCharged = date('Y-m-d H:i:s', strtotime($user->school->created_at));
                    }
                } else {
                    $lastCharged = date('Y-m-d H:i:s', strtotime('-1 month', $createdmy));
                }
                $rangeFrom = date('Y-m-01 H:i:s', strtotime('+1 month', strtotime($lastCharged)));
                $rangeTo = date('Y-m-28 H:i:s', strtotime('+' . $month . ' month', strtotime($lastCharged)));
            }

            $totla_stdnt = total_student_current_school();
            $per_stdnt = $user->school->perStudent;
            $total_amount = ($totla_stdnt * $per_stdnt) * $month;
            $total_chage = $amount = round($total_amount, 2);

            //For agent
            if (request()->mypercent == 1) {
                $percent = $shareOf / 100;
                $percents = $amount * $percent;
                $percentTk = round($percents, 2);
                $total_chage = $amount - $percentTk;
            } elseif (!empty(request()->mypercent) && request()->mypercent != 1) {
                toast(transMsg('If you want to pay without your percentage, Please checked the box.'), 'error')->timerProgressBar();
                return redirect()->back()->with('checked', true);
            }

            if ($user->school->country->code == 'BD') {
                toast(transMsg('You are not able to pay the service charge.'), 'error')->timerProgressBar();
                return redirect()->back();
            } else {
                $token = request()->stripeToken;
                $email = request()->stripeEmail;

                if (empty($token)) {
                    toast(transMsg('Stripe Token required'), 'error')->timerProgressBar();
                    return redirect()->back();
                }

                \Stripe\Stripe::setApiKey(stripe_apiKey());

                //Passing the Stripe fee on to customers
                $total = ($total_chage + 0.30) / (1 - 0.029);
                $pay_amount = round($total, 2) * 100;
                $stripe_fee = round($total, 2) - $total_chage;

                try {
                    $charge = \Stripe\Charge::create([
                        'amount' => $pay_amount,
                        'currency' => 'usd',
                        'description' => $user->school->name . ' (' . $user->email . ')',
                        'source' => $token,
                    ]);

                    $status = $charge->status;
                    $charge_id = $charge->id;
                    $transaction_id = $charge->balance_transaction;
                    $tran_date = $created = $charge->created;
                    $currency = $charge->currency;

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
                        $school_payment->amount = $amount;
                        $school_payment->stripe_fee = $stripe_fee;
                        $school_payment->trans_status = 'Paid';
                        $school_payment->purpose_id = 2;
                        $school_payment->currency = $currency;
                        $school_payment->month = $month;
                        $school_payment->agentcode = $user->school->agentcode;
                        $school_payment->trans_date = date('Y-m-d H:i:s', $created);
                        $school_payment->rangeFrom = $rangeFrom;
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
                        } elseif (auth()->user()->role == 'master') {
                            $school_payment->transBy = 'FA';
                        }

                        $school_payment->save();

                        $schoolupdate = School::find($user->school_id);
                        $schoolupdate->lastCharged = $rangeTo;
                        $schoolupdate->save();

                        //Service Charge confirm email
                        Mail::send('email.user.service', $emailScPayment, function ($message) use ($user, $agentData) {
                            $message->from(config('mail.from.address'), faAcademy()->name);
                            $message->to($user->email, $user->school->short_name)->subject('Paid Service Charge');
                            if (!empty($agentData) && auth()->user()->role != 'agent') {
                                $message->bcc('arun24542@gmail.com', $agentData->name)->subject('School Service Charge');
                            }
                        });

                        toast(transMsg('Service charge successfully paid!'), 'success')->timerProgressBar();

                        if (auth()->user()->role == 'agent') {
                            return redirect()->route('school.make.payment.agent', $scode);
                        } elseif (auth()->user()->role == 'master') {
                            return redirect()->route('school.make.payment.fa', $scode);
                        }
                        return redirect()->route('make.payment.school');
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
            return redirect()->back();
        }
    }

    public function servicesChargeCash($scode)
    {
        $user = User::whereCode($scode)->where('isSuper', 1)->first();
        $shareOf = $percentTk = $pStatus = 0;

        if ($user) {

            if (auth()->user()->role != 'master') {
                toast(transMsg('Invalid request, Please try again!'), 'warning')->timerProgressBar();
                return redirect()->back();
            }

            if (!empty($user->school->agentcode)) {
                $shareOf = getAgentByCode($user->school->agentcode)->agent->shareOf;
            }
            if (request()->isMethod('post')) {
                $month = request()->month_of;
                if (empty($month)) {
                    toast(transMsg('Please select the month of range for service charge and try again!'), 'warning')->timerProgressBar();
                    return redirect()->back();
                }

                if (!empty($user->school->lastCharged)) {
                    $rangeFrom = date('Y-m-01 H:i:s', strtotime('+1 month', strtotime($user->school->lastCharged)));
                    $rangeTo = date('Y-m-28 H:i:s', strtotime('+' . $month . ' month', strtotime($user->school->lastCharged)));
                } else {
                    $createday = date('d', strtotime($user->school->created_at));
                    $createdmy = strtotime($user->school->created_at);
                    if ($createday >= 16) {
                        if ($createday > 28) {
                            $lastCharged = date('Y-m-d H:i:s', strtotime('-3 day', $createdmy));
                        } else {
                            $lastCharged = date('Y-m-d H:i:s', strtotime($user->school->created_at));
                        }
                    } else {
                        $lastCharged = date('Y-m-d H:i:s', strtotime('-1 month', $createdmy));
                    }
                    $rangeFrom = date('Y-m-01 H:i:s', strtotime('+1 month', strtotime($lastCharged)));
                    $rangeTo = date('Y-m-28 H:i:s', strtotime('+' . $month . ' month', strtotime($lastCharged)));
                }

                $totla_stdnt = total_student_current_school();
                $per_stdnt = $user->school->perStudent;
                $total_amount = ($totla_stdnt * $per_stdnt) * $month;
                $total_chage = $amount = round($total_amount,2);

                //For agent
                if (request()->mypercent == 1) {
                    $percent = $shareOf / 100;
                    $percents = $amount * $percent;
                    $percentTk = round($percents, 2);
                    $total_chage = $amount - $percentTk;
                } elseif (!empty(request()->mypercent) && request()->mypercent != 1) {
                    toast(transMsg('If you want to pay without your percentage, Please checked the box.'), 'error')->timerProgressBar();
                    return redirect()->back()->with('checked', true);
                }
            }

            $tran_id = generateTransID();
            $school_payment = SchoolPayment::firstOrCreate(['trans_id' => $tran_id]);
            $school_payment->school_id = $user->school_id;
            $school_payment->user_id = $user->id;
            $school_payment->trans_number = 'FA' . time();
            $school_payment->trans_id = $tran_id;
            $school_payment->trans_date = date('Y-m-d H:i:s', strtotime(now()));
            $school_payment->trans_type = 2;
            $school_payment->amount = $amount;
            $school_payment->stripe_fee = 0;
            $school_payment->card_type = 'Cash';
            $school_payment->trans_status = 'Paid';
            $school_payment->purpose_id = 2;
            $school_payment->currency = ($user->school->country->code == 'BD' ? 'bdt' : 'usd');
            $school_payment->month = $month;
            $school_payment->agentcode = $user->school->agentcode;
            $school_payment->rangeFrom = $rangeFrom;
            $school_payment->rangeTo = $rangeTo;
            $school_payment->shareOf = $shareOf;
            $school_payment->percentTk = $percentTk;
            $school_payment->transBy = 'FA';
            if (!empty($percentTk)) {
                $school_payment->pStatus = 1;
                $school_payment->tranCheque = 'AP' . time();
                $school_payment->sNote = 'Agent keep his/her percentage and pay to us!';
            }
            $school_payment->save();

            $schoolupdate = School::find($user->school_id);
            $schoolupdate->lastCharged = $school_payment->rangeTo;
            $schoolupdate->save();

            toast(transMsg('Service charge successfully paid!'), 'success')->timerProgressBar();
            return redirect()->route('school.make.payment.fa', $school_payment->school->code);
        } else {
            toast(transMsg('Main user not found, Try again!'), 'success')->timerProgressBar();
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\SchoolPayment $schoolPayment
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolPayment $schoolPayment)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\SchoolPayment $schoolPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolPayment $schoolPayment)
    {
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\SchoolPayment $schoolPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolPayment $schoolPayment)
    {
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\SchoolPayment $schoolPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolPayment $schoolPayment)
    {
        return redirect()->back();
    }
}
