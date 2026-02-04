<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Users\StudentController;
use App\Http\Controllers\Users\TeacherController;
use App\Http\Controllers\Users\GuardianController;
use App\Http\Controllers\Users\AdminController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\Academic\SessionController;
use App\Http\Controllers\Academic\TermController;

use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdmissionController;
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
Route::get('/news', [NewsController::class, 'index'])->name('news');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::get('/dashboard/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');

    Route::get('user/{user}/edit-password', [UserController::class, 'editPassword'])->name('user.edit-password');
    Route::put('user/{user}/update-password', [UserController::class, 'updatePassword'])->name('user.update-password');

    Route::resource('sessions.terms', TermController::class)->except(['show', 'index']);
    Route::get('sessions/{session}/term/{term}/delete', [TermController::class, 'delete'])->name('sessions.terms.delete');



    Route::resource('sessions', SessionController::class);
    Route::get('sessions/{session}/delete', [SessionController::class, 'delete'])->name('sessions.delete');



    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);
    Route::get('teachers/{teacher}/delete', [TeacherController::class, 'delete'])->name('teachers.delete');

    Route::resource('guardians', GuardianController::class);
    Route::resource('admins', AdminController::class);
});
