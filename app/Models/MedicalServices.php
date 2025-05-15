<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalServices extends Model
{
    protected $fillable = [
        'service_name',
        'description',
        'price'
    ];
}
