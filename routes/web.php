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
    // Route::get('/donor', [Admin\DashboardController::class, 'donor'])->name('donors');
});
Route::name('donor.')->prefix('donor')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [Admin\DashboardController::class, 'donor'])->name('donors');
    Route::get('/create', [Admin\DashboardController::class, 'addDonor'])->name('createDonor');
   
});
Route::name('hospital.')->prefix('hospital')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [Admin\DashboardController::class, 'hospital'])->name('hospitals');
    Route::get('/create', [Admin\DashboardController::class, 'addHospital'])->name('createHospital');
   
});

Route::name('request.')->prefix('request')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'request'])->name('requests');

});
Route::name('requestHistory.')->prefix('requestHistory')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'requestHistory'])->name('history');
    Route::get('/create', [Admin\DashboardController::class, 'addRequest'])->name('createRequest');
   
   
});
Route::name('stock.')->prefix('stock')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'stock'])->name('stocks');
    Route::get('/create', [Admin\DashboardController::class, 'addStock'])->name('createStock');

});
