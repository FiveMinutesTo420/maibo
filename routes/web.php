<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

#TODO::Админка для владельца(добавление врачей,услуг к клинике).
Route::get('/', HomeController::class)->name('home');
Route::get('/doctors', [HomeController::class, 'doctors'])->name('doctors');
Route::get('/clinics', [HomeController::class, 'clinics'])->name('clinics');
Route::get('/clinic/{clinic}', [HomeController::class, 'clinic'])->name('clinic');
Route::get('/doctor/{doctor}', [HomeController::class, 'doctor'])->name('doctor');
Route::get('/service/{service}', [HomeController::class, 'service'])->name('service');
Route::post('/appointment/{clinic}/{doctor}', [HomeController::class, 'appoint'])->name('appointment');

Route::get('/auth', [HomeController::class, 'auth'])->name('auth');
Route::post("/auth", [HomeController::class, 'authStore'])->name('auth.store');
Route::middleware(['auth'])->group(function () {
    Route::get("/user/clinic/add", [HomeController::class, 'addClinicUser'])->name('add.clinic.user');
    Route::post('/user/clinic/store', [HomeController::class, 'StoreClinic'])->name('store.clinic.user');

    Route::get("/my/clinics", [HomeController::class, 'myClinics'])->name('myClinics');
});

Route::get('/user/clinic/change/{clinic}', [HomeController::class, 'changeClinic'])->name('change.clinic.user');

Route::post('/user/clinic/change/store/{clinic}', [HomeController::class, 'UpdateStoreClinic'])->name('store.change.clinic.user');
Route::post('/user/clinic/add/service/{clinic}', [HomeController::class, 'StoreServiceClinic'])->name('store.service.clinic');
Route::post('/user/clinic/add/specialist/{clinic}', [HomeController::class, 'AddDoctorClinic'])->name('add.doctor.clinic');

Route::get('/logout', [HomeController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'admin'])->group(function () {
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

    Route::post('/admin/clinic/add/specialist/{clinic}', [AdminController::class, 'AddDoctorClinic'])->name('add.doctor.clinic.admin');


    Route::get('/admin/clinic/add', [AdminController::class, 'addClinic'])->name('add.clinic');
    Route::post('/admin/clinic/store', [AdminController::class, 'StoreClinic'])->name('store.clinic');

    Route::post('/admin/clinic/add/service/{clinic}', [AdminController::class, 'StoreServiceClinic'])->name('store.service.clinic.admin');


    Route::get('/admin/clinic/change/{clinic}', [AdminController::class, 'changeClinic'])->name('change.clinic');
    Route::post('/admin/clinic/change/store/{clinic}', [AdminController::class, 'UpdateStoreClinic'])->name('store.change.clinic');

    Route::get('/admin/clinic/delete/{clinic}', [AdminController::class, 'DeleteClinic'])->name('delete.clinic');

    Route::get('/admin/delete/app/{app}', [AdminController::class, 'deleteApp'])->name('delete.app');
    Route::get('/admin/change/app/{app}', [AdminController::class, 'UpdateApp'])->name('update.app');
    Route::post('/admin/store/app/{app}', [AdminController::class, 'UpdateStoreApp'])->name('update.store.app');

    Route::get('/reg', [AdminController::class, 'reg'])->name('regUser');
    Route::post('/reg', [AdminController::class, 'regStore'])->name('reg.store');
});
