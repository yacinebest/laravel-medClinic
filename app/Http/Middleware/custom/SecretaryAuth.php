<?php

namespace App\Http\Middleware\custom;

use Closure;
use Illuminate\Support\Facades\Auth;

class SecretaryAuth
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
        if (Auth::guard('secretary')->check())
        {
            //if secretary continue to pages
            return $next($request);
        }
        else if(Auth::guard('doctor')->check())
        {
            return redirect()->route('doctorHome');
        }
        else{
            return redirect()->route('welcome');
        }
    }
}
