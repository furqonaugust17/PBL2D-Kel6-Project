<?php

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

Route::get('class/{tipe}/{id}', [MainController::class, 'getDataClass'])->name('class');

Route::post('payment/notification', [PaymentController::class, 'callback']);
