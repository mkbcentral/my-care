<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory;

    protected $fillable=['name','sheet_type_patient_id'];

    /**
     * Get the SheetTypePatient that owns the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sheetTypePatient(): BelongsTo
    {
        return $this->belongsTo(SheetTypePatient::class, 'sheet_type_patient_id');
    }
}
