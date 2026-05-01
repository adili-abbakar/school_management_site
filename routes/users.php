<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Users\StudentController;
use App\Http\Controllers\Users\TeacherController;
use App\Http\Controllers\Users\GuardianController;
use App\Http\Controllers\Users\AdminController;



Route::middleware(['auth'])->group(function () {
    Route::resource('admins', AdminController::class);
    Route::get('admins/{admin}/delete', [AdminController::class, 'delete'])->name('admins.delete');

    Route::resource('teachers', TeacherController::class);
    Route::get('teachers/{teacher}/delete', [TeacherController::class, 'delete'])->name('teachers.delete');

    Route::resource('students', StudentController::class);
    Route::resource('guardians', GuardianController::class);


    Route::prefix('user/')->name('user.')->group(function () {
        Route::get('{user}/edit-password', [UserController::class, 'editPassword'])->name('edit-password');
        Route::put('{user}/update-password', [UserController::class, 'updatePassword'])->name('update-password');
    });
});
