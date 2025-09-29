<?php

use App\Http\Controllers\UlasanController;
use App\Http\Controllers\AdminController;

Route::get('/', [UlasanController::class, 'index']);
Route::post('/ulasan', [UlasanController::class, 'store']);

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::post('/admin/reply/{id}', [AdminController::class, 'reply'])->name('admin.reply');
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');