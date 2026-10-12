<?php

return [

    'nama' => env('NAMA_SEKOLAH', 'SDIT TAHFIZH AL-FATIH'),

    'nama_singkat' => env('NAMA_SEKOLAH_SINGKAT', 'SDIT Tahfizh Al-Fatih'),

    'tagline' => env('TAGLINE_SEKOLAH', 'Membangun Generasi Berakhlak, Berprestasi, dan Berwawasan Teknologi'),

    'npsn' => env('NPSN_SEKOLAH', '20512345'),

    'alamat' => env('ALAMAT_SEKOLAH', 'Jl. Kayu Manis Perumahan Beringin Indah, Kelurahan Sidomulyo Timur, Kecamatan Marpoyan Damai, Pekanbaru 28125'),

    'telepon' => env('TELEPON_SEKOLAH', '(022) 8765-4321'),

    'whatsapp' => env('WHATSAPP_SEKOLAH', '6281234567890'),

    'email' => env('EMAIL_SEKOLAH', 'info@sdalfatih.sch.id'),

    'jam_operasional' => [
        'Senin sampai Jumat' => '07.15 - 14.00 WIB',
        'Sabtu' => '07.15 - 12.00 WIB',
        'Minggu dan hari libur' => 'Libur',
    ],

    'sosial_media' => [
        ['nama' => 'Facebook', 'ikon' => 'facebook', 'url' => 'https://www.facebook.com/sdittahfizh.alfatih'],
        ['nama' => 'Instagram', 'ikon' => 'instagram', 'url' => 'https://www.instagram.com/sdit_tahfizh_alfatih/'],
        ['nama' => 'YouTube', 'ikon' => 'youtube', 'url' => 'https://www.youtube.com/@al-fatihelementaryschool'],
        ['nama' => 'TikTok', 'ikon' => 'tiktok', 'url' => 'https://www.tiktok.com/@sdit_tahfizh_alfatih'],
    ],

    'tahun_ajaran' => '2027/2028',

    'ppdb' => [
        'gelombang' => 'Gelombang I dan II Tahun Ajaran 2027/2028',
        'periode' => '1 November 2027 - 28 Februari 2028',
        'biaya' => 'Rp 1.250.000 per semester',
        'kuota' => 168,
        'pilihan_kelas' => ['Kelas 1', 'Kelas 2', 'Kelas 3', 'Kelas 4', 'Kelas 5', 'Kelas 6'],
    ],

    'ppdb_persyaratan' => [
        'Fotokopi akta kelahiran calon murid',
        'Fotokopi kartu keluarga terbaru',
        'Pas foto calon murid ukuran 3 x 4',
        'Fotokopi rapor semester terakhir, bila ada',
    ],

    'ppdb_biaya' => [
        ['nama' => 'Uang Pendaftaran', 'nominal' => 'Rp 300.000', 'keterangan' => 'Dibayar sekali saat pendaftaran'],
        ['nama' => 'SPP Bulanan', 'nominal' => 'Rp 1.250.000', 'keterangan' => 'Termin 1 sampai 7, mulai Juli 2028'],
        ['nama' => 'Kegiatan Tahunan', 'nominal' => 'Rp 750.000', 'keterangan' => 'Perkiraan biaya kegiatan tahunan'],
    ],

    'program' => [
        [
            'ikon' => 'academic-cap',
            'judul' => 'Tahfidz Al-Qur\'an',
            'deskripsi' => 'Program hafalan bertahap dengan target satu juz setiap tahun dan murajaah terjadwal.',
            'tag' => 'Unggulan',
        ],
        [
            'ikon' => 'language',
            'judul' => 'Program Bilingual',
            'deskripsi' => 'Penguatan kemampuan berbahasa Inggris melalui pembicaraan dan baca tulis sejak kelas satu.',
            'tag' => 'Bahasa',
        ],
        [
            'ikon' => 'beaker',
            'judul' => 'Sains Terapan',
            'deskripsi' => 'Pembelajaran sains berbasis percobaan sederhana agar anak memahami konsep secara langsung.',
            'tag' => 'STEM',
        ],
        [
            'ikon' => 'paint-brush',
            'judul' => 'Seni dan Musik',
            'deskripsi' => 'Kelas ekspresif mingguan untuk mengembangkan kreativitas, motorik, dan rasa estetika.',
            'tag' => 'Kreatif',
        ],
        [
            'ikon' => 'computer',
            'judul' => 'Literasi Digital',
            'deskripsi' => 'Pembelajaran komputer dasar, keamanan internet, dan etika digital yang relevan dengan kehidupan anak.',
            'tag' => 'Teknologi',
        ],
        [
            'ikon' => 'wrench',
            'judul' => 'Kemandirian',
            'deskripsi' => 'Latihan kemandirian, kedisiplinan, dan budaya kerja sama yang kuat.',
            'tag' => 'Karakter',
        ],
        [
            'ikon' => 'trophy',
            'judul' => 'Olimpiade dan Lomba',
            'deskripsi' => 'Pembinaan lomba akademik dan nonakademik untuk murid yang berambisi.',
            'tag' => 'Prestasi',
        ],
        [
            'ikon' => 'heart',
            'judul' => 'Pendampingan Emosi',
            'deskripsi' => 'Konseling kelas, jurnal emosi, dan pembiasaan kecakapan emosional yang sehat.',
            'tag' => 'Kesejahteraan',
        ],
    ],

    'sejarah' => [
        ['tahun' => '2004', 'judul' => 'Berdiri', 'deskripsi' => 'Dirintis oleh yayasan pendidikan Citra Mulia pada 12 Agustus 2004.'],
        ['tahun' => '2009', 'judul' => 'Program Tahfidz', 'deskripsi' => 'Memulai program hafalan Al-Qur\'an untuk murid kelas dua.'],
        ['tahun' => '2015', 'judul' => 'Akreditasi A', 'deskripsi' => 'Meraih akreditasi Unggul dari Badan Akreditasi Nasional.'],
        ['tahun' => '2019', 'judul' => 'Program Bilingual', 'deskripsi' => 'Meluncurkan program bilingual untuk kelas satu sampai enam.'],
        ['tahun' => '2023', 'judul' => 'Ekosistem Digital', 'deskripsi' => 'Digitalisasi buku penghubung digital dan platform pembelajaran.'],
        ['tahun' => '2026', 'judul' => 'Ruang Kolaborasi', 'deskripsi' => 'Penataan ruang kolaborasi untuk pembelajaran berbasis proyek.'],
    ],

    'visi_misi' => [
        'Visi' => 'Menjadi sekolah dasar Islam terpadu yang unggul dalam bidang akademik, akhlak, dan keterampilan abad ke-21.',
        'Misi' => [
            'Menyelenggarakan pembelajaran yang menarik menggunakan Kurikulum Merdeka secara tepat sasaran.',
            'Menanamkan nilai keislaman, keimanan, dan akhlak mulia dalam keseharian murid.',
            'Mengembangkan literasi, numerasi, dan literasi digital secara sesuai usia.',
            'Membangun budaya disiplin, mandiri, dan cinta belajar.',
            'Mewujudkan kemitraan aktif bersama orang tua dan masyarakat.',
        ],
    ],

    'mata_pelajaran' => [
        ['nama' => 'Pendidikan Agama Islam', 'deskripsi' => 'Al-Qur\'an, hadis, fikih dasar, akhlak, dan pembiasaan ibadah.'],
        ['nama' => 'Bahasa Indonesia', 'deskripsi' => 'Membaca, menulis, berbicara, dan literasi cerita.'],
        ['nama' => 'Matematika', 'deskripsi' => 'Berhitung, geometri, pengukuran, dan pemecahan masalah.'],
        ['nama' => 'IPAS', 'deskripsi' => 'Pengetahuan alam dan sosial terpadu dengan pendekatan percobaan.'],
        ['nama' => 'Bahasa Inggris', 'deskripsi' => 'Kosakata harian, pelafalan, dan membaca teks sederhana.'],
        ['nama' => 'Pendidikan Pancasila', 'deskripsi' => 'Penguatan Profil Pelajar Pancasila dan pembiasaan sikap kewargaan.'],
        ['nama' => 'Informatika dan Seni', 'deskripsi' => 'Komputer dasar, seni rupa, dan musik.'],
    ],

    'ekstrakurikuler' => [
        ['nama' => 'Tahfidz Club', 'kategori' => 'Religius', 'jadwal' => 'Senin dan Kamis, 13.00 - 14.00'],
        ['nama' => 'Pramuka', 'kategori' => 'Kepanduan', 'jadwal' => 'Jumat, 13.00 - 15.00'],
        ['nama' => 'Futsal', 'kategori' => 'Olahraga', 'jadwal' => 'Rabu dan Sabtu, 07.00 - 08.30'],
        ['nama' => 'English Club', 'kategori' => 'Bahasa', 'jadwal' => 'Kamis, 13.00 - 14.00'],
        ['nama' => 'Robotik', 'kategori' => 'STEM', 'jadwal' => 'Selasa, 13.00 - 14.30'],
        ['nama' => 'Marching Band', 'kategori' => 'Musik', 'jadwal' => 'Selasa dan Jumat, 13.00 - 14.30'],
        ['nama' => 'Panahan', 'kategori' => 'Olahraga', 'jadwal' => 'Sabtu, 08.30 - 10.30'],
        ['nama' => 'Kaligrafi', 'kategori' => 'Seni', 'jadwal' => 'Rabu, 13.00 - 14.00'],
    ],

    'jadwal' => [
        ['jam' => '07.15 - 07.35', 'kegiatan' => 'Upacara bendera dan salat Duha', 'hari' => 'Senin'],
        ['jam' => '07.35 - 08.55', 'kegiatan' => 'Pembelajaran pagi kelas 1 dan 2', 'hari' => 'Senin sampai Jumat'],
        ['jam' => '08.55 - 09.10', 'kegiatan' => 'Rekong', 'hari' => 'Senin sampai Jumat'],
        ['jam' => '09.10 - 10.30', 'kegiatan' => 'Pembelajaran pagi kelas 3 sampai 6', 'hari' => 'Senin sampai Jumat'],
        ['jam' => '10.30 - 11.00', 'kegiatan' => 'Istirahat dan salat Dhuha', 'hari' => 'Senin sampai Jumat'],
        ['jam' => '11.00 - 12.15', 'kegiatan' => 'Pembelajaran siang', 'hari' => 'Senin sampai Jumat'],
        ['jam' => '12.15 - 12.45', 'kegiatan' => 'Salat Dzuhur dan makan siang', 'hari' => 'Senin sampai Jumat'],
        ['jam' => '12.45 - 14.00', 'kegiatan' => 'Ekstrakurikuler sesuai pilihan murid', 'hari' => 'Senin sampai Jumat'],
    ],

];
