<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\PublicController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TermController;

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


    Route::get('terms/{session}/create', [TermController::class, 'create'])->name('terms.create');
    Route::POST('terms/{session}/store', [TermController::class, 'store'])->name('terms.store');
    Route::get('terms/{term}/{session}/edit', [TermController::class, 'edit'])->name('terms.edit');
    Route::put('terms/{term}/{session}/update', [TermController::class, 'update'])->name('terms.update');




    Route::resource('sessions', SessionController::class);
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);
    Route::get('teachers/{teacher}/delete', [TeacherController::class, 'delete'])->name('teachers.delete');

    Route::resource('guardians', GuardianController::class);
    Route::resource('admins', AdminController::class);
});
