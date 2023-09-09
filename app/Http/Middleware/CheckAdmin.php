<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
        $auth_user = Auth::user();
        if ($auth_user->hasRole('admin')) {
            if ($auth_user->school->status == 3)
                session()->put('school_expired', true);
            return $next($request);
        }
        return redirect('home');
    }
}
