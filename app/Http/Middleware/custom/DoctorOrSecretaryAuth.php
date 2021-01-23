<?php

namespace App\Http\Middleware\custom;

use Closure;

use Illuminate\Support\Facades\Auth;

class DoctorOrSecretaryAuth
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
        if (Auth::guard('doctor')->check() || Auth::guard('secretary')->check())
        {
            return $next($request);
        }
        else{

            return redirect()->route('welcome');
        }
    }
}
