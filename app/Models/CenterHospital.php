<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CenterHospital extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'center_phone',
        'city',
        'street',
        'number_street',
        'long',
        'lat',
        'hospital_id'
    ];
}
