<?php

namespace App\Http\Middleware;

use App\Session;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            $session = Session::bySchool(school('id'))->status()->orderBy('created_at', 'DESC')->first();
            if ($session) {
                session()->forget('create_session_now');
                session()->forget('active_session_now');
                return $next($request);
            }
            $session = Session::bySchool(school('id'))->orderBy('created_at', 'DESC')->first();
            if ($session && session('active_session_now') == false)
                session()->put('active_session_now', true);
            else
                session()->put('create_session_now', true);

            return redirect()->route('home');
        }
        return $next($request);
    }
}
