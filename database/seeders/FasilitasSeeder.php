<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Ruang Kelas Nyaman', 'book-open', 'Sirkulasi udara baik, pencahayaan natural, dan suhu nyaman untuk belajar.'],
            ['Perpustakaan Mini', 'academic-cap', 'Koleksi buku cerita, buku sains populer, dan fiksi bahasa Inggris.'],
            ['Masjid Sekolah', 'heart', 'Tempat salat berjamaah Dhuha dan Dzuhur serta ruang belajar mengaji.'],
            ['Laboratorium Komputer', 'computer', 'Dua puluh unit komputer untuk literasi digital dan praktik aplikasi.'],
            ['Lapangan Olahraga', 'gift', 'Lapangan serbaguna untuk olahraga, upacara, dan kegiatan luar kelas.'],
            ['Kantin Sehat', 'beaker', 'Menu bergizi, air minum bersih, dan area makan yang luas.'],
            ['UKS', 'shield-check', 'Unit kesehatan sekolah dengan perawat dan ruang istirahat khusus.'],
            ['Taman Pintar', 'sparkles', 'Area bermain luar ruang dengan permainan edukatif untuk anak-anak.'],
        ];

        foreach ($data as $index => [$nama, $ikon, $deskripsi]) {
            Fasilitas::create([
                'nama' => $nama,
                'ikon' => $ikon,
                'deskripsi' => $deskripsi,
                'urutan' => $index,
            ]);
        }
    }
}
