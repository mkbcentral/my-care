<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable=['name','price_private','price_suscribe','hospital_id'];

    /**
     * Get all of the consultationRequests for the Consultation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consultationRequests(): HasMany
    {
        return $this->hasMany(ConsultationRequest::class);
    }
}
