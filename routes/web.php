<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\DatawilayahController;

Route::get('/', [HomeController::class, 'login']);
Route::get('/login', [HomeController::class, 'login']);
Route::get('/captcha', [HomeController::class, 'generate'])->name('captcha.image');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/penduduk/keluarga', [PendudukController::class, 'keluarga'])->name('penduduk.keluarga');
    Route::middleware(['role:admin'])->group(function () {
        /* DATA WILAYAH */
        Route::get('/data-wilayah/provinsi', [DatawilayahController::class, 'provinsi'])->name('datawilayah.provinsi');
        Route::get('/data-wilayah/kabkota', [DatawilayahController::class, 'kabkota'])->name('datawilayah.kabkota');
        Route::get('/data-wilayah/kecamatan', [DatawilayahController::class, 'kecamatan'])->name('datawilayah.kecamatan');
        Route::get('/data-wilayah/kelurahan', [DatawilayahController::class, 'kelurahan'])->name('datawilayah.kelurahan');
        Route::post('/data-wilayah/sync-provinces', [DatawilayahController::class, 'syncprovinsi'])->name('datawilayah.sync.provinsi');
        Route::post('/data-wilayah/sync-kabkota', [DatawilayahController::class, 'synckabkota'])->name('datawilayah.sync.kabkota');
        Route::post('/data-wilayah/sync-kecamatan', [DatawilayahController::class, 'synckecamatan'])->name('datawilayah.sync.kecamatan');
        Route::post('/data-wilayah/sync-kelurahan', [DatawilayahController::class, 'synckelurahan'])->name('datawilayah.sync.kelurahan');

        /* API WILAYAH */
        Route::get('/select/provinsi', [DatawilayahController::class, 'selectProvinsi'])->name('select.provinsi');
        Route::get('/select/kabkota', [DatawilayahController::class, 'selectKabkota'])->name('select.kabkota');
        Route::get('/select/kecamatan', [DatawilayahController::class, 'selectKecamatan'])->name('select.kecamatan');
        Route::get('/select/kelurahan', [DatawilayahController::class, 'selectKelurahan'])->name('select.kelurahan');
    });
});
