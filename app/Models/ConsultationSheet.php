<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultationSheet extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'sheet_number',
        'patient_id',
        'center_hospital_id',
        'active',
        'company_id',
        'service_id',
        'sheet_type_patient_id'
    ];

    /**
     * Get the patient that owns the ConsultationSheet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    /**
     * Get the center that owns the ConsultationSheet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function centerHospital(): BelongsTo
    {
        return $this->belongsTo(CenterHospital::class, 'center_hospital_id');
    }

    /**
     * Get the compnay that owns the ConsultationSheet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * Get the service that owns the ConsultationSheet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    /**
     * Get the sheetTypePatient that owns the ConsultationSheet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sheetTypePatient(): BelongsTo
    {
        return $this->belongsTo(SheetTypePatient::class, 'sheet_type_patient_id');
    }

    public function getTypeSheet(): string
    {
        $type = '';
        if ($this->sheetTypePatient->slug == 'pv') {
            $type = $this->sheetTypePatient->name;
        } elseif ($this->sheetTypePatient->slug == 'abn') {
            $type = $this->sheetTypePatient->name . '/' . $this->company->name;
        } elseif ($this->sheetTypePatient->slug == 'prsnl') {
            $type = $this->sheetTypePatient->name . '/' . $this->service->name;
        }
        return $type;
    }
}
