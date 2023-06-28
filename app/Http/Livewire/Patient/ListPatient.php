<?php

namespace App\Http\Livewire\Patient;

use App\Models\ConsultationSheet;
use App\Models\Patient;
use App\Models\SheetTypePatient;
use Livewire\Component;

class ListPatient extends Component
{
    protected $listeners = ['refreshListPatients' => '$refresh'];
    public $keyToSearch = '';
    public  $listSheetTypePatient = [];
    public $selectedIndex = 0;
    public $typeLabel = 'pv';
    public  $patient = null;

    public function mount()
    {
        $currentSheetTypePatient = SheetTypePatient::where('slug', $this->typeLabel)->first();
        $this->selectedIndex = $currentSheetTypePatient->id;
        $this->listSheetTypePatient = SheetTypePatient::all();
    }
    public function changeIndex(SheetTypePatient $type)
    {
        $this->selectedIndex = $type->id;
        $this->patient = null;
        $this->emit('getStatusPatient', $type);
        $this->keyToSearch='';
    }
    public function show(Patient $patient)
    {
        $this->patient = $patient;
        $this->emit('selectedPatient', $patient);
    }
    public function render()
    {
        $listSheets = ConsultationSheet::where('consultation_sheets.sheet_type_patient_id', $this->selectedIndex)
            ->with(['patient', 'sheetTypePatient', 'patient.bloodGroup', 'service', 'company'])
            ->join('patients', 'consultation_sheets.patient_id', '=', 'patients.id')
            ->select('consultation_sheets.*')
            ->where('patients.full_name', 'like', '%' . $this->keyToSearch . '%')
            ->get();
        return view('livewire.patient.list-patient', ['listSheets' => $listSheets]);
    }
}
