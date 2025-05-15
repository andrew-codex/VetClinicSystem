<?php

namespace App\Http\Controllers;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    
    public function index()
    {
    $pets = Pet::where('customer_id', Auth::guard('customer')->id())->get();

    return view('petPage', compact('pets'));
    }

   
    public function create(Request $request)
    {
      
   
        $request->validate([
            'pet_name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'medical_history' => 'nullable|string|max:1000',
           
        ]);

        $pet = new Pet();
        $pet->pet_name = $request->pet_name;
        $pet->species = $request->species;
        $pet->breed = $request->breed;
        $pet->age = $request->age;
        $pet->medical_history = $request->medical_history;
        $pet->customer_id = Auth::guard('customer')->id();
        $pet->save();

        return back()->with('success', 'Pet created successfully!');

    }


    public function store(Request $request)
    {
    
        return redirect()->route('customer.pets.index');
    }

    public function edit(Pet $pet)
    {
        return response()->json($pet); 
    }
   
    
    public function update(Request $request, $id)
    {

        $request->validate([
            'pet_name' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'medical_history' => 'nullable|string|max:1000',
        ]);

        $pet = Pet::findOrFail($id);
        $pet->pet_name = $request->pet_name;
        $pet->species = $request->species;
        $pet->breed = $request->breed;
        $pet->age = $request->age;
        $pet->medical_history = $request->medical_history;
        $pet->save();

        return redirect()->route('petPage')->with('success', 'Pet updated successfully!');
    }

   
    public function destroy($id)
    {
        
        $pet = Pet::findOrFail($id);
        $pet->delete();

        return back()->with('success', 'Pet deleted successfully!');


    }
}
