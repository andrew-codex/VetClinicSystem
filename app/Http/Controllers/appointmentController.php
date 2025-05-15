<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Vet;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class appointmentController extends Controller
{
 public function index()
{
    $customerId = Auth::guard('customer')->id();

    

    $appointments = Appointment::with('vet', 'pet')
        ->where('customer_id', $customerId)
        ->get();

    $pets = Pet::where('customer_id', $customerId)->get();
    $vets = Vet::all();

    return view('appointment', compact('appointments', 'pets', 'vets'));
}

public function edit($id)
{
    $appointment = Appointment::with('vet', 'pet')->findOrFail($id);
    $pets = Pet::where('customer_id', Auth::guard('customer')->id())->get();
    $vets = Vet::all();

    return view('editAppointment', compact('appointment', 'pets', 'vets'));
}




    public function destroy($id){
        $appointments = Appointment::find($id);
        if ($appointments) {
            $appointments->delete();
            return redirect()->back()->with('success', 'Appointment deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Appointment not found.');
        }
    }

    public function create(Request $request)
    {
        $request->validate([
            'appointment_date' => 'required|date',
            'notes' => 'nullable|string|max:255',
            
           
            
        ]);
$pet = Pet::find($request->pet_id);
        $appointment = new Appointment();
        $appointment->appointment_date = $request->appointment_date;
        $appointment->species =  $pet->species;
        $appointment->notes =$request->notes;
        $appointment->customer_id = Auth::guard('customer')->id();
        $appointment->pet_id = $request->pet_id; 
        $appointment->vet_id = $request->vet_id; 
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'appointment_date' => 'required|date',
            'notes' => 'nullable|string|max:255',
            'species' => 'required|string|max:255',
            
        ]);

        $appointment = Appointment::find($id);
        if ($appointment) {
            $appointment->appointment_date = $request->appointment_date;
            $appointment->species = $request->species;
            $appointment->notes =$request->notes;
            $appointment->save();

            return redirect()->back()->with('success', 'Appointment updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Appointment not found.');
        }
    }
}
