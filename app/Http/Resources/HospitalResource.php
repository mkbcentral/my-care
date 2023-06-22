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
            'logo'=>config('app.url').'/public/storage/'. $this->logo,
            'country'=>$this->country->flag.' '.$this->country->name
        ];
    }
}
