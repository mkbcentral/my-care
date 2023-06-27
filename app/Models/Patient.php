<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use PHPUnit\Framework\Constraint\Count;

class Patient extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'id_code',
        'date_of_birth',
        'full_name',
        'gender',
        'social_security_number',
        'emergency_contact_name',
        'emergency_contact_phone_number',
        'blood_group_id',
        'municipality_id',
        'address_street',
        'address_street_number',
        'user_id',
        'country_id',
        'city_id',
    ];
    /**
     * Get the country that owns the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    /**
     * Get the city that owns the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    /**
     * Get the user that owns the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the consultationSheet associated with the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function consultationSheet(): HasOne
    {
        return $this->hasOne(ConsultationSheet::class);
    }

}
