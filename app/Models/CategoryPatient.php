<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryPatient extends Model
{
    use HasFactory;
    protected $fillable=['name'];

    /**
     * Get all of the patients for the CategoryPatient
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }
}
