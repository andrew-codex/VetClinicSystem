<?php

namespace App\Http\Controllers;
use App\Models\Customer;

use Illuminate\Http\Request;

class userProfileController extends Controller
{
    public function index()
    {
        $customer = auth()->guard('customer')->user();
        return view('userProfile', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=> 'required',
              'email'=> 'required',
                'phone'=> 'required',
                  'address'=> 'required',

        ]);
         $customer = Customer::findOrFail($id);
        $customer->name = $request->name;
         $customer->email = $request->email;
          $customer->phone = $request->phone;
           $customer->address = $request->address;

           $customer->save();

           return redirect()->route('userProfile')->with('success', 'Profile updated successfully!');

    }

    
}
