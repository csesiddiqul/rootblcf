<?php

namespace App\Http\Controllers;

use App\Agent;
use App\User;
use App\Country;
use App\District;
use App\State;
use App\School;
use App\SchoolPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($code)
    {  
        $data['aguser'] = $aguser = User::bySchool(school('id'))->whereStudent_code($code)->first();
        if (empty($aguser)) {
            toast(transMsg('You are not able to access.'), 'error')->timerProgressBar(); 
            return redirect()->back(); 
        }
        
        if($code == auth()->user()->student_code || auth()->user()->hasRole('master')){
            $data['receiveds'] = SchoolPayment::where([['agentcode',$code],['trans_status','Paid']])->orderByRaw("trans_date DESC,purpose_id ASC")->get(); 
            return view('agent.index',$data);
        }else {
            toast(transMsg('You are not able to access.'), 'error')->timerProgressBar();
            return redirect('home');
        }
    }

    public function paid($code)
    {  
        $data['aguser'] = $aguser = User::bySchool(school('id'))->whereStudent_code($code)->first();
        if (empty($aguser)) {
            toast(transMsg('You are not able to access.'), 'error')->timerProgressBar(); 
            return redirect()->back(); 
        }

        if($code == auth()->user()->student_code || auth()->user()->hasRole('master')){
            $data['receiveds'] = SchoolPayment::where([['agentcode',$code],['trans_status','Paid'],['pStatus',1]])->orderByRaw("trans_date DESC,purpose_id ASC")->get(); 
            return view('agent.paid',$data);
        }else {
            toast(transMsg('You are not able to access.'), 'error')->timerProgressBar();
            return redirect('home');
        }
    }

    public function unpaid($code)
    {  
        $data['aguser'] = $aguser = User::bySchool(school('id'))->whereStudent_code($code)->first();
        if (empty($aguser)) {
            toast(transMsg('You are not able to access.'), 'error')->timerProgressBar(); 
            return redirect()->back(); 
        }

        if($code == auth()->user()->student_code || auth()->user()->hasRole('master')){
            $data['receiveds'] = SchoolPayment::where([['agentcode',$code],['trans_status','Paid'],['pStatus',0]])->orderByRaw("trans_date DESC,purpose_id ASC")->get(); 
            return view('agent.unpaid',$data);
        }else {
            toast(transMsg('You are not able to access.'), 'error')->timerProgressBar();
            return redirect('home');
        }
    }

    public function payselected($code)
    {    
        if (empty(request()->id)) {
            toast(transMsg('At least one payment should be selected!'), 'warning')->timerProgressBar();
            return redirect()->back();
        }
        if (empty(request()->tranCheque)) {
            toast(transMsg('Please write Trans./Cheque number!'), 'warning')->timerProgressBar();
            return redirect()->back();
        }

        $total = 0;
        foreach (request()->id as $key => $value) { 
            $sc_payment = SchoolPayment::find($value);
            if (!empty($sc_payment->shareOf)) {
                $shareOf = $sc_payment->shareOf;
            }else{
                $shareOf = getAgentByCode($sc_payment->agentcode)->agent->shareOf;
            }

            $percent = $shareOf / 100;
            $percents = $sc_payment->amount * $percent; 
            $percentTk = round($percents,2); 

            $sc_payment->shareOf = $shareOf;
            $sc_payment->percentTk = $percentTk;
            $sc_payment->pStatus = 1;
            $sc_payment->tranCheque = request()->tranCheque;
            $sc_payment->sNote = request()->sNote ?? 'AP'.time();
            $sc_payment->save();  
            $total += $percentTk;
        } 
        
        $totalTk = round($total,2); 
        $agent = getAgentByCode($sc_payment->agentcode);
        $data['totalTk'] = $totalTk;
        $data['trans'] = request()->tranCheque;
        $data['ag_name'] = $agent->name;
        $data['curname'] = $sc_payment->currency;  

        Mail::send('email.user.payment', $data, function ($message) use ($agent) {
            $message->from(config('mail.from.address'), faAcademy()->name);
            $message->to($agent->email, $agent->name)->subject('Payment Received'); 
        }); 

        toast(transMsg('Payment successfully send to '.getAgentByCode($sc_payment->agentcode)->name), 'success')->timerProgressBar();
        return redirect()->back();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $code = auth()->user()->student_code;
        $data['agent'] = User::bySchool(school('id'))->with('agent')->where('student_code',$code)->first();
        $data['country'] = Country::where('status', '1')->orderBy('name', 'ASC')->pluck('name', 'name');
        $data['district'] = District::where('status', '1')->orderBy('name', 'ASC')->pluck('name', 'id');
        $data['state'] = State::where('status', '1')->orderBy('name', 'ASC')->pluck('name', 'id');
        return view('agent.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $code = auth()->user()->student_code;
        $user = User::bySchool(school('id'))->where('student_code',$code)->first();
        $agent = Agent::where('user_id',$user->id)->first();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->about = $request->about;
        $user->save();

        if (isset($request->district_id)) { 
            $agent->district_id = $request->district_id;
            $agent->nid = $request->nid; 

            if (!empty($request->url)) { 
                unlinkS3File($agent->nid_url);
                $agent->nid_url = fileUpload($request->url,'NID'); 
            }
            
        }else if (isset($request->state_id)) { 
            $agent->state_id = $request->state_id;
        }else{
            $agent->city = $request->city;
        }

        $agent->bank_name = $request->bank_name;
        $agent->ac_name = $request->ac_name;
        $agent->ac_number = $request->ac_number;  
        $agent->ac_branch = $request->ac_branch;
        $agent->ac_routing = $request->ac_routing; 

        //return $agent;
        $agent->save(); 

        toast(transMsg('Your profile updated successfully!'), 'success')->timerProgressBar();
        return redirect()->route('agent.profile.edit');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $agent)
    {
        return redirect()->back();
    }

    public function agentCheck()
    { 
        $country = trim(getCountryByCode(session('step1')['nationality'])['name']);
        $code = trim($_REQUEST['code']); 
        $agents = User::bySchool(school('id'))->where([['nationality',$country],['student_code',$code],['role','agent'],['active',1]])->first();

        if (!empty($agents)) { 
            return 200;
        }else{ 
            return 400;
        } 
    }

    public function agentschoolList($code)
    {
        if($code == auth()->user()->student_code || auth()->user()->hasRole('master')){
            $data['schools'] = School::with('setting')->where('agentcode',$code)->whereIn('status',[1,2])->get(); 
            return view('agent.schools',$data);
        }else {
            return redirect('home');
        }
       
    }
}
