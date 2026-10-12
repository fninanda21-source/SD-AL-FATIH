<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pendaftaran;
use App\Models\Pesan;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'statistik' => [
                [
                    'label' => 'Pendaftaran PPDB',
                    'nilai' => Pendaftaran::count(),
                    'catatan' => Pendaftaran::where('status', Pendaftaran::STATUS_BARU)->count().' berkas baru menunggu',
                    'ikon' => 'clipboard-check',
                    'warna' => 'brand',
                    'rute' => 'admin.ppdb.index',
                ],
                [
                    'label' => 'Diterima',
                    'nilai' => Pendaftaran::where('status', Pendaftaran::STATUS_DITERIMA)->count(),
                    'catatan' => 'calon murid diterima',
                    'ikon' => 'check-badge',
                    'warna' => 'green',
                    'rute' => 'admin.ppdb.index',
                ],
                [
                    'label' => 'Pesan Belum Dibaca',
                    'nilai' => Pesan::where('dibaca', false)->count(),
                    'catatan' => Pesan::count().' pesan masuk',
                    'ikon' => 'envelope',
                    'warna' => 'gold',
                    'rute' => 'admin.pesan.index',
                ],
                [
                    'label' => 'Berita Terbit',
                    'nilai' => Berita::where('published', true)->count(),
                    'catatan' => Berita::count().' total naskah',
                    'ikon' => 'newspaper',
                    'warna' => 'ink',
                    'rute' => 'admin.berita.index',
                ],
            ],
            'konten' => [
                [
                    'label' => 'Guru',
                    'nilai' => Guru::where('aktif', true)->count(),
                    'ikon' => 'users',
                    'rute' => 'admin.guru.index',
                ],
                [
                    'label' => 'Kelas',
                    'nilai' => Kelas::count(),
                    'ikon' => 'building-library',
                    'rute' => 'admin.dashboard',
                ],
                [
                    'label' => 'Foto Galeri',
                    'nilai' => Galeri::count(),
                    'ikon' => 'photo',
                    'rute' => 'admin.galeri.index',
                ],
            ],
            'pendaftaranTerbaru' => Pendaftaran::latest()->take(5)->get(),
            'pesanTerbaru' => Pesan::latest()->take(5)->get(),
            'pendaftaranBulanIni' => Pendaftaran::whereBetween('created_at', [
                now()->startOfMonth(),
                now()->endOfMonth(),
            ])->count(),
        ]);
    }
}
