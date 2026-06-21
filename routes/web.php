<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/academics.php';
require __DIR__ . '/applications.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/classes.php';
require __DIR__ . '/dashboard.php';
require __DIR__ . '/programs.php';
require __DIR__ . '/public.php';
require __DIR__ . '/settings.php';
require __DIR__ . '/users.php';

// Test errors
// Route::prefix('test-errors')->group(function () {
//     Route::get('/403', fn () => abort(403));
//     Route::get('/404', fn () => abort(404));
//     Route::post('/405', fn () => 'POST only');
// });
