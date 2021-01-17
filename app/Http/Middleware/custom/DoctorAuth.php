<?php

namespace App\Http\Middleware\custom;

use Closure;
use Illuminate\Support\Facades\Auth;

class DoctorAuth
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
        if (Auth::guard('doctor')->check())
        {
            //if doctor continue to pages
            return $next($request);
        }
        else if(Auth::guard('secretary')->check())
        {
            return redirect()->route('secretaryHome');
        }
        else{

            return redirect()->route('welcome');
        }

    }
}
