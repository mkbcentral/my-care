<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'abbreviation',
        'logo',
        'email',
        'phone',
        'city',
        'street',
        'number_street',
        'long',
        'lat',
        'country_id'
    ];
}
