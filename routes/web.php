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

Route::get('/admin/docAdd', [AdminController::class, 'docAdd'])->name('docAdd');
Route::post('/admin/doc/add', [AdminController::class, 'docAddOk'])->name('add.doctor');
Route::get('/admin/docEdit/{doctor}', [AdminController::class, 'docEdit'])->name('docEdit');
Route::get('/admin/docDelete/{doctor}', [AdminController::class, 'doctorDelete'])->name('doctor.delete');
Route::post('/admin/doc/edit/{doctor}', [AdminController::class, 'docEditOk'])->name('docEditOk');

Route::get('/admin/service/add', [AdminController::class, 'serviceAdd'])->name('add.service');
Route::post('/admin/service/store', [AdminController::class, 'serviceStore'])->name('store.service');
Route::get('/admin/service/update/{service}', [AdminController::class, 'serviceUpdate'])->name('update.service');
Route::post('/admin/service/update/store/{service}', [AdminController::class, 'serviceUpdateStore'])->name('update.store.service');
Route::get('/admin/delete/service/{service}', [AdminController::class, 'deleteService'])->name('delete.service');


Route::get('/admin/clinic/add', [AdminController::class, 'addClinic'])->name('add.clinic');
Route::post('/admin/clinic/store', [AdminController::class, 'StoreClinic'])->name('store.clinic');

Route::get('/admin/clinic/change/{clinic}', [AdminController::class, 'changeClinic'])->name('change.clinic');
Route::post('/admin/clinic/change/store/{clinic}', [AdminController::class, 'UpdateStoreClinic'])->name('store.change.clinic');

Route::get('/admin/clinic/delete/{clinic}', [AdminController::class, 'DeleteClinic'])->name('delete.clinic');
