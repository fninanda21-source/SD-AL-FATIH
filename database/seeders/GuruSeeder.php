<?php

namespace Database\Seeders;

use App\Models\Guru;
use Illuminate\Database\Seeder;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Hj. Siti Maryam, S.Pd.I., M.M.', '198504122010012004', 'Kepala Sekolah', 'Pendidikan Agama Islam', 'Mendampingi anak agar tumbuh dan berkarya sejak 2009. Menyelesaikan magister Pendidikan Agama Islam di Universitas Pendidikan Indonesia.'],
            ['Drs. Bambang Sutrisno, M.Pd.', '197203081995031002', 'Kepala Bagian Kurikulum', 'Matematika', 'Fokus pada pengembangan pembelajaran berbasis proyek dan asesmen formatif.'],
            ['Dewi Anggraeni, S.Pd.', '199003232015032001', 'Guru', 'Bahasa Indonesia', 'Guru Bahasa Indonesia dan fasilitator program literasi sekolah bagi murid kelas satu sampai enam.'],
            ['Asep Saepudin, S.Pd.I.', '198504112009011001', 'Guru', 'Pendidikan Agama Islam', 'Pembina program Tahfidz Al-Quran dan pembiasaan ibadah harian.'],
            ['Dewi Anggraeni, S.Pd.', '199003232015032001', 'Guru', 'Bahasa Indonesia', 'Guru Parialan Nasional 2019 dan أنفس Reading Specialist.'],
            ['Rizky Ramadhan, S.Pd.', '199107102018011002', 'Guru', 'Informatika', 'Pembina ekstrakurikuler Robotik dan Literasi Digital.'],
            ['Fitri Handayani, S.Pd.', '198902182014022003', 'Guru', 'Matematika', 'Suka membuat permainan edukatif matematika yang menantang dan menyenangkan.'],
            ['Muhammad Ilham, S.Pd.', '199208142020011004', 'Guru', 'Pendidikan Jasmani', 'Pembina tim futsal dan panahan sekolah.'],
            ['Putri Amelia, M.Pd.', '199104052017032002', 'Guru', 'Bahasa Inggris', 'Lulusan program Bilingual Teaching Training dan refresher native speaker.'],
            ['Yusuf Maulana, S.Pd.', '198801192013011003', 'Guru', 'IPAS', 'Menyukai percobaan sains sederhana di luar kelas dan kegiatan alam terbuka.'],
            ['Rahmawati, S.Pd.', '199512212019032001', 'Guru', 'Pendidikan Pancasila', 'Fasilitator pembiasaan nilai kebangsaan dan profil pelajar Pancasila.'],
            ['Hendra Gunawan, S.Pd.', '198306102008011002', 'Guru', 'Seni Budaya', 'Pembina marching band dan klub kaligrafi sekolah.'],
        ];

        foreach ($data as $index => [$nama, $nip, $jabatan, $mapel, $bio]) {
            Guru::create([
                'nama' => $nama,
                'nip' => $nip,
                'jabatan' => $jabatan,
                'mata_pelicaran' => $mapel,
                'bio' => $bio,
                'urutan' => $index,
                'aktif' => true,
            ]);
        }
    }
}
