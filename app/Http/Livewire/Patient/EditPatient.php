<?php

namespace App\Http\Livewire\Patient;

use App\Helpers\Patient\PatientCreateHelper;
use App\Http\Requests\PatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\BloodGroup;
use App\Models\City;
use App\Models\Company;
use App\Models\Consultation;
use App\Models\Country;
use App\Models\Gender;
use App\Models\Municipality;
use App\Models\Patient;
use App\Models\Service;
use App\Models\SheetTypePatient;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class EditPatient extends Component
{
    public $patient,$patientData;
    public  $full_name, $date_of_birth, $gender, $social_security_number, $emergency_contact_name,
        $emergency_contact_phone_number, $blood_group_id, $district, $address_street, $address_street_number,
        $municipality_id;
    public  $country_id, $city_id;
    public $listCountries = [], $listCities = [], $listMunicipalities = [],
        $listGenders = [], $listBloodGroups = [];

    public function updatedCountryId($val)
    {
        $this->loadCitiesByCountry($val);
    }

    public function updatedCityId($val)
    {
        $this->loadMunicipalitiesByCityId($val);
    }

    public function loadCitiesByCountry($id)
    {
        $this->listCities = City::where('country_id', $id)->get();
    }

    public function loadMunicipalitiesByCityId($id)
    {
        $this->listMunicipalities = Municipality::where('city_id', $id == null ? $this->country_id : $id)->get();
    }

    public function handlerSubmit()
    {
        $request = new UpdatePatientRequest();
        $data = $this->validate($request->rules());
        $patient = (new PatientCreateHelper())->update($this->patientData->id, $data);
        dd('Update');
    }


    public function mount(Patient $patient)
    {

        $this->patientData = $patient;
        $patient->user == null ? $this->full_name = $patient->full_name : $this->full_name = $patient->user->name;
        $this->date_of_birth = $patient->date_of_birth;
        $this->gender = $patient->gender;
        $this->social_security_number = $patient?->social_security_number;
        $this->emergency_contact_phone_number = $patient->emergency_contact_phone_number;
        $this->emergency_contact_name = $patient->emergency_contact_name;
        $this->blood_group_id = $patient->blood_group_id;
        $this->municipality_id = $patient->municipality_id;
        $this->district = $patient->district;
        $this->address_street = $patient->address_street;
        $this->address_street_number = $patient->address_street_number;
        $this->city_id = $patient->city_id;
        $this->country_id = $patient->country_id;

        $this->listCountries = Country::all();
        $this->listBloodGroups = BloodGroup::all();
        $this->listGenders = Gender::all();
        $this->listCities = City::where('country_id', $this->country_id)->get();
        $this->listMunicipalities = Municipality::where('city_id', $this->city_id)->get();
    }
    public function render()
    {
        return view('livewire.patient.edit-patient');
    }
}
