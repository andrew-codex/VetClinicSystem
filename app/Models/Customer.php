<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Panel;
use Illuminate\Support\Facades\Auth;

class Customer extends  Authenticatable
{
        use Notifiable;
    protected $fillable =[
        'name',
        'email',
        'phone',
        'password',
        'address'
    ];

    public function pets() {
        return $this->hasMany(Pet::class);
    }



    public function appointments() {
        return $this->hasMany(Appointment::class);
    }



public function canAccessPanel(Panel $panel): bool
{
    return true; 
}


public function scopeOwnedByCustomer($query)
{
    return $query->where('customer_id', Auth::id());
}

}
