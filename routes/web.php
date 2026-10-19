<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\VeterinarianController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->name('dashboard');

Route::resource('owners', OwnerController::class);
Route::resource('pets', PetController::class);
Route::resource('veterinarians', VeterinarianController::class);
Route::resource('appointments', AppointmentController::class);
Route::resource('treatments', TreatmentController::class);
