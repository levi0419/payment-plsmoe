<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Hash;
use Rule;


class AdminController extends Controller
{
    public function showDashboard()
    {
        return view ('pages.dashboard');
    }

    public function createUserPage()
    {
        return view('pages.create_user');
    }

    public function createUser(Request $req)
    {
        $req->validate([
            'email' => 'required|unique:users,email',
            'name' => 'required',
            'password' => 'required|min:8'

        ]);
        $data = $req->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        if (!$user){
            return back()->withErrors($user);
        }
        else {
            return back()->with('message', 'User Created Successfully');
        }

    }

    public function editProfilePage()
    {
        $user = Auth::guard('admin')->user();
        //dd($user);
        return view('pages.profile', compact('user'));
    }


}
