<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    public function login(Request $request){

    	if (Auth::guard('admin')->attempt(
            ['email' => $request->email, 
            'password' => $request->password], 
            $request->remember)) {
            //if successful, then redirect to ther\ir intended location
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard', ['login' => true]);
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request)
    {
        auth()->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.loginForm');

    }
}
