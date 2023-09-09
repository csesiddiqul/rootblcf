<?php

namespace App\Http\Middleware;

use Closure;

class TimeZoneMiddleware
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
        $code = null;
        if (isset(session('step1')['nationality'])) {
            $code = getCountryByCode(session('step1')['nationality'])['code'];
        }
        $preTimezone = ($code == 'BD' ? 'Asia/Dhaka' : (foqas_setting('timezone') ?? config('app.timezone')));

        $timezone = ($request->hasHeader('X-Timezone')) ? $request->header('X-Timezone') : $preTimezone;
        try {
            date_default_timezone_set($timezone);
        } catch (\Exception $exception) {
            date_default_timezone_set(config('app.timezone'));
        }

        return $next($request);
    }
}
