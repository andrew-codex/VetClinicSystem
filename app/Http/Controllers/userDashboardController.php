<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\MedicalRecords;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class userDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $customerId = Auth::guard('customer')->id();
   
    $user = Auth::guard('customer')->user();

    $pets = Pet::where('customer_id', $customerId)->get();
   
    $appointments = Appointment::whereHas('pet', function ($query) use ($customerId) {
        $query->where('customer_id', $customerId);
    })->get();

        $medicalRecords = MedicalRecords::whereHas('pet', function ($query) use ($user) {
        $query->where('customer_id', $user->id);
    })->get();

    return view('userDashboard', compact('pets', 'medicalRecords', 'appointments'));
}

    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
