<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $artikel = [
            [
                'judul' => 'Juara Olimpiade Sains Tingkat Kota',
                'kategori' => 'Prestasi',
                'excerpt' => 'Tim olimpiade sains sekolah meraih medali emas tingkat kota.',
                'konten' => $this->paragraf(
                    'Tim olimpiade sains sekolah meraih medali emas tingkat kota.',
                    'Ketiga murid berlatih setiap hari Selasa dan Kamis.',
                    'Kepala sekolah menyampaikan capaian ini sebagai hasil pembelajaran berbasis percobaan.'
                ),
            ],
            [
                'judul' => 'Pembukaan Tahun Ajaran Baru',
                'kategori' => 'Kegiatan Sekolah',
                'excerpt' => 'Tahun ajaran baru dimulai dengan upacara dan orientasi murid.',
                'konten' => $this->paragraf(
                    'Tahun ajaran 2026/2027 dimulai dengan upacara di lapangan sekolah.',
                    'Orang tua dan pengawas sekolah hadir dalam acara tersebut.',
                ),
            ],
            [
                'judul' => 'Guru Sekolah Terpilih Jadi Finalis Penghargaan Guru',
                'kategori' => 'Prestasi',
                'excerpt' => 'Seorang guru sekolah terpilih menjadi finalis penghargaan guru nasional.',
                'konten' => $this->paragraf(
                    'Seorang guru sekolah terpilih menjadi finalis penghargaan guru nasional.',
                    'Guru tersebut dinilai konsisten dalam mengembangkan metode belajar.'
                ),
            ],
            [
                'judul' => 'Pekan Literasi Digital',
                'kategori' => 'Program',
                'excerpt' => 'Rangkaian kegiatan literasi digital untuk murid kelas empat sampai enam.',
                'konten' => $this->paragraf(
                    'Sekolah mengadakan pekan literasi digital bagi murid kelas empat sampai enam.',
                    'Materi mencakup keamanan di internet dan etika media digital.',
                ),
            ],
            [
                'judul' => 'Kunjungan Belajar ke Peternak Unggas',
                'kategori' => 'Kegiatan Belajar',
                'excerpt' => 'Murid kelas tiga belajar langsung tentang pemeliharaan dan produksi telur.',
                'konten' => $this->paragraf(
                    'Murid kelas tiga melakukan kunjungan belajar ke peternak unggas.',
                    'Mereka mengamati proses pemeliharaan dan produksi telur.',
                ),
            ],
            [
                'judul' => 'Jumat Bersih dan Sehat',
                'kategori' => 'Kegiatan Sekolah',
                'excerpt' => 'Murid membersihkan lingkungan sekolah bersama wali kelas.',
                'konten' => $this->paragraf(
                    'Murid membersihkan lingkungan sekolah bersama wali kelas.',
                    'Kegiatan ini rutin dilakukan agar sekolah tetap nyaman dan bersih.',
                ),
            ],
        ];

        foreach ($artikel as $index => $item) {
            Berita::create($item + [
                'penulis' => 'Humas '.config('sekolah.nama_singkat'),
                'tanggal' => now()->subDays(($index + 1) * 5),
                'published' => true,
                'featured' => $index === 0,
            ]);
        }
    }

    protected function paragraf(string ...$kalimat): string
    {
        return implode("\n\n", array_map(
            fn (string $p) => '<p>'.trim($p).'</p>',
            $kalimat
        ));
    }
}
