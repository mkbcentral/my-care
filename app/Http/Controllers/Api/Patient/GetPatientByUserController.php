<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Exception;
use Illuminate\Http\Request;

class GetPatientByUserController extends Controller
{
    public function __invoke()
    {
        try {
            $patient=Patient::where('user_id',auth()->user()->id)
                 ->first();
            if ($patient) {
                return new PatientResource($patient);
            }else{
                return response()->json(['daat'=>null]);
            }

         } catch (Exception $ex) {
             return response()->json([
                 'error'=>$ex->getMessage()
             ]);
         }
    }
}
