<?php

namespace App\Http\Controllers\Api\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;

class ConpanyController extends Controller
{
    private bool $status=false;
    private string $message='';
    private Company $company;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allCompanies=Company::orderBy('name','ASC')->get();
        return CompanyResource::collection($allCompanies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required','max:255'],
        ]);
        $companyToAdd=Company::create([
            'name'=>$request->name,
        ]);
        if ($companyToAdd){
            $this->status=true;
            $this->message='Company created successfully';
            $this->company=$companyToAdd;
        }
        return response()->json([
            'status'=>$this->status,
            'message'=>$this->message,
            'company'=>$this->company
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->company=Company::find($id);
        return new CompanyResource($this->company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $companyToEdit=Company::find($id);
        $companyToEdit->name=$request->name;
        if ($companyToEdit->update()){
            $this->status=true;
            $this->message='Company created successfully';
            $this->company=$companyToEdit;
        }
        return response()->json([
            'status'=>$this->status,
            'message'=>$this->message,
            '$this->company'=>$this->company
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->company=Company::find($id);
        if ($this->company->delete()){
            $this->status=true;
            $this->message='Comp deleted successfully';
        }
        return response()->json([
            'status'=>$this->status,
            'message'=>$this->message
        ],200);
    }
}
