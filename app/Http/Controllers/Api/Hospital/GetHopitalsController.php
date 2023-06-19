<?php

namespace App\Http\Controllers\Api\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Resources\HospitalResource;
use App\Models\Hospital;
use Exception;
use Illuminate\Http\Request;

class GetHopitalsController extends Controller
{
    public function __invoke(){
        try {
           $centers=Hospital::where('is_active',true)
                ->get();
            return HospitalResource::collection($centers);
        } catch (Exception $ex) {
            return response()->json([
                'error'=>$ex->getMessage()
            ]);
        }
    }
}
