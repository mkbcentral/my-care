<?php

use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Hospital\ConpanyController;
use App\Http\Controllers\Api\Patient\CategoryPatientController;
use App\Http\Controllers\Api\Patient\ConsultationSheetControlller;
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
Route::post('login',\App\Http\Controllers\Api\Auth\Logincontroller::class);
Route::middleware('auth:sanctum')->group(function (){
    Route::resource('user',\App\Http\Controllers\Api\Admin\UserController::class);
    Route::resource('role',\App\Http\Controllers\Api\Admin\RoleController::class);
    Route::resource('permission',\App\Http\Controllers\Api\Admin\PermissionController::class);
    Route::resource('hospital',\App\Http\Controllers\Api\Hospital\HospitalController::class);
    Route::resource('center-hospital',\App\Http\Controllers\Api\Hospital\CenterHospitalController::class);
    Route::resource('country',\App\Http\Controllers\Api\Hospital\CountryController::class);
    Route::resource('company',ConpanyController::class);
    Route::resource('patient',PatientController::class);
    Route::resource('sheet',ConsultationSheetControlller::class);

    Route::get('logout',[UserController::class,'logout']);
    Route::get('user-info/{id}',[UserController::class,'getUserInfos']);
});
