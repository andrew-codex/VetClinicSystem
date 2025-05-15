<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecords extends Model
{
    protected $fillable = [
        'pet_name',
        'Owner_name',
        'visit_date',
        'diagnosis',
        'treatment',
        'prescription',
        'notes',
        'next_visit_date',
    ];

     public function pet() {
        return $this->belongsTo(Pet::class);
    }

     public function medicalRecord() {
        return $this->belongsTo(MedicalRecords::class);
    }
}
