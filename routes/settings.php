<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NumberingSettingController;


Route::middleware(['auth'])->group(function () {
    Route::resource('numbering-settings', NumberingSettingController::class);
});
