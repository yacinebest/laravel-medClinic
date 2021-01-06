<?php

namespace App\Http\Controllers\Auth\Login;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController as DefaultLoginController;

class SecretaryLoginController extends DefaultLoginController
{
    protected $redirectTo = '/secretary/home';
    protected $redirectAfterLogout = '/';

    public function __construct()
    {
        $this->middleware('guest:secretary')->except('logout');
        $this->middleware('guest:doctor')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login.secretary');
    }

    protected function guard()
    {
        return Auth::guard('secretary');
    }



}
