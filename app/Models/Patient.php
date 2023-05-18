<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PHPUnit\Framework\Constraint\Count;

class Patient extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_code',
        'birth_date',
        'gender',
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
     * Get the company that owns the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(company::class, 'company_id');
    }
    /**
     * Get the category that owns the Patient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(category::class, 'category_patient_id');
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

}