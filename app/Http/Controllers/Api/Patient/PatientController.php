<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\PatientResource;
use App\Models\ConsultationRequest;
use App\Models\ConsultationSheet;
use App\Models\Patient;
use Exception;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    private bool $status = false;
    private string $message = '';
    private Patient $patient;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $allPatients = Patient::all();
            return PatientResource::collection($allPatients);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'max:1'],
            'social_security_number' => ['nullable', 'max:255'],
            'emergency_contact_name' => ['nullable', 'max:255'],
            'emergency_contact_phone_number' => ['nullable', 'max:255'],
            'blood_group' => ['nullable', 'max:255'],
            'address_street' => ['nullable', 'max:255'],
            'municipality' => ['nullable', 'max:255'],
            'country_id' => ['nullable', 'numeric'],
            'city_id' => ['nullable', 'numeric'],
        ]);

        try {
            $patientToAdd = Patient::create([
                'id_code' => rand(100, 1000),
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'social_security_number' => $request->social_security_number,
                'emergency_contact_name' => $request->emergency_contact_name,
                'emergency_contact_phone_number' => $request->emergency_contact_phone_number,
                'blood_group' => $request->blood_group,
                'municipality' => $request->municipality,
                'address_street' => $request->address_street,
                'address_street_number' => $request->address_street_number,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'user_id' => auth()->user()->id,
            ]);
            if ($patientToAdd) {
                $sheet = ConsultationSheet::create([
                    'sheet_number' => rand(100,1000),
                    'patient_id' => $patientToAdd->id,
                    'center_hospital_id' => $request->center_hospital_id
                ]);
                ConsultationRequest::create([
                    'number_request'=>rand(1000,10000),
                    'consultation_id'=>1,
                    's'=>$sheet->id
                ]);
                $this->status = true;
                $this->message = 'Data submit successffuly';
                $this->patient = $patientToAdd;
            }
            return response()->json([
                'status' => $this->status,
                'message' => $this->message,
                'patient' => $this->patient,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $this->patient = Patient::find($id);
            return new PatientResource($this->patient);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try {
            $patientToEdit = Patient::find($id);
            $patientToEdit->date_of_birth = $request->date_of_birth;
            $patientToEdit->social_security_number = $request->social_security_number;
            $patientToEdit->emergency_contact_name = $request->emergency_contact_name;
            $patientToEdit->emergency_contact_phone_number = $request->emergency_contact_phone_number;
            $patientToEdit->blood_group = $request->blood_group;
            $patientToEdit->municipality = $request->municipality;
            $patientToEdit->address_street = $request->address_street;
            $patientToEdit->address_street_number = $request->address_street_number;
            $patientToEdit->country_id = $request->country_id;
            $patientToEdit->city_id = $request->city_id;
            if ($patientToEdit->update()) {
                $this->status = true;
                $this->message = 'Data submit successffuly';
            }
            return response()->json([
                'status' => $this->status,
                'message' => $this->message,
            ]);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->patient = Patient::find($id);
            if ($this->patient->delete()) {
                $this->status = true;
                $this->message = 'Data deleted successffuly';
            }
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
}
