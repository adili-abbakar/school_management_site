<?php

use App\Http\Controllers\Academic\SectionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Academic\SessionController;
use App\Http\Controllers\Academic\TermController;
use App\Models\Academic\ClassLevel;

Route::middleware(['auth'])->group(function () {
    Route::resource('sessions.terms', TermController::class)->except(['show', 'index']);
    Route::get('sessions/{session}/term/{term}/delete', [TermController::class, 'delete'])->name('sessions.terms.delete');


    Route::prefix('term/')->name('term.')->group(function () {
        Route::put('{term}/set-active/', [Termcontroller::class, 'setActive'])->name('set-active');
        Route::put('{term}/set-completed/', [Termcontroller::class, 'setCompleted'])->name('set-completed');
        Route::put('{term}/set-upcoming/', [Termcontroller::class, 'setUpcoming'])->name('set-upcoming');
    });

    Route::resource('sessions', SessionController::class);
    Route::get('sessions/{session}/delete', [SessionController::class, 'delete'])->name('sessions.delete');

    Route::resource('sections', SectionController::class);
    Route::get('sections/{section}/delete', [SessionController::class, 'delete'])->name('sections.delete');

    Route::resource('sections.levels', ClassLevel::class)->except(['show', 'index']);
    Route::get('sections/{session}/level/{level}/delete', [ClassLevel::class, 'delete'])->name('sections.levels.delete');
});
