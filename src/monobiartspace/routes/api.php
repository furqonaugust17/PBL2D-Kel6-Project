<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\JadwalKidController;
use App\Http\Controllers\KategoriKidController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\TemaKidController;
use Illuminate\Support\Facades\Route;

Route::prefix('kids')->group(function () {
    Route::get('/kategori/{id}', [KategoriKidController::class, 'getData'])->name('kategori.getdata');
    Route::get('/tema/{id}', [TemaKidController::class, 'getData'])->name('tema.getdata');
    Route::get('/jadwal/{id}', [JadwalKidController::class, 'getData'])->name('jadwal.getdata');
});

Route::get('/dashboard', [DashboardController::class, 'chart'])->middleware(['web', 'auth', 'verified', 'ifAdmin'])->name('dashboard.chart');

Route::get('class/{tipe}/{id}', [MainController::class, 'getDataClass'])->name('class');
Route::post('diskon', [DiskonController::class, 'getDiskon'])->name('checkDiskon');
Route::post('payment/notification', [PaymentController::class, 'callback']);
