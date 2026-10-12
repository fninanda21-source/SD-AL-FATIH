<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Fasilitas;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pendaftaran;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $guru = Guru::where('aktif', true)->orderBy('urutan')->get();
        $kelas = Kelas::orderBy('urutan')->get();
        $murid = (int) $kelas->sum('terisi');
        $ekstrakurikuler = config('sekolah.ekstrakurikuler');
        $program = config('sekolah.program');

        return view('home', [
            'statistik' => [
                ['nilai' => $murid, 'label' => 'Murid Aktif'],
                ['nilai' => $guru->count(), 'label' => 'Guru & Staf'],
                ['nilai' => '20+', 'label' => 'Tahun Berdiri'],
            ],
            'angka' => [
                [
                    'nilai' => $murid,
                    'label' => 'Murid Aktif',
                    'catatan' => 'Siswa kelas 1 sampai 6 yang belajar bersama kami',
                    'ikon' => 'users',
                ],
                [
                    'nilai' => $guru->count(),
                    'label' => 'Guru & Staf',
                    'catatan' => 'Tenaga pengajar aktif dan wali kelas',
                    'ikon' => 'academic-cap',
                ],
                [
                    'nilai' => $kelas->count(),
                    'label' => 'Rombongan Belajar',
                    'catatan' => 'Kelas reguler dan bilingual',
                    'ikon' => 'building-library',
                ],
                [
                    'nilai' => count($ekstrakurikuler),
                    'label' => 'Ekstrakurikuler',
                    'catatan' => 'Pilihan kegiatan untuk mengembangkan bakat',
                    'ikon' => 'trophy',
                ],
                [
                    'nilai' => count($program),
                    'label' => 'Program Unggulan',
                    'catatan' => 'Program pengembangan karakter dan literasi',
                    'ikon' => 'sparkles',
                ],
                [
                    'nilai' => Pendaftaran::count(),
                    'label' => 'Pendaftar PPDB',
                    'catatan' => 'Calon murid yang sudah mendaftar online',
                    'ikon' => 'clipboard-check',
                ],
            ],
            'program' => $program,
            'fasilitas' => Fasilitas::orderBy('urutan')->get(),
            'guru' => $guru,
            'galeri' => Galeri::orderBy('urutan')->orderByDesc('tanggal')->get(),
            'berita' => Berita::published()->terbaru()->take(3)->get(),
        ]);
    }
}
