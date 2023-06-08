<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HospitalResource extends JsonResource
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
            'abbreviation'=>$this->abbreviation,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'aderesse'=>$this->city.',C/'.$this->city.',N°'.$this->number_street.',AV/'.$this->street,
            'city'=>$this->city,
            'number_street'=>$this->number_street,
            'street'=>$this->street,
            'long'=>$this->long,
            'lat'=>$this->lat,
        ];
    }
}
