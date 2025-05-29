<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use App\Models\MedicalRecords;

class medicalRecordsController extends Controller
{
public function index()
    {
        $user = auth('customer')->user();

        $medicalRecords = MedicalRecords::whereHas('pet', function ($query) use ($user) {
            $query->where('customer_id', $user->id);
        })->with(['pet', 'vet'])->get();

        return view('medicalRecords', compact('medicalRecords'));
    }
}
