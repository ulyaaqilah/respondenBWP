<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\AdminController;

Route::get('/', [UlasanController::class, 'index'])->name('ulasan.index');
Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::post('/admin/reply/{id}', [AdminController::class, 'reply'])->name('admin.reply');
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');

Route::get('/load-more-ulasan', [UlasanController::class, 'loadMore'])->name('ulasan.loadMore');
