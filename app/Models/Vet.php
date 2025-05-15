<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;



class Vet extends Authenticatable
{
    protected $fillable = [
    'name', 
    'email',
    'password', 
    'phone'];

    public function appointments() {
        return $this->hasMany(Appointment::class);
    }

    public function pets() {
        return $this->hasMany(Pet::class);
    }

   
}
