<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    public function showLoginPage()
    {
        return view('pages.login');
    }

    public function Login (Request $req)
    {
        $req->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $req->only('email', 'password');
        if(Auth::guard('admin')->attempt($credentials)){
            return redirect()->route('admin.dashboard')
                            ->with('message', 'Login Successfully');
        }

        return redirect('admin/login')->withErrors('Invalid Login credentials or user does not exists!');

    }

    public function Logout()
    {
        Session::flush();
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));

    }
}
