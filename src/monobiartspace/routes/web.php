<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RuangController;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'backend', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::middleware(['ExceptSupervisor'])->group(function () {
        Route::resource('ruang', RuangController::class)->except(['index']);
    });

    Route::resource('ruang', RuangController::class)->only(['index']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
