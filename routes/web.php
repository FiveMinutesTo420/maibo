<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Models\Doctor;

#TODO::Список услуг и врачей определенной клиники
Route::get('/', HomeController::class);
Route::get('/doctors', [HomeController::class, 'doctors'])->name('doctors');
Route::get('/clinics', [HomeController::class, 'clinics'])->name('clinics');
Route::get('/clinic/{clinic}', [HomeController::class, 'clinic'])->name('clinic');
Route::get('/doctor/{doctor}', [HomeController::class, 'doctor'])->name('doctor');
Route::get('/service/{service}', [HomeController::class, 'service'])->name('service');
