<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

#TODO::Моб.Версию Списка клиник, запись, админка.
Route::get('/', HomeController::class);
Route::get('/doctors', [HomeController::class, 'doctors'])->name('doctors');
Route::get('/clinics', [HomeController::class, 'clinics'])->name('clinics');
Route::get('/clinic/{clinic}', [HomeController::class, 'clinic'])->name('clinic');
Route::get('/doctor/{doctor}', [HomeController::class, 'doctor'])->name('doctor');
Route::get('/service/{service}', [HomeController::class, 'service'])->name('service');
Route::post('/appointment/{clinic}/{doctor}', [HomeController::class, 'appoint'])->name('appointment');
