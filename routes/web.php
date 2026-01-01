<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;





Route::middleware('guest')->group(function () {

	Route::get('/login', [LoginController::class, 'index'])->name('login');
	Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');

	Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');
	Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('reset-password');
});

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::get('admission/apply', [AdmissionController::class, 'index'])->name('admission.apply');
Route::get("/news", [NewsController::class, 'index'])->name('news');


// Route::middleware(['auth'])->group(function () {
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
	Route::get('/dashboard/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');
// });
