<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UlasanController;

Route::get('/', [UlasanController::class, 'index'])->name('ulasan.index');
Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');

Route::get('/load-more-ulasan', [UlasanController::class, 'loadMore'])->name('ulasan.loadMore');