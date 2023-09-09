<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Menu;
use App\School;
use App\Setting;
use App\User;
use App\SchoolPayment;
use Illuminate\Http\Request;
use App\Country;
use App\District;
use App\State;
use App\Pricing;
use App\Subscription;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Stripe;

class NewRegisterController extends Controller
{
    public function nowRegister(Request $request)
    {
        $data['country'] = Country::where('status', '1')->orderBy('name', 'ASC')->pluck('name', 'code');
        if ($request->isMethod('POST')) {
            session()->forget('step1');

            $random = Str::random(6);
            $request->request->add(['code' => $random]);
            $steps1 = $request->all();
            session()->put('step1', $steps1);

            Mail::send('email.user.verificationCode', array(), function ($message) use ($request) {
                $message->from(config('mail.from.address'), school('name'));
                $message->to($request->email, $request->name)
                    ->subject('Verification Code Received');
            });

            return redirect()->route('school.info');
        }
        return view('register.step1', $data);
    }

    public function schoolInfo(Request $request)
    {
        if (empty(session('step1'))) {
            return redirect()->route('now.register');
        }

        $data['stepone'] = session('step1');

        if ($data['stepone']['nationality'] == 'BD') {
            $data['disState'] = District::where('status', '1')->orderBy('name', 'ASC')->pluck('name', 'id');
            $data['datafield'] = 'district_id';
        } elseif ($data['stepone']['nationality'] == 'US') {
            $data['disState'] = State::where('status', '1')->orderBy('name', 'ASC')->pluck('name', 'id');
            $data['datafield'] = 'state_id';
        } else {
            $data['disState'] = array();
            $data['datafield'] = 'city';
        }

        if ($request->isMethod('POST')) {
            session()->forget('step2');

            $steps2 = $request->all();
            // return session('step1');
            if ($steps2['vcode'] != session('step1')['code']) {
                toast(transMsg('Verification code does not exists.'), 'warning')->timerProgressBar();
                return redirect()->back();
            }

            session()->put('step2', $steps2);

            if (session('step1')['nationality'] == 'BD') {
                return redirect()->route('payment.info');
            } else {
                return redirect()->route('pay.now');
            }
        }

        return view('register.step2', $data);
    }

    public function paymentInfo(Request $request)
    {
        if (empty(session('step1'))) {
            return redirect()->route('now.register');
        } elseif (empty(session('step2'))) {
            return redirect()->route('school.info');
        }

        $country = trim(getCountryByCode(session('step1')['nationality'])['name']);
        $data['pricing'] = Pricing::where([['country', $country], ['price_type', 1], ['status', 4]])->first();

        return view('register.step4', $data);
    }

