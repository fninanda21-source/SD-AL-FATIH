<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\GuruController as AdminGuruController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\Admin\PesanController as AdminPesanController;
use App\Http\Controllers\AkademikController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\PPDBController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('beranda');

Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/akademik', [AkademikController::class, 'index'])->name('akademik');
Route::get('/pengajar', [PengajarController::class, 'index'])->name('pengajar');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{berita}', [BeritaController::class, 'show'])->name('berita.show');

Route::get('/ppdb', [PPDBController::class, 'create'])->name('ppdb');
Route::post('/ppdb', [PPDBController::class, 'store'])->name('ppdb.store');
Route::get('/ppdb/berhasil/{kode}', [PPDBController::class, 'berhasil'])->name('ppdb.berhasil');

Route::get('/kontak', [KontakController::class, 'create'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

    Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/login', [AdminAuthController::class, 'create'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'store'])->name('login.store');

    Route::middleware('admin')->group(function (): void {
        Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');

        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/ppdb', [AdminPendaftaranController::class, 'index'])->name('ppdb.index');
        Route::get('/ppdb/{pendaftaran}', [AdminPendaftaranController::class, 'show'])->name('ppdb.show');
        Route::patch('/ppdb/{pendaftaran}', [AdminPendaftaranController::class, 'update'])->name('ppdb.update');
        Route::delete('/ppdb/{pendaftaran}', [AdminPendaftaranController::class, 'destroy'])->name('ppdb.destroy');

        Route::resource('berita', AdminBeritaController::class)->except('show')->parameters([
            'berita' => 'berita',
        ]);
        Route::resource('galeri', AdminGaleriController::class)->except('show');
        Route::resource('guru', AdminGuruController::class)->except('show');

        Route::get('/pesan', [AdminPesanController::class, 'index'])->name('pesan.index');
        Route::patch('/pesan/{pesan}', [AdminPesanController::class, 'update'])->name('pesan.update');
        Route::delete('/pesan/{pesan}', [AdminPesanController::class, 'destroy'])->name('pesan.destroy');
    });
});
