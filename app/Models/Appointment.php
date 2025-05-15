<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    
    protected $fillable = [
        'customer_id', 
    'pet_id', 
    'vet_id',
    'species', 
    'appointment_date', 
    'status', 
    'notes'];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function pet() {
        return $this->belongsTo(Pet::class);
    }

    public function vet() {
        return $this->belongsTo(Vet::class);
    }
}
