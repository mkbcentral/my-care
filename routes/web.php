<?php

use App\Http\Controllers\GuestController;
use App\Http\Livewire\Dashboard\MainDashboard;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|Route::get('/',MainDashboard::class)->name('app.dashboard-main');
Route::middleware('auth')->group(function(){

});
*/
Route::middleware('auth')->group(function(){
    Route::get('/',MainDashboard::class)->name('app.dashboard-main');
});


