<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        $role = Auth::user()->role;

        return ($role == 'master') ? '/masters' : '/home';
    }

    public function showLoginForm()
    {
        if ($_SERVER['SERVER_NAME'] == 'foqasacademy.com' || $_SERVER['SERVER_NAME'] == 'www.foqasacademy.com') {
            session()->put('foqasLoginFor', 1);
            return view('auth.foqas-login');
        }
        return view('auth.login');
    }

    public function username()
    {
        $login = request()->input('email');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'student_code';
        request()->merge([$field => $login]);
        return $field;
    }

    public function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials = Arr::add($credentials, 'active', '1');
        $credentials = Arr::add($credentials, 'school_id', school('id'));
        return $credentials;
    }
}
