<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Academic\ClassArmController;
use App\Http\Controllers\Academic\ClassController;


Route::middleware(['auth'])->group(function () {
    Route::resource('classes', ClassController::class);
    Route::get('classes/{class}/delete', [ClassController::class, 'delete'])->name('classes.delete');
    Route::resource('class-arms', ClassArmController::class);


    Route::get('/class-arms/{class_arm}/delete', [ClassArmController::class, 'delete'])
        ->name('class-arms.delete');
});
