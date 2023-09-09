<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAgent
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
        if (Auth::guest())
            return redirect(route('foqas.login'), $status = 302, $headers = [], $secure = null);
        if (Auth::check() && Auth::user()->hasRole('agent'))
            return $next($request);
        return redirect('/login');
    }
}
