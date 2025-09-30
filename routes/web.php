<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;

// Public (User)
Route::get('/', [UlasanController::class, 'index'])->name('ulasan.index');
Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');
Route::get('/load-more-ulasan', [UlasanController::class, 'loadMore'])->name('ulasan.loadMore');

// Login / Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin (cek login langsung di controller)
Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::post('/admin/reply/{id}', [AdminController::class, 'reply'])->name('admin.reply');
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
