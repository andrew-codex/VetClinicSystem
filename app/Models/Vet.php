<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class Vet extends Authenticatable implements CanResetPasswordContract
{
    use CanResetPassword;
    use \Illuminate\Notifications\Notifiable;
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

      public function medicalRecords() {
        return $this->hasMany(MedicalRecords::class);
    }

   
}
