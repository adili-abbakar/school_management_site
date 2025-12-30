<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;





Route::middleware('guest')->group(function(){
	Route::get('/', [PublicController::class, 'index'])->name('home');
	Route::get('/about', [PublicController::class, 'about'])->name('about');
	Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
	Route::get('/apply', [AdmissionController::class, 'index'])->name('apply');
	Route::get('/login', [LoginController::class, 'index'])->name('login');
	Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');
	Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('reset-password');
});



Route::middleware('auth')->group(function () {
});