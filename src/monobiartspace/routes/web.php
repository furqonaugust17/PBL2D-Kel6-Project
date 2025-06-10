<?php

use App\Http\Controllers\ArtSpaceController;
use App\Http\Controllers\KategoriKidController;
use App\Http\Controllers\KegiatanArtSpaceController;
use App\Http\Controllers\KidController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TemaKidController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'backend', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('artspace', ArtSpaceController::class);
    Route::resource('kids', KidController::class);

    Route::middleware(['ExceptSupervisor'])->group(function() {
    Route::resource('kegiatan-artspace', KegiatanArtSpaceController::class)->parameters(['kegiatan-artspace' => 'kegiatanArtSpace'])->except(['index']);;
    Route::resource('kids-kategori', KategoriKidController::class)->parameters(['kids-kategori' => 'kidsKategori'])->except(['index']);;
    Route::resource('kids-tema', TemaKidController::class)->parameters(['kids-tema' => 'kidsTema'])->except(['index']);;
    });

    Route::resource('kegiatan-artspace', KegiatanArtSpaceController::class)->parameters(['kegiatan-artspace' => 'kegiatanArtSpace'])->only(['index']);;
    Route::resource('kids-kategori', KategoriKidController::class)->parameters(['kids-kategori' => 'kidsKategori'])->only(['index']);;
    Route::resource('kids-tema', TemaKidController::class)->parameters(['kids-tema' => 'kidsTema'])->only(['index']);;
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
