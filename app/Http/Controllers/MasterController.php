<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Country;
use App\Agent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MasterController extends Controller
{

    public function index()
    {
        return view('masters.index');
    }

    public function agentsIndex()
    {
        $data['agents'] = User::where('role', 'agent')->orderBy('nationality', 'ASC')->get();
        return view('masters.agents', $data);
    }

    public function agentsCreate(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'name' => 'required|min:3|max:50',
                'email' => 'email|unique:users,email,null,id,school_id,' . school('id'),
                'password' => 'required|confirmed|min:6',
            ]);
            $userData['name'] = $request->name;
            $userData['email'] = $request->email;
            $userData['password'] = $request->password;
            $userData['school_id'] = school('id');
            $userData['code'] = school('code');
            $userData['nationality'] = getCountryByCode($request->nationality)['name'];
            $userData['phone_number'] = $request->phone_number;
            $userData['address'] = $request->address;
            $userData['agentnew'] = true;
            $userData['shareOf'] = $request->shareOf;

            $user = (new User())->newUserAdmin($userData, 'agent');

            //CheckAgent confirm email
            /*Mail::send('email.user.agents',$userData, function ($message) use ($request) {
                $message->from(config('mail.from.address'), school('name'));
                $message->to($request->email, $request->name)->subject('Ledger Created');
            });*/
            toast('CheckAgent created successfully!', 'success')->timerProgressBar();
            return redirect()->back();
        }

        $data['country'] = Country::where('status', '1')->orderBy('name', 'ASC')->pluck('name', 'code');
        return view('masters.agent-create', $data);

    }

    public function agentEdit($code)
    {
        $agent = User::bySchool(school('id'))->where('student_code', $code)->first();
        $data['country'] = Country::where('status', '1')->orderBy('name', 'ASC')->pluck('name', 'name');
        return view('masters.agent-edit', $data, compact('agent'));
    }

    public function agentStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50,',
            'email' => 'email|unique:users,email,' . $request->id . ',id,school_id,' . school('id'),
        ]);

        $data = request()->except(['_token', '_method']);
        User::bySchool(school('id'))->find($request->id)->update($data);
        Agent::whereUser_id($request->id)->update(['shareOf' => $request->shareOf ?? '30']);

        toast('Agent updated successfully', 'success')->timerProgressBar();
        return redirect()->route('agents.index');
    }

    public function agentProfile($code)
    {
        if ($code == auth()->user()->student_code || auth()->user()->hasRole('master')) {
            $agent = User::bySchool(school('id'))->with('agent')->where('student_code', $code)->first();
            if (empty($agent)) {
                toast('Agent not found !', 'error')->timerProgressBar();
                return redirect()->back();
            }
            return view('agent.profile', compact('agent'));
        } else {
            return redirect('home');
        }

    }
}
