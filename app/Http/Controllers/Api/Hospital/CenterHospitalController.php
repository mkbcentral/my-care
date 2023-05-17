<?php

namespace App\Http\Controllers\Api\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Resources\CenterHospitalResource;
use App\Models\CenterHospital;
use App\Models\Hospital;
use Illuminate\Http\Request;

class CenterHospitalController extends Controller
{
    private bool $status=false;
    private string $message='';
    private CenterHospital $centerHospital;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allCenters=CenterHospital::orderBy('name','ASC')->get();
        return CenterHospitalResource::collection($allCenters);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hospital_id'=>['required','numeric'],
            'name'=>['required','string','max:255'],
            'center_phone'=>['nullable','string','max:255'],
            'city'=>['nullable','string','max:255'],
            'street'=>['nullable','string','max:255'],
            'number_street'=>['nullable','string','max:255'],
        ]);
        $centerToAdd=CenterHospital::create([
            'hospital_id'=>$request->hospital_id,
            'name'=>$request->name,
            'center_phone'=>$request->phone,
            'city'=>$request->city,
            'street'=>$request->street,
            'number_street'=>$request->number_street
        ]);
        if($centerToAdd){
            $this->status=true;
            $this->message='Center hospital created successfully';
            $this->centerHospital=$centerToAdd;
        }
        return response()->json([
            'status'=>$this->status,
            'message'=>$this->message,
            'center'=>$centerToAdd
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->centerHospital=CenterHospital::find($id);
        return new CenterHospitalResource($this->centerHospital);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $centerHospitalToEdit=CenterHospital::find($id);
        $centerHospitalToEdit->name=$request->name;
        $centerHospitalToEdit->center_phone=$request->center_phone;
        $centerHospitalToEdit->city=$request->city;
        $centerHospitalToEdit->street=$request->street;
        $centerHospitalToEdit->number_street=$request->number_street;

        if ($centerHospitalToEdit->update()){
            $this->status=true;
            $this->message='Center hospital updated successfully';
            $this->centerHospital=$centerHospitalToEdit;
        }
        return response()->json([
            'status'=>$this->status,
            'message'=>$this->message,
            'center'=>$this->centerHospital
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->centerHospital=CenterHospital::find($id);
        if ($this->centerHospital->delete()){
            $this->status=true;
            $this->message='Center hospital deleted successfully';
        }
        return response()->json([
            'status'=>$this->status,
            'message'=>$this->message,
        ],200);
    }
}
