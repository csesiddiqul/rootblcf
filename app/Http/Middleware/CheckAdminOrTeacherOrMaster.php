<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminOrTeacherOrMaster
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user->hasRole('master') || $user->hasRole('admin') || $user->hasRole('teacher') || $user->hasRole('accountant') || $user->hasRole('librarian')) {
            return $next($request);
        }
        return redirect('home');
    }
}
