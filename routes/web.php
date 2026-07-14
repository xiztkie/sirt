<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'login']);
Route::get('/login', [HomeController::class, 'login']);
Route::get('/captcha', [HomeController::class, 'generate'])->name('captcha.image');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::middleware(['role:admin'])->group(function () {
        //
    });
});
