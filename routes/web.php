<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

#TODO:: Редактирование и добавление специалистов клиники.Редактирование и добавление организаций.Редактирование и добавление услуг.Возможность изменения и удаления записей в датах.
Route::get('/', HomeController::class);
Route::get('/doctors', [HomeController::class, 'doctors'])->name('doctors');
Route::get('/clinics', [HomeController::class, 'clinics'])->name('clinics');
Route::get('/clinic/{clinic}', [HomeController::class, 'clinic'])->name('clinic');
Route::get('/doctor/{doctor}', [HomeController::class, 'doctor'])->name('doctor');
Route::get('/service/{service}', [HomeController::class, 'service'])->name('service');
Route::post('/appointment/{clinic}/{doctor}', [HomeController::class, 'appoint'])->name('appointment');
Route::get("/admin", AdminController::class)->name('admin');
