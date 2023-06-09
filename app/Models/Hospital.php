<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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


    /**
     * Get the country that owns the Hospital
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
