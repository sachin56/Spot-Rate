<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function index(){
        if(Auth::guard('admin')->check()){
            return view('admin.admin-dashboard');
        }else{
            return view('admin.admin-login');
        }    
    }

    public function dashboard(){
        if(Auth::guard('admin')->check()){
            return view('admin.admin-dashboard');
        }else{
            return view('admin.auth.admin-login');
        }
    }
    
    public function checklogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::guard('admin')->attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')
                ->withSuccess('You have successfully logged in!');
        }
        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');

    }

    public function adminlogout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.index')
                ->withSuccess('You have successfully logged in!');
    }
}
