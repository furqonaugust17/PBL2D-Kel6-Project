<?php

use App\Http\Controllers\KategoriKidController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TemaKidController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::prefix('kids')->group(function () {
    Route::get('/kategori/{id}', [KategoriKidController::class, 'getData'])->name('kategori.getdata');
    Route::get('/tema/{id}', [TemaKidController::class, 'getData'])->name('tema.getdata');
});

Route::post('payment/notification', [PaymentController::class, 'callback']);
