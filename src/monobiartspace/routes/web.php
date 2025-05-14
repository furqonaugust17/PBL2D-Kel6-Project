<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\productController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index']);


Route::group(['prefix' => 'backend', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('product/{artSpace}', [productController::class, 'index'])->name('product.index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('booking/artspace', [PendaftaranController::class, 'artSpace'])->name('booking.artspace');
    Route::post('booking/artspace', [PendaftaranController::class, 'storeArtSpace'])->name('booking.artspace.store');
    Route::get('booking/kids', [PendaftaranController::class, 'kids'])->name('booking.kids');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
