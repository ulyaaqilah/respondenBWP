<?php

use App\Http\Controllers\UlasanController;

Route::get('/', [UlasanController::class, 'index']);
Route::post('/ulasan', [UlasanController::class, 'store']);

