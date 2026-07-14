<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendudukController;

Route::get('/', [HomeController::class, 'login']);
Route::get('/login', [HomeController::class, 'login']);
Route::get('/captcha', [HomeController::class, 'generate'])->name('captcha.image');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/penduduk/keluarga', [PendudukController::class, 'keluarga'])->name('penduduk.keluarga');
    Route::middleware(['role:admin'])->group(function () {
        
    });
});
