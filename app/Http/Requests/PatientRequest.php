<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'full_name'=>['required','string'],
            'date_of_birth'=>['required','date'],
            'gender'=>['required','string'],
            'social_security_number'=>['nullable','string'],
            'emergency_contact_name'=>['nullable','string'],
            'emergency_contact_phone_number'=>['nullable','string'],
            'blood_group_id'=>['required','numeric'],
            'district'=>['nullable','string'],
            'address_street'=>['nullable','string'],
            'address_street_number'=>['nullable','string'],
            'country_id'=>['required','numeric'],
            'city_id'=>['required','numeric'],
            'municipality_id'=>['required','numeric'],
            'company_id'=>['nullable','numeric'],
            'service_id'=>['nullable','numeric'],
            'consultation_id'=>['required','numeric'],
        ];
    }
}
