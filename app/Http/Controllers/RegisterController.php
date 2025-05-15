<?php

namespace App\Http\Controllers;
use App\Models\Pet;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{
    public function showRegister(){
        return view ('register');
    }


    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:customers',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required|min:6',
        ]);

   
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' =>$request->address,
            'password' => Hash::make($request->password),
        ]);


        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
}
