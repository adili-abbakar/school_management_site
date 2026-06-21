<?php

use App\Http\Controllers\Academic\ClassLevelController;
use App\Http\Controllers\Academic\ProgramController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth'])->group(function () {


    Route::resource('programs', ProgramController::class);
    Route::get('programs/{program}/delete', [ProgramController::class, 'delete'])->name('programs.delete');

    Route::resource('programs.levels', ClassLevelController::class)->except(['show', 'index']);
    Route::get('programs/{session}/level/{level}/delete', [ClassLevelController::class, 'delete'])->name('programs.levels.delete');

    Route::get('/programs/{program}/levels', [ProgramController::class, 'levels'])->name('program.levels');
});
