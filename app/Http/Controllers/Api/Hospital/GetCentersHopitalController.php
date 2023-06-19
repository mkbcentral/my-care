<?php

namespace App\Http\Controllers\Api\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Resources\CenterHospitalResource;
use App\Models\CenterHospital;
use Exception;
use Illuminate\Http\Request;

class GetCentersHopitalController extends Controller
{
    public function __invoke($hospital){
        try {
           $centers=CenterHospital::where('hospital_id',$hospital)
                ->with('hospital')
                ->get();
            return CenterHospitalResource::collection($centers);
        } catch (Exception $ex) {
            return response()->json([
                'error'=>$ex->getMessage()
            ]);
        }
    }

}
