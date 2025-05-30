<?php

use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\PendaftaranController;
use App\Http\Controllers\productController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index']);


Route::group(['prefix' => 'backend', 'middleware' => ['auth', 'verified', 'ifAdmin']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('product/{artSpace}', [productController::class, 'index'])->name('product.index');
Route::get('email', [PendaftaranController::class, 'sendMail']);
Route::get('data', [PaymentController::class, 'testing']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('booking/artspace', [PendaftaranController::class, 'artSpace'])->name('booking.artspace');
    Route::post('booking/artspace', [PendaftaranController::class, 'storeArtSpace'])->name('booking.artspace.store');
    Route::post('booking/artspace/calculate', [PendaftaranController::class, 'calculateArtSpaceTransaction'])->name('booking.artspace.calculate');

    Route::get('booking/kids', [PendaftaranController::class, 'kids'])->name('booking.kids');
    Route::post('booking/kids', [PendaftaranController::class, 'storeKids'])->name('booking.kids.store');
    Route::post('booking/kids/calculate', [PendaftaranController::class, 'calculateKidTransaction'])->name('booking.kids.calculate');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
