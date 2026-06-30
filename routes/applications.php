<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;

Route::prefix('applications/')->name('applications.')->group(function () {
    Route::get('/create', [ApplicationController::class, 'create'])->name('create');
    Route::post('/store', [ApplicationController::class, 'store'])->name('store');
    Route::put('{application}/withdraw/', [ApplicationController::class, 'withdraw'])->name('withdraw');
    Route::get('{application}/track/show', [ApplicationController::class, 'trackShow'])->name('track.show');
    Route::get('/track/search', [ApplicationController::class, 'trackSearchForm'])->name('track.search.form');
    Route::post('/track/search', [ApplicationController::class, 'trackSearch'])->name('track.search');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('applications', ApplicationController::class)->except(['create', 'store']);

    Route::prefix('applications/')->name('applications.')->group(function () {
        Route::get('{application}/descision/', [ApplicationController::class, 'decisionShow'])->name('decision.show');
        Route::put('{application}/descision/make', [ApplicationController::class, 'decisionMake'])->name('decision.make');
        Route::put('{application}/approve/', [ApplicationController::class, 'approve'])->name('approve');
        Route::put('{application}/reject/', [ApplicationController::class, 'reject'])->name('reject');
        Route::put('/mine/', [ApplicationController::class, 'mine'])->name('mine');
    });
});
