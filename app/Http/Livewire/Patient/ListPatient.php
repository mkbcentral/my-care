<?php

namespace App\Http\Livewire\Patient;

use App\Models\ConsultationSheet;
use App\Models\Patient;
use App\Models\SheetTypePatient;
use Livewire\Component;

class ListPatient extends Component
{
    public  $listSheetTypePatient=[];
    public $selectedIndex=0;
    public $typeLabel='Privé';
    public  $patient =null;

    public function mount(){
        $currentSheetTypePatient=SheetTypePatient::where('name',$this->typeLabel)->first();
        $this->selectedIndex=$currentSheetTypePatient->id;
        $this->listSheetTypePatient=SheetTypePatient::all();
    }
    public function changeIndex(SheetTypePatient $type){
        $this->selectedIndex=$type->id;
        $this->patient=null;
    }

    public function show(Patient $patient){
        $this->patient=null;
        $this->patient=$patient;
    }

    public function render()
    {
        $listSheets=ConsultationSheet::where('sheet_type_patient_id',$this->selectedIndex)->get();
        return view('livewire.patient.list-patient',['listSheets'=>$listSheets]);
    }


}
