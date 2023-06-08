<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
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
            'id_code'=>$this->id_code,
            'gender'=>$this->gender,
            'social_security_number'=>$this->social_security_number,
            'emergency_contact_name'=>$this->emergency_contact_name,
            'emergency_contact_phone_number'=>$this->emergency_contact_phone_number,
            'blood_group'=>$this->blood_group,
            'address_street'=>$this->address_street,
            'address_city'=>$this->address_city,
            'user'=>new UserResource($this->user),
            'country'=>new CountryResource($this->country)

        ];
    }
}
