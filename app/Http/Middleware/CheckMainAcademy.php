<?php

namespace App\Http\Middleware;

use Closure;

class CheckMainAcademy
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
        if ($_SERVER['SERVER_NAME'] == 'foqasacademy.com' || $_SERVER['SERVER_NAME'] == 'www.foqasacademy.com') {
            return redirect(route('login'));
        }
        return $next($request);
    }
}
