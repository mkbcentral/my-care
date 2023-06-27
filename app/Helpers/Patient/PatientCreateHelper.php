<?php

namespace App\Helpers\Patient;

use App\Models\ConsultationRequest;
use App\Models\ConsultationSheet;
use App\Models\Patient;

class PatientCreateHelper{

    public function create(array $data):Patient{
        return Patient::create($data);
    }

    public function update(int $id,array $data):Patient{
        $patient=Patient::find($id);
        $patient->update($data);
        return $patient;
    }

    public function createConsultationSheet(array $data,$patientId):ConsultationSheet{
       return ConsultationSheet::create([
            'sheet_number'=>rand(100,1000),
            'patient_id'=>$patientId,
            'center_hospital_id'=>1,
            'sheet_type_patient_id'=>$data['sheet_type_patient_id'],
            'company_id'=>$data['company_id'],
            'service_id'=>$data['service_id']
        ]);
    }

    public function createConsultationRequest($consultationId,$consultationSheetId){
        ConsultationRequest::create([
            'number_request'=>rand(1000,10000),
            'consultation_sheet_id'=>$consultationSheetId,
            'consultation_id'=>$consultationId
        ]);
    }

}
