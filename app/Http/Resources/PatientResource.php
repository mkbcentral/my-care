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
            //'id_code'=>$this->id_code,
            'name'=>$this->user->name,
            'date_of_birth'=>$this->date_of_birth,
            'gender'=>$this->gender,
            'social_security_number'=>$this->social_security_number,
            'emergency_contact_name'=>$this->emergency_contact_name,
            'emergency_contact_phone_number'=>$this->emergency_contact_phone_number,
            'blood_group'=>$this->blood_group,
            'country_name'=>$this->country->flag.' '.$this->country->name,
            'city_name'=>$this->city->name,
            'municipality'=>$this->municipality,
            'address_street'=>$this->address_street,
            'address_street_number'=>$this->address_street,
            'city'=>new CityResource($this->city),
            'user'=>new UserResource($this->user),
            'country'=>new CountryResource($this->country)
        ];
    }
}
