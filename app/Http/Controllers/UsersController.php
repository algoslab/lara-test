<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersController extends Controller
{
    public function users_form(){
        return view('users.users_form');
    }

    public function users_create(Request $request){
        //dd($request->all());
        $validated = $request->validate([
                    'name'              => 'required',
                    'account_type'      => 'required',
                    'balance'           => 'required',
                    'email'             => 'required|email',
                    'password'          => 'required'
                ]);
        //dd($validated);     
        User::create($validated);
        return redirect()->back()->with(['success' => 'Success', 'message' => "User Created."]);
    }

    public function login_form(){
        return view('users.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('transactions');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
