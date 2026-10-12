<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $wali = Guru::pluck('id', 'nama');

        $data = [
            ['Kelas 1A', '1', 'Asep Saepudin, S.Pd.I.', 28, 26, '#059669'],
            ['Kelas 1B', '1', 'Dewi Anggraeni, S.Pd.', 28, 24, '#047857'],
            ['Kelas 2A', '2', 'Dewi Anggraeni, S.Pd.', 28, 27, '#0d9488'],
            ['Kelas 2B', '2', 'Rahmawati, S.Pd.', 28, 25, '#0f766e'],
            ['Kelas 3A', '3', 'Fitri Handayani, S.Pd.', 28, 28, '#14b8a6'],
            ['Kelas 3B', '3', 'Yusuf Maulana, S.Pd.', 28, 26, '#f59e0b'],
            ['Kelas 4A', '4', 'Nia Kurniasih, S.Pd.', 28, 28, '#d97706'],
            ['Kelas 4B', '4', 'Putri Amelia, M.Pd.', 28, 27, '#b45309'],
            ['Kelas 5A', '5', 'Rizky Ramadhan, S.Pd.', 28, 28, '#65a30d'],
            ['Kelas 5B', '5', 'Hendra Gunawan, S.Pd.', 28, 26, '#4d7c0f'],
            ['Kelas 6A', '6', 'Drs. Bambang Sutrisno, M.Pd.', 28, 28, '#ca8a04'],
            ['Kelas 6B', '6', 'Muhammad Ilham, S.Pd.', 28, 25, '#a16207'],
        ];

        foreach ($data as $index => [$nama, $tingkat, $namaWali, $kapasitas, $terisi, $warna]) {
            Kelas::create([
                'nama' => $nama,
                'tingkat' => $tingkat,
                'wali_kelas_id' => $wali[$namaWali] ?? null,
                'kapasitas' => $kapasitas,
                'terisi' => $terisi,
                'warna' => $warna,
                'deskripsi' => 'Kelas '.$tingkat.' dengan pembelajaran tematik, pembiasaan ibadah harian, dan pendampingan wali kelas setiap hari.',
                'fasilitas' => [
                    'Meja belajar ergonomis',
                    'Papan tulis digital',
                    'Sudut baca kelas',
                    'Kotak alat tulis murid',
                ],
                'urutan' => $index,
            ]);
        }
    }
}
