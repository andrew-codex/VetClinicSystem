<?php

use App\Http\Controllers\appointmentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\medRecordController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\userDashboardController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\userProfileController;
use App\Http\Controllers\medicalRecordsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Filament\Pages\POS;

Route::get('', function () {
    return view('welcome');
})->name('home');


Route::get('/userDashboard', [userDashboardController::class, 'index'])->middleware('auth:customer')->name('userDashboard');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.customer');
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.customer');
Route::get('/logout', function () {
    Auth::guard('customer')->logout();
    return redirect()->route('home');
})->name('logout');


Route::middleware(['auth:customer'])->group(function () {
    Route::get('/petPage', [PetController::class, 'index'])->name('petPage');
    Route::post('/create', [PetController::class, 'create'])->name('pet.create');
    Route::get('/{pet}/edit', [PetController::class, 'edit'])->name('pet.edit');
    Route::put('{pet}', action: [PetController::class, 'update'])->name('pet.update');
    Route::delete('/{pet}', [PetController::class, 'destroy'])->name('pet.destroy');
    
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointment.index');

   Route::get('/appointment', [appointmentController::class, 'index'])->name('appointment');
    Route::post('/appointment/create', [appointmentController::class, 'create'])->name('appointment.create');
Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('editAppointment');
   Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointment.update');
Route::get('/userProfile', [userProfileController::class, 'index'])->name('userProfile');
Route::put('/userProfiles/{id}/update', [UserProfileController::class, 'update'])->name('userProfile.update');


   Route::get('/medicalRecords', [medicalRecordsController::class, 'index'])->name('medicalRecords');
    
Route::delete('/appointment/{id}', [appointmentController::class, 'destroy'])->name('appointment.destroy');
});



