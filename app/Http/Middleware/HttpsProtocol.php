<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

class HttpsProtocol
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
        /* if (!$request->secure() && !serverIsLocal()) {
             return redirect()->secure($request->getRequestUri());
         }
+
         return $next($request);
        if (App::environment('production')  && !serverIsLocal()) {

            $host = $request->header('host');
            if (substr($host, 0, 4) != 'www.') {
                $request->headers->set('host', 'www.' . $host);
                return Redirect::to($request->path(), 301);
            }

        }*/
        return $next($request);
    }
}
