<?php

namespace App\Http\Controllers\Api\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Resources\HospitalResource;
use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    private bool $status=false;
    private string $message='';
    private Hospital $hospital;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allHospitals=Hospital::orderBy('name','ASC')->get();
        return HospitalResource::collection($allHospitals);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_id'=>['required','numeric'],
            'name'=>['required','string','max:255'],
            'abbreviation'=>['nullable','string','max:255'],
            'email'=>['nullable','string','max:255'],
            'logo'=>['nullable','string','max:255'],
            'phone'=>['nullable','string','max:255'],
            'city'=>['nullable','string','max:255'],
            'street'=>['nullable','string','max:255'],
            'number_street'=>['nullable','string','max:255'],
        ]);
        $hospitalToAdd=Hospital::create([
            'name'=>$request->name,
            'country_id'=>$request->country_id,
            'abbreviation'=>$request->abbreviation,
            'email'=>$request->email,
            'logo'=>$request->logo,
            'phone'=>$request->phone,
            'city'=>$request->city,
            'street'=>$request->street,
            'number_street'=>$request->number_street
        ]);
        if($hospitalToAdd){
            $this->status=true;
            $this->message='Hospital created successfully';
            $this->hospital=$hospitalToAdd;
        }
        return response()->json([
            'status'=>$this->status,
            'message'=>$this->message,
            'hospital'=>$hospitalToAdd
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->hospital=Hospital::find($id);
        return new HospitalResource($this->hospital);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hospitalToEdit=Hospital::find($id);
        $hospitalToEdit->name=$request->name;
        $hospitalToEdit->abbreviation=$request->abbreviation;
        $hospitalToEdit->logo=$request->logo;
        $hospitalToEdit->email=$request->email;
        $hospitalToEdit->phone=$request->phone;
        $hospitalToEdit->city=$request->city;
        $hospitalToEdit->street=$request->street;
        $hospitalToEdit->number_street=$request->number_street;

        if ($hospitalToEdit->update()){
            $this->status=true;
            $this->message='Hospital updated successfully';
            $this->hospital=$hospitalToEdit;
        }
        return response()->json([
            'status'=>$this->status,
            'message'=>$this->message,
            'hospital'=>$this->hospital
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->hospital=Hospital::find($id);
        if ($this->hospital->delete()){
            $this->status=true;
            $this->message='Hospital deleted successfully';
        }
        return response()->json([
            'status'=>$this->status,
            'message'=>$this->message,
        ],200);
    }
}
