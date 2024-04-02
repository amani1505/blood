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
