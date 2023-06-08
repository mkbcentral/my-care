<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\PatientResource;
use App\Models\ConsultationSheet;
use App\Models\Patient;
use Exception;
use finfo;
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
            'address_city' => ['nullable', 'max:255'],
            'country_id' => ['nullable', 'numeric'],
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
                'address_street' => $request->address_street,
                'address_city' => $request->address_city,
                'country_id' => $request->country_id,
                'user_id' => auth()->user()->id,
            ]);
            if ($patientToAdd) {
                $this->status = true;
                $this->message = 'Data submit successffuly';
                $this->patient = $patientToAdd;
            }
            return response()->json([
                'status' => $this->status,
                'message' => $this->message,
                'id_code' => $this->patient->id_code,
            ]);
        } catch (Exception $ex) {
            return $ex->getMessage();
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
            $patientToEdit->address_street = $request->address_street;
            $patientToEdit->address_city = $request->address_city;
            $patientToEdit->country_id = $request->country_id;
            $patientToEdit->hospital_id = $request->hospital_id;
            $patientToEdit->center_hospital_id = $request->center_hospital_id;
            if ($patientToEdit->update()) {
                $this->status = true;
                $this->message = 'Data submit successffuly';
                $this->status = $patientToEdit->update();
            }
            return response()->json([
                'status' => $this->status,
                'message' => $this->message,
                'patient' => $this->patient,
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
