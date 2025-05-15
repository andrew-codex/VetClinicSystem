<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    public function showLoginForm()
    {
        return view('login');
    }
    public function login(Request $request)
    {
    
        $credentials = $request->only('email', 'password');

      
      

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->route('userDashboard'); 
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }
}
