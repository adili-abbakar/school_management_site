<?php

use App\Http\Controllers\Academic\ClassArmController;
use App\Http\Controllers\Academic\ClassController;
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
use App\Http\Controllers\ApplicationController;
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
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::resource('applications', ApplicationController::class);
Route::put('applications/{application}/withdraw/', [ApplicationController::class, 'withdraw'])->name('applications.withdraw');


Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::prefix('dashboard/')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
        Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
    });


    Route::prefix('user/')->name('user.')->group(function () {
        Route::get('{user}/edi  t-password', [UserController::class, 'editPassword'])->name('edit-password');
        Route::put('{user}/update-password', [UserController::class, 'updatePassword'])->name('update-password');
    });


    Route::resource('sessions.terms', TermController::class)->except(['show', 'index']);
    Route::get('sessions/{session}/term/{term}/delete', [TermController::class, 'delete'])->name('sessions.terms.delete');


    Route::prefix('term/')->name('term.')->group(function () {
        Route::put('{term}/set-active/', [Termcontroller::class, 'setActive'])->name('set-active');
        Route::put('{term}/set-completed/', [Termcontroller::class, 'setCompleted'])->name('set-completed');
        Route::put('{term}/set-upcoming/', [Termcontroller::class, 'setUpcoming'])->name('set-upcoming');
    });

    Route::resource('sessions', SessionController::class);
    Route::get('sessions/{session}/delete', [SessionController::class, 'delete'])->name('sessions.delete');


    Route::resource('admins', AdminController::class);
    Route::get('admins/{admin}/delete', [AdminController::class, 'delete'])->name('admins.delete');

    Route::resource('teachers', TeacherController::class);
    Route::get('teachers/{teacher}/delete', [TeacherController::class, 'delete'])->name('teachers.delete');

    Route::resource('students', StudentController::class);
    Route::resource('guardians', GuardianController::class);

    Route::resource('classes', ClassController::class);
    Route::get('classes/{class}/delete', [ClassController::class, 'delete'])->name('classes.delete');
    Route::resource('class-arms', ClassArmController::class);


    Route::get('/class-arms/{class_arm}/delete', [ClassArmController::class, 'delete'])
        ->name('class-arms.delete');
    Route::resource('admissions', AdmissionController::class);
    Route::prefix('applications/')->name('applications.')->group(function () {
        Route::put('{application}/approve/', [ApplicationController::class, 'approve'])->name('approve');
        Route::put('{application}/reject/', [ApplicationController::class, 'reject'])->name('reject');
    });
});
