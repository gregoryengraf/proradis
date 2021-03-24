<?php

use Illuminate\Support\Facades\Route;

Route::get('vacine', [App\Http\Controllers\VacineController::class, 'index']);
Route::post('vacine', [App\Http\Controllers\VacineController::class, 'store']);
Route::get('patient', [App\Http\Controllers\PatientController::class, 'index']);
Route::post('patient', [App\Http\Controllers\PatientController::class, 'store']);
Route::post('patient-register-application/{patient}', [App\Http\Controllers\PatientController::class, 'registerApplication']);
