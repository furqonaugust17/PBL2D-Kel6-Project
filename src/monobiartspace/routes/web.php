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
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TemaKidController;
use App\Http\Controllers\PartnerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\InventarisController;

Route::get('/', [MainController::class, 'index']);

Route::group(['prefix' => 'backend', 'middleware' => ['auth', 'verified', 'ifAdmin']], function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('artspace', ArtSpaceController::class)->only(['index']);
    Route::resource('kegiatan-artspace', KegiatanArtSpaceController::class)->parameters(['kegiatan-artspace' => 'kegiatanArtSpace'])->only(['index']);;
    Route::resource('artspace-jadwal', JadwalArtSpaceController::class)->parameters(['artspace-jadwal' => 'jadwalArtSpace'])->only(['index']);;

    Route::resource('kids', KidController::class)->only(['index']);
    Route::resource('kids-price', HargaClassKidController::class)->parameters(['kids-price' => 'kidsPrice']);
    Route::resource('kids-jadwal', JadwalKidController::class)->parameters(['kids-jadwal' => 'jadwalKid'])->only(['index']);;
    Route::resource('kids-kategori', KategoriKidController::class)->parameters(['kids-kategori' => 'kidsKategori'])->only(['index']);;
    Route::resource('kids-tema', TemaKidController::class)->parameters(['kids-tema' => 'kidsTema'])->only(['index']);;

    Route::resource('karyawan', KaryawanController::class);
    Route::resource('diskon', DiskonController::class);
    Route::resource('pendaftaran', PendaftaranController::class);
    Route::resource('pembayaran', PembayaranController::class)->except(['show']);
    Route::resource('customer', CustomerController::class);
    Route::resource('partner', PartnerController::class);
    Route::resource('galeri', GaleriController::class);
    Route::resource('ruang', RuangController::class)->only(['index']);
    Route::resource('fasilitas', FasilitasController::class)->only(['index']);
    Route::resource('inventaris', InventarisController::class)->middleware('inventaris')->parameters(['inventaris' => 'inventaris']);

    Route::middleware(['ExceptSupervisor'])->group(function () {
        Route::resource('ruang', RuangController::class)->except(['index']);
        Route::resource('fasilitas', FasilitasController::class)->except(['index']);
        Route::resource('artspace-jadwal', JadwalArtSpaceController::class)->parameters(['artspace-jadwal' => 'jadwalArtSpace'])->except(['index']);
        Route::resource('kids-jadwal', JadwalKidController::class)->parameters(['kids-jadwal' => 'jadwalKid'])->except(['index']);

        Route::resource('kegiatan-artspace', KegiatanArtSpaceController::class)->parameters(['kegiatan-artspace' => 'kegiatanArtSpace'])->except(['index']);
        Route::resource('kids-kategori', KategoriKidController::class)->parameters(['kids-kategori' => 'kidsKategori'])->except(['index']);
        Route::resource('kids-tema', TemaKidController::class)->parameters(['kids-tema' => 'kidsTema'])->except(['index']);

        Route::resource('artspace', ArtSpaceController::class)->except(['index']);
        Route::resource('kids', KidController::class)->except(['index']);
    });
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
    Route::get('payment/status', [PaymentController::class, 'status']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
