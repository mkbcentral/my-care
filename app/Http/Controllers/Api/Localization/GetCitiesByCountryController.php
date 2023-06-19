<?php

namespace App\Http\Controllers\Api\Localization;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Models\City;
use Exception;
use Illuminate\Http\Request;

class GetCitiesByCountryController extends Controller
{
    public function __invoke($country)
    {
        try {
            $cities = City::where('country_id', $country)
                ->get();
            return CityResource::collection($cities);
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage()
            ]);
        }
    }
}
