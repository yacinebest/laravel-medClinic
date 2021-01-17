<?php

namespace App\Http\Middleware\custom;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuth
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
        if (Auth::guard('doctor')->check() && Auth::guard('doctor')->user()->is_admin)
        {
            //if Doctor is admin continue to the other pages
            return $next($request);
        }
        else if (Auth::guard('doctor')->check())
        {
            return redirect()->route('doctorHome');
        }
        else if (Auth::guard('secretary')->check())
        {
            return redirect()->route('secretaryHome');
        }
        else{
            return redirect()->route('welcome');
        }
    }
}