    public function payNow(Request $request)
    {

        if (empty(session('step1'))) {
            return redirect()->route('now.register');
        } elseif (empty(session('step2'))) {
            return redirect()->route('school.info');
        }

        $country = trim(getCountryByCode(session('step1')['nationality'])['name']);
        $data['pricing'] = Pricing::where([['country', $country], ['price_type', 1], ['status', 4]])->first();

        if ($request->isMethod('POST')) {
            $steps3 = $request->all();
            $shareOf = 0;

            $country = trim(getCountryByCode(session('step1')['nationality'])['name']);

            if (!empty($request->ref_number)) {
                $price = Pricing::where([['country', $country], ['code', trim($request->ref_number)], ['price_type', 1], ['status', 1]])->first();
                if (empty($price)) {
                    session()->forget('validPrices');
                    $message = ['ref_number' => 'Reference code does not exists.'];
                    toast('Reference code does not exists.', 'warning')->timerProgressBar();
                    return redirect()->back()->withErrors($message)->withInput();
                } else {
                    session()->put('validPrices', $price);
                }
            } else {
                $price = Pricing::where([['country', $country], ['status', 4]])->first();
            }

            if (!empty($request->agentcode)) {
                $agents = User::where([['nationality', $country], ['student_code', trim($request->agentcode)], ['role', 'agent'], ['active', 1]])->first();
                if (empty($agents)) {
                    $message = ['agentcode' => 'Agent number does not exists.'];
                    toast('Agent number does not exists.', 'warning')->timerProgressBar();
                    return redirect()->back()->withErrors($message)->withInput();
                }
                $shareOf = getAgentByCode($request->agentcode)->agent->shareOf;
            }

            session()->forget('validPrices');

            \Stripe\Stripe::setApiKey(stripe_apiKey());

            $token = $steps3['stripeToken'];
            $name = session('step1')['name'];
            $email = $steps3['stripeEmail'];

            //Passing the Stripe fee on to customers
            $total = ($price->price + 0.30) / (1 - 0.029);
            $amount = round($total, 2) * 100;
            $stripe_fee = round($total, 2) - $price->price;

            try {
                $charge = \Stripe\Charge::create([
                    'amount' => $amount,
                    'currency' => 'usd',
                    'description' => $name . ' (' . $email . ')',
                    'source' => $token,
                ]);

                $status = $charge->status;
                $charge_id = $charge->id;
                $transaction_id = $charge->balance_transaction;
                $created = $charge->created;
                $currency = $charge->currency;

                $month = $price->subsMonth;
                $rangeParse = \Carbon\Carbon::parse($created);
                $rangedate = $rangeParse->addMonths($month);
                $rangeTo = date('Y-m-d H:i:s', strtotime($rangedate));

                if ($status == 'succeeded') {
                    $schoolData['name'] = $name;
                    $schoolData['established'] = session('step2')['established'];
                    $schoolData['address'] = session('step2')['address'];
                    $schoolData['country_id'] = getCountryByCode(session('step1')['nationality'])['id'];

                    if (isset(session('step2')['city'])) {
                        $schoolData['city'] = session('step2')['city'];
                    } elseif (isset(session('step2')['state_id'])) {
                        $schoolData['state_id'] = session('step2')['state_id'];
                    }

                    $schoolData['agentcode'] = trim($steps3['agentcode']);
                    $schoolData['activeTill'] = $rangeTo;
                    $schoolData['perStudent'] = $price->perStudent ?? 5;

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

                    $payment['school_id'] = $school->id;
                    $payment['user_id'] = $user->id;
                    $payment['trans_number'] = 'FA' . time();
                    $payment['stripe_charge'] = $charge_id;
                    $payment['trans_id'] = $transaction_id;
                    $payment['trans_date'] = date('Y-m-d h:i:s', $created);
                    $payment['trans_type'] = 1;
                    $payment['trans_status'] = 'Paid';
                    $payment['amount'] = $price->price;
                    $payment['stripe_fee'] = $stripe_fee;
                    $payment['currency'] = $currency;
                    $payment['purpose_id'] = 1;
                    $payment['agentcode'] = trim($steps3['agentcode']);
                    $payment['ref_number'] = trim($steps3['ref_number']);
                    $payment['month'] = $month;
                    $payment['rangeFrom'] = date('Y-m-d h:i:s', $created);
                    $payment['rangeTo'] = $rangeTo;
                    $payment['shareOf'] = $shareOf;

                    $emailScPayment['scPayment'] = $scPayment = SchoolPayment::create($payment);

                    $subscription = new Subscription();
                    $subscription->user_id = $user->id;
                    $subscription->school_id = $school->id;
                    $subscription->school_payment_id = $scPayment->id;
                    $subscription->month = $month;
                    $subscription->price = $price->price;
                    $subscription->rangeFrom = date('Y-m-d h:i:s', $created);
                    $subscription->rangeTo = $rangeTo;
                    $subscription->save();

                    $completed = array('school' => $name, 'email' => $email, 'password' => session('step1')['password'], 'sp_id' => $scPayment->id, 'sc_code' => $school->code);
                    session()->put('completed', $completed);

                    //Registration confirm email
                    Mail::send('email.user.regconfirm', $emailScPayment, function ($message) use ($email, $name) {
                        $message->from(config('mail.from.address'), school('name'));
                        $message->to($email, $name)->subject('School Registration Confirmation');
                    });

                    session()->forget('step1');
                    session()->forget('step2');

                    toast('Your payment & registration completed!', 'success')->timerProgressBar();
                    return redirect()->route('payment.register');

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
        return view('register.step3', $data);
    }

    public function paymentRegister(Request $request)
    {
        if (empty(session('completed'))) {
            return redirect()->route('foqas.login');
        }
        session()->forget('validPrices');
        $data['spdetails'] = SchoolPayment::find(session('completed')['sp_id']);
        return view('register.completed', $data);
    }

}
