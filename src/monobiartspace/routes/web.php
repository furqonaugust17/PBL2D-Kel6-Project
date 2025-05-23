<?php


use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KelasController; // <--- Tambahkan ini
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RuangController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'backend', 'middleware' => ['auth', 'verified', 'ifAdmin']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('ruang', RuangController::class);
    Route::resource('fasilitas', FasilitasController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('diskon', DiskonController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
