<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Pet extends Model
{
    protected $fillable = ['customer_id', 'pet_name','species' ,'breed', 'age', 'medical_history'];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function appointments() {
        return $this->hasMany(Appointment::class);
    }

      public function medicalRecords() {
        return $this->hasMany(MedicalRecords::class);
    }

    public function scopeOwnedByCustomer(Builder $query): Builder
    {
        return $query->where('customer_id', Auth::id());
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pet) {
            if (Auth::check()) {
                $pet->customer_id = Auth::id(); 
            }
        });
    }
}
