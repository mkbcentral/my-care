<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_code',
        'birth_date',
        'social_security_number',
        'emergency_contact_name',
        'emergency_contact_phone_number',
        'blood_group',
        'address_street',
        'address_city',
        'address_city',
        'company_id',
        'country_id',
        'hospital_id',
        'center_hospital_id',
        'user_id',
    ];
}
