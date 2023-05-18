<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CenterHospitalResource extends JsonResource
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
            'name'=>$this->name,
            'center_phone'=>$this->center_phone,
            'city'=>$this->city,
            'street'=>$this->street,
            'number_street'=>$this->number_street,
            'long'=>$this->long,
            'lat'=>$this->lat,
        ];
    }
}
