<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultationSheetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'sheet_number'=>$this->sheet_number,
            'hospital'=>new HospitalResource($this->hospital),
            'center'=>new CenterHospitalResource($this->center),
        ];
    }
}
