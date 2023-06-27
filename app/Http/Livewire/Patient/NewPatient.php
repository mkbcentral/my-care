<?php

namespace App\Http\Livewire\Patient;

use App\Helpers\Patient\PatientCreateHelper;
use App\Http\Requests\PatientRequest;
use App\Models\BloodGroup;
use App\Models\City;
use App\Models\Company;
use App\Models\Consultation;
use App\Models\ConsultationSheet;
use App\Models\Country;
use App\Models\Gender;
use App\Models\Municipality;
use App\Models\Patient;
use App\Models\Service;
use App\Models\SheetTypePatient;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class NewPatient extends Component
{
    public Patient $patientData;
    public  $full_name, $date_of_birth, $gender, $social_security_number, $emergency_contact_name,
        $emergency_contact_phone_number, $blood_group_id, $district, $address_street, $address_street_number,
         $municipality_id,$consultation_id,
        $sheet_type_patient_id, $service_id, $company_id,$consulmtation_id;

    public  $country_id, $city_id;
    public string $idPatientToSearch;
    public $listCountries = [], $listCities = [], $listMunicipalities = [],
        $listSheetTypePatient = [], $listServices = [], $listCompanies = [],$dataInputs,
        $listConsultations = [],$listGenders=[],$listBloodGroups=[];
    public bool $isCompany = false, $isService = false;

    public function updatedCountryId($val)
    {
        $this->loadCitiesByCountry($val);
    }

    public function updatedCityId($val)
    {
        $this->loadMunicipalitiesByCityId($val);
    }

    public function updatedsheetTypePatientId($val)
    {
        if ($this->getServicesByTypePatientId($val)->isEmpty() && $this->getCompaniesByTypePatientId($val)->isEmpty()) {
            $this->isService = false;
            $this->isCompany = false;
            $this->company_id=null;
            $this->service_id=null;
        } elseif (!$this->getServicesByTypePatientId($val)->isEmpty()) {
            $this->getServicesByTypePatientId($val);
            $this->isService = true;
            $this->isCompany = false;
            $this->company_id=null;
        } elseif (!$this->getCompaniesByTypePatientId($val)->isEmpty()) {
            $this->getCompaniesByTypePatientId($val);
            $this->isService = false;
            $this->isCompany = true;
            $this->service_id=null;
        }
    }

    public function getServicesByTypePatientId($id): Collection
    {
        return $this->listServices = Service::where('sheet_type_patient_id', $id)->get();
    }

    public function getCompaniesByTypePatientId($id): Collection
    {
        return $this->listCompanies = Company::where('sheet_type_patient_id', $id)->get();
    }

    public function getPatientById()
    {
        $this->validate(['idPatientToSearch' => ['string', 'required']]);
        $patient = Patient::where('id_code', $this->idPatientToSearch)->first();
        if ($patient) {
            $this->patientData = $patient;
            $patient->user==null?$this->full_name = $patient->full_name:$this->full_name = $patient->user->name;
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
            $this->patientData=$patient;
            # code...289
        } else {
            dd('Veuillez completer à la mains !');
        }
    }
    public function loadCitiesByCountry($id)
    {
        $this->listCities = City::where('country_id', $id)->get();
    }

    public function loadMunicipalitiesByCityId($id)
    {
        $this->listMunicipalities = Municipality::where('city_id', $id)->get();
    }

    public function handlerSubmit(){
        $request=new PatientRequest();
        $data=$this->validate($request->rules());
        $patient=(new PatientCreateHelper())->create($data);
        $sheet=(new PatientCreateHelper())->createConsultationSheet($data,$patient->id);
        (new PatientCreateHelper())->createConsultationRequest($data['consultation_id'],$sheet->id);
        dd('saved');
    }





    public function mount()
    {
        $this->listCountries = Country::all();
        $this->listSheetTypePatient = SheetTypePatient::all();
        $this->listConsultations=Consultation::all();
        $this->listBloodGroups=BloodGroup::all();
        $this->listGenders=Gender::all();
    }


    public function render()
    {
        return view('livewire.patient.new-patient');
    }
}
