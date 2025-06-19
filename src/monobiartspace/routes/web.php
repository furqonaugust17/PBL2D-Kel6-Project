<?php

use App\Http\Controllers\ArtSpaceController;
use App\Http\Controllers\JadwalArtSpaceController;
use App\Http\Controllers\JadwalKidController;
use App\Http\Controllers\KegiatanArtSpaceController;
use App\Http\Controllers\KidController;
use App\Http\Controllers\Frontend\KelasController as FrontKelas;
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\Frontend\PendaftaranController as FrontPendaftaran;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\HargaClassKidController;
use App\Http\Controllers\KategoriKidController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TemaKidController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RuangController;

Route::get('/', [MainController::class, 'index']);

Route::group(['prefix' => 'backend', 'middleware' => ['auth', 'verified', 'ifAdmin']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('artspace', ArtSpaceController::class);
    Route::resource('kids', KidController::class);

    Route::resource('kegiatan-artspace', KegiatanArtSpaceController::class)->parameters(['kegiatan-artspace' => 'kegiatanArtSpace']);
    Route::resource('kids-kategori', KategoriKidController::class)->parameters(['kids-kategori' => 'kidsKategori']);
    Route::resource('kids-tema', TemaKidController::class)->parameters(['kids-tema' => 'kidsTema']);
    Route::resource('artspace-jadwal', JadwalArtSpaceController::class)->parameters(['artspace-jadwal' => 'jadwalArtSpace']);
    Route::resource('kids-jadwal', JadwalKidController::class)->parameters(['kids-jadwal' => 'jadwalKid']);
    Route::resource('kids-price', HargaClassKidController::class)->parameters(['kids-price' => 'kidsPrice']);

    Route::resource('karyawan', KaryawanController::class);
    Route::resource('ruang', RuangController::class);
    Route::resource('fasilitas', FasilitasController::class);
    Route::resource('diskon', DiskonController::class);
    Route::resource('pendaftaran', PendaftaranController::class);
    Route::resource('pembayaran', PembayaranController::class)->except(['show']);
});

Route::get('class', [FrontKelas::class, 'index'])->name('class.index');
Route::get('class/detail/{tipe}/{slug}', [FrontKelas::class, 'detail'])->name('class.detail');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('booking/artspace', [FrontPendaftaran::class, 'artSpace'])->name('booking.artspace');
    Route::post('booking/artspace', [FrontPendaftaran::class, 'storeArtSpace'])->name('booking.artspace.store');
    Route::post('booking/artspace/calculate', [FrontPendaftaran::class, 'calculateArtSpaceTransaction'])->name('booking.artspace.calculate');

    Route::get('booking/kids', [FrontPendaftaran::class, 'kids'])->name('booking.kids');
    Route::post('booking/kids', [FrontPendaftaran::class, 'storeKids'])->name('booking.kids.store');
    Route::post('booking/kids/calculate', [FrontPendaftaran::class, 'calculateKidTransaction'])->name('booking.kids.calculate');

    Route::get('booking', [FrontPendaftaran::class, 'index'])->name('booking');
    Route::get('booking/detail/{id}', [FrontPendaftaran::class, 'show'])->name('booking.show');
    Route::post('booking/cancel/{id}', [FrontPendaftaran::class, 'cancel'])->name('booking.cancel');
    Route::get('pembayaran/{pembayaran}/{type}', [PembayaranController::class, 'show'])->name('pembayaran.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
