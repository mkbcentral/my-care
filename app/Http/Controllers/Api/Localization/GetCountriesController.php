<?php

namespace App\Http\Controllers\Api\Localization;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use Exception;
use Illuminate\Http\Request;

class GetCountriesController extends Controller
{
    public function __invoke()
    {
        try {
            $countries=Country::orderBy('name','asc')
                 ->get();
             return CountryResource::collection($countries);
         } catch (Exception $ex) {
             return response()->json([
                 'error'=>$ex->getMessage()
             ]);
         }
    }
}
