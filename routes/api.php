<?php

use App\Http\Controllers\Api\Auth\Logincontroller;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Hospital\GetCentersHopitalController;
use App\Http\Controllers\Api\Hospital\GetHopitalsController;
use App\Http\Controllers\Api\Localization\GetCitiesByCountryController;
use App\Http\Controllers\Api\Localization\GetCountriesController;
use App\Http\Controllers\Api\Patient\GetPatientByUserController;
use App\Http\Controllers\Api\Patient\PatientController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

*/
Route::post('register',RegisterController::class);
Route::post('login',Logincontroller::class);

Route::get('countries',GetCountriesController::class);
Route::get('cities/{country}',GetCitiesByCountryController::class);

Route::middleware('auth:sanctum')->group(function (){
    Route::resource('patient',PatientController::class);
    Route::get('center-hospital/{hospital}',GetCentersHopitalController::class);
    Route::get('hospital',GetHopitalsController::class);
    Route::get('patient-by-user',GetPatientByUserController::class);
    Route::get('logout',[UserController::class,'logout']);
    Route::get('user-info/{id}',[UserController::class,'getUserInfos']);
});
