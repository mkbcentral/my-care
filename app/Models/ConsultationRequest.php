<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsultationRequest extends Model
{
    use HasFactory;

    protected $fillable=['number_request','consultation_id','consultation_sheet_id'];

     /**
     * Get the consultationSheet that owns the ConsultationSeeder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consultationSheet(): BelongsTo
    {
        return $this->belongsTo(ConsultationSheet::class, 'consultation_sheet_id');
    }

    /**
     * Get the consultation that owns the ConsultationRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consultation(): BelongsTo
    {
        return $this->belongsTo(Consultation::class, 'consumtation_id');
    }
}
