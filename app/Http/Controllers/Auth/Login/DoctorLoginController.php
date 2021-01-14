<?php

namespace App\Http\Controllers\Auth\Login;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class DoctorLoginController  extends Controller
{
    use AuthenticatesUsers;

    public function redirectTo()
    {
        return route('doctorHome');
    }
    protected function loggedOut(Request $request) {
        return redirect(route('welcome'));
    }

    public function __construct()
    {
        $this->middleware('guest:secretary')->except('logout');
        $this->middleware('guest:doctor')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login.doctor');
    }

    protected function guard()
    {
        return Auth::guard('doctor');
    }
}
