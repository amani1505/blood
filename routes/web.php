<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, Admin};

// Auth
Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout');
});

// Routes
$routes = Route::getRoutes();
Route::view('routes', 'routes', compact('routes'));

// Admin
Route::name('admin.')->prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');
   
});

Route::name('bloodType.')->prefix('bloodType')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [Admin\BloodTypeController::class, 'index'])->name('bloodTypies');
    Route::get('/create', [Admin\BloodTypeController::class, 'create'])->name('createBloodType');
    Route::post('/store', [Admin\BloodTypeController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [Admin\BloodTypeController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [Admin\BloodTypeController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [Admin\BloodTypeController::class, 'destroy'])->name('delete');
   
});
Route::name('stock.')->prefix('stock')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [Admin\BloodStockController::class, 'index'])->name('stocks');
    Route::get('/create', [Admin\BloodStockController::class, 'create'])->name('create');
    Route::post('/store', [Admin\BloodStockController::class, 'store'])->name('store');

});





Route::name('hospital.')->prefix('hospital')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [Admin\HospitalsController::class, 'index'])->name('hospitals');
    // Route::get('/create', [Admin\DashboardController::class, 'addHospital'])->name('createHospital');
   
});

Route::name('request.')->prefix('request')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'request'])->name('requests');

});
Route::name('requestHistory.')->prefix('requestHistory')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'requestHistory'])->name('history');
    Route::get('/create', [Admin\DashboardController::class, 'addRequest'])->name('createRequest');
   
   
});
