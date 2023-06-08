<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CenterHospital extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'center_phone',
        'city',
        'municipality',
        'street',
        'number_street',
        'long',
        'lat',
        'hospital_id',
        'city_id'
    ];

    /**
     * Get the hospital that owns the CenterHospital
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    /**
     * Get the city that owns the CenterHospital
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
