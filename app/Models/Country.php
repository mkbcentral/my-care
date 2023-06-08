<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;
    protected  $fillable=['name','country_code','flag'];
    /**
     * Get all of the patients for the Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }

    /**
     * Get all of the hospitals for the Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hospitals(): HasMany
    {
        return $this->hasMany(Hospital::class);
    }
}
