<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Api\PatientRecordController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Models\Appointment;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Authentication routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [AuthController::class, 'getUserProfile']);
    Route::post('/user/update', [AuthController::class, 'updateProfile']);
});

//user management

Route::get('/users', [UserController::class, 'getUsers']); // Fetch users


//Doctors
Route::post('/doctors', [DoctorController::class, 'store']);

Route::get('/doctors', [DoctorController::class, 'index']);

Route::delete('/doctors/{id}', [DoctorController::class, 'destroy']);

Route::get('/doctors/{doctor}/appointments', [DoctorController::class, 'getAppointments']);



//Patients 
Route::post('/patient-records', [PatientRecordController::class, 'store']);
Route::get('/patient-records', [PatientRecordController::class, 'index']);


//clinics
Route::post('/clinics', [ClinicController::class, 'store']);

Route::get('/clinics', [ClinicController::class, 'getClinics']);

Route::get('/clinics/{id}', [ClinicController::class, 'getClinicById']);

Route::get('/clinics/{id}', [ClinicController::class, 'show']);


//Appointment



Route::post('/appointments', [AppointmentController::class, 'store']);

Route::get('/appointments', [AppointmentController::class, 'index']);

Route::put('/appointments/{id}', [AppointmentController::class, 'update']);
Route::get('/appointments/count', function () {
    $count = Appointment::count();
    return response()->json(['count' => $count]);
});