<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConsultationSheetResource;
use App\Models\ConsultationSheet;
use Exception;
use Illuminate\Http\Request;

class ConsultationSheetControlller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allSheets = ConsultationSheet::orderBy('number_sheet', 'ASC')
            ->get();
        return ConsultationSheetResource::collection($allSheets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sheet_number' => ['nullable', 'max:10'],
            'patient_id' => ['required', 'max:10'],
        ]);
        try {
            if($request->is_random==true){
                if (auth()->user()->hospital) {
                    ConsultationSheet::create([
                        'sheet_number' => rand(100,1000),
                        'patient_id' => $request->patient_id,
                        'hospital_id' => 1,
                        'user_id' => auth()->user()->id,
                    ]);
                } else {
                    ConsultationSheet::create([
                        'sheet_number' => rand(100,1000),
                        'patient_id' => $request->patient_id,
                        'center_hospital_id' => 1,
                        'user_id' => auth()->user()->id,
                    ]);
                }
            }else{
                if (auth()->user()->hospital) {
                    ConsultationSheet::create([
                        'sheet_number' => $request->sheet_number,
                        'patient_id' => $request->patient_id,
                        'hospital_id' => 1,
                        'user_id' => auth()->user()->id,
                    ]);
                } else {
                    ConsultationSheet::create([
                        'sheet_number' => $request->sheet_number,
                        'patient_id' => $request->patient_id,
                        'center_hospital_id' => 1,
                        'user_id' => auth()->user()->id,
                    ]);
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Sheet created successffully'
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $sheet = ConsultationSheet::find($id);
            return new ConsultationSheetResource($sheet);
        } catch (Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $sheet = ConsultationSheet::find($id);
            $sheet->sheet_number = $request->sheet_number;
            $sheet->update();
            return response()->json([
                'status' => true,
                'message' => 'Sheet updated successffully'
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $sheet = ConsultationSheet::find($id);
            $sheet->delete();
            return response()->json([
                'status' => true,
                'message' => 'Sheet deleted successffully'
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'status' => false,
                'message' => $ex->getMessage()
            ]);
        }
    }
}
