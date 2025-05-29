<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Pest\ArchPresets\Custom;

class MedicalRecords extends Model
{
    protected $fillable = [
        'pet_id',
        'vet_id',
        'Owner_name',
        'visit_date',
        'diagnosis',
        'treatment',
        'prescription',
        'notes',
        'next_visit_date',
        'status',
    ];

     public function pet() {
        return $this->belongsTo(Pet::class);
    }

    
    public function vet() {
        return $this->belongsTo(Vet::class);
    }

     public function customer() {
        return $this->belongsTo(Customer::class, 'Owner_name', 'id');
    }

    protected static function booted()
{
    static::creating(function ($record) {
        if (!$record->vet_id) {
            $record->vet_id = auth()->guard('vet')->id();  
        }
    });
}

}
