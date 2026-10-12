<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['OLIMPIADE SAINS (OSNP)', 'Prestasi', 'Delegasi sekolah mengikuti Olimpiade Sains Nasional (OSNP) dan meraih prestasi membanggakan.', 'img/osn.jpg'],
            ['Upacara Bendera Hari Senin', 'Kegiatan Sekolah', 'Pembacaan doa dan ikrar setiap pagi di lapangan sekolah.', null],
            ['Salat Dhuha Berjamaah', 'Kegiatan Keagamaan', 'Murid beribadah berjamaah setiap pagi sebelum belajar.', null],
            ['Lomba Tahfidz Antar Kelas', 'Prestasi', 'Final tahfidz antar kelas berlangsung seru semester ini.', null],
            ['Kegiatan Pramuka', 'Kegiatan Sekolah', 'Perkemahan pramuka berlangsung selama tiga hari di luar kota.', null],
            ['Belajar di Luar Kelas', 'Kegiatan Sekolah', 'Pembelajaran tematik di kebun sekolah dan museum.', null],
            ['Pentas Seni Akhir Tahun', 'Kegiatan Seni', 'Pentas seni menampilkan tari, drama, dan paduan suara.', null],
            ['Juara Olimpiade Sains', 'Prestasi', 'Tim olimpiade sains sekolah meraih medali emas tingkat kota.', null],
            ['Latihan Panahan', 'Kegiatan Olahraga', 'Latihan panahan rutin setiap hari Sabtu pagi.', null],
            ['English Club', 'Kegiatan Bahasa', 'Latihan pembicaraan bahasa Inggris bersama native speaker.', null],
            ['Robotik Murid Kelas 5', 'Kegiatan STEM', 'Perakitan robot sederhana bersama pembina ekstrakurikuler.', null],
            ['Kunjungan Belajar ke Peternak', 'Kegiatan Belajar', 'Kunjungan belajar ke peternak unggas di sekitar sekolah.', null],
            ['Perayaan Hari Besar Islam', 'Kegiatan Keagamaan', 'Ceramah dan santunan dalam peringatan hari besar Islam.', null],
        ];

        foreach ($data as $index => [$judul, $kategori, $caption, $gambar]) {
            Galeri::create([
                'judul' => $judul,
                'kategori' => $kategori,
                'caption' => $caption,
                'gambar' => $gambar,
                'tanggal' => now()->subDays(($index + 1) * 9),
                'urutan' => $index,
            ]);
        }
    }
}
