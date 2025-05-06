<?php

use App\Http\Controllers\JadwalArtSpaceController;
use App\Http\Controllers\JadwalKidController;
use App\Http\Controllers\KidController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'backend', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('kids', KidController::class);

    Route::resource('artspace-jadwal', JadwalArtSpaceController::class)->parameters(['artspace-jadwal' => 'jadwalArtSpace']);
    Route::resource('kids-jadwal', JadwalKidController::class)->parameters(['kids-jadwal' => 'jadwalKid']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
