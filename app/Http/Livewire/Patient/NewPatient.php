<?php

namespace App\Http\Livewire\Patient;

use App\Helpers\Others\DateFormatHelper;
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

    protected $listeners = ['getStatusPatient' => 'getStatus'];
    public Patient $patientData;
    public  $full_name, $date_of_birth, $gender, $social_security_number, $emergency_contact_name,
        $emergency_contact_phone_number, $blood_group_id, $district, $address_street, $address_street_number,
        $municipality_id, $consultation_id,
        $sheet_type_patient_id, $service_id, $company_id, $consulmtation_id;
    public  $selectedindex = 0;

    public  $country_id, $city_id;
    public string $idPatientToSearch;
    public $listCountries = [], $listCities = [], $listMunicipalities = [],
        $listSheetTypePatient = [], $listServices = [], $listCompanies = [], $dataInputs,
        $listConsultations = [], $listGenders = [], $listBloodGroups = [];
    public bool $isCompany = false, $isService = false, $isPrivate;
    public $typeSheet;

    public function getStatus(SheetTypePatient $type)
    {
        $this->typeSheet = $type;
    }

    public function updatedCountryId($val)
    {
        $this->loadCitiesByCountry($val);
    }

    public function updatedCityId($val)
    {
        $this->loadMunicipalitiesByCityId($val);
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
            $this->patientData = $patient;
            # code...289
        } else {
            $this->dispatchBrowserEvent('deleted', ['message' => "Vous n'avez pas d'ID!"]);
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

    public function handlerSubmit()
    {
        $request = new PatientRequest();
        $data = $this->validate($request->rules());
        $data['date_of_birth'] = (new DateFormatHelper())->formatDate($this->date_of_birth);
        $data['sheet_type_patient_id'] = $this->sheet_type_patient_id;
        $patient = (new PatientCreateHelper())->create($data);
        $sheet = (new PatientCreateHelper())->createConsultationSheet($data, $patient->id);
        (new PatientCreateHelper())->createConsultationRequest($data['consultation_id'], $sheet->id);
        $this->dispatchBrowserEvent('added', ['message' => "Infos bien ajoutées !"]);
        $this->emit('refreshListPatients');
    }

    public function mount()
    {
        $this->listCountries = Country::all();
        $this->listSheetTypePatient = SheetTypePatient::all();
        $this->listConsultations = Consultation::all();
        $this->listBloodGroups = BloodGroup::all();
        $this->listGenders = Gender::all();
        $this->emit('getStatusPatient');
    }

    public function getCurrentTypeSheet()
    {
        if ($this->typeSheet == null) {
            $myType = SheetTypePatient::find(1);
            if ($myType->slug == 'pv') {
                $this->sheet_type_patient_id = $myType->id;
                $this->isService = false;
                $this->isCompany = false;
                $this->company_id = null;
                $this->service_id = null;
            } elseif ($myType->slug == 'abn') {
                $this->sheet_type_patient_id = $myType->id;
                $this->getCompaniesByTypePatientId($myType->id);
                $this->isService = false;
                $this->isCompany = true;
                $this->service_id = null;
            } elseif ($myType->slug == 'prsnl') {
                $this->sheet_type_patient_id = $myType->id;
                $this->getServicesByTypePatientId($myType->id);
                $this->isService = true;
                $this->isCompany = false;
                $this->company_id = null;;
            }
        } else {
            if ($this->typeSheet->name == 'pv') {
                $this->sheet_type_patient_id = $this->typeSheet->id;
                $this->isService = false;
                $this->isCompany = false;
                $this->company_id = null;
                $this->service_id = null;
            } elseif ($this->typeSheet->name == 'abn') {
                $this->sheet_type_patient_id = $this->typeSheet->id;
                $this->getCompaniesByTypePatientId($this->typeSheet->id);
                $this->isService = false;
                $this->isCompany = true;
                $this->service_id = null;
            } elseif ($this->typeSheet->name == 'prsnl') {
                $this->sheet_type_patient_id = $this->typeSheet->id;
                $this->getServicesByTypePatientId($this->typeSheet->id);
                $this->isService = true;
                $this->isCompany = false;
                $this->company_id = null;
            }
        }
    }
    public function render()
    {
        $this->getCurrentTypeSheet();
        return view('livewire.patient.new-patient');
    }
}
