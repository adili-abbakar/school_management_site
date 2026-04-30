<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;


Route::middleware(['auth'])->group(function () {

    Route::prefix('dashboard/')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
        Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
    });
});
