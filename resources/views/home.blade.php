@extends('layouts.app')

@section('title', $namaSekolah.' - '.$taglineSekolah)
@section('description', $taglineSekolah.' Daftar calon murid melalui PPDB online '.$namaSekolah.'.')

@section('content')
    <section class="relative overflow-hidden bg-white">
        <div class="absolute inset-0 -z-10">
            <div class="absolute -top-40 -right-32 size-[34rem] rounded-full bg-brand-100/50 blur-3xl"></div>
            <div class="absolute top-40 -left-40 size-[30rem] rounded-full bg-gold-200/40 blur-3xl"></div>
        </div>

        <div class="container-page grid items-center gap-16 py-12 sm:py-16 lg:grid-cols-2 lg:gap-20 lg:py-16">
            <div class="animate-fade-up">
                <span class="eyebrow">
                    <x-icon name="sparkles" class="size-3.5" />
                    Terakreditasi A - Tahun Ajaran {{ config('sekolah.tahun_ajaran') }}
                </span>

                <h1 class="mt-6 text-[2.5rem] leading-[1.08] sm:text-5xl lg:text-6xl">
                    Selamat datang di
                    <span class="relative inline-block whitespace-normal text-brand-700 lg:whitespace-nowrap">
                        {{ $namaSekolah }}
                        <svg class="absolute -bottom-1.5 left-0 w-full text-gold-400" height="10" viewBox="0 0 200 10" fill="none" preserveAspectRatio="none" aria-hidden="true">
                            <path d="M2 8c40-6 80-6 120-3 30 2 60 4 76 3" stroke="currentColor" stroke-width="4" stroke-linecap="round" />
                        </svg>
                    </span>
                </h1>

                <p class="mt-7 max-w-xl text-base leading-relaxed text-ink-500 sm:text-lg">
                    {{ $taglineSekolah }}. Kami memadukan Kurikulum Merdeka dengan pembelajaran berbasis
                    Al-Qur'an serta penguatan literasi digital.
                </p>

                <div class="mt-9 flex flex-wrap gap-3">
                    <a href="{{ route('ppdb') }}" class="btn-primary">
                        Daftar PPDB {{ config('sekolah.tahun_ajaran') }}
                        <x-icon name="arrow-right" class="size-4" />
                    </a>
                    <a href="{{ route('profil') }}" class="btn-outline">
                        <x-icon name="play-circle" class="size-4 text-brand-600" />
                        Kenali Kami
                    </a>
                </div>

                <dl class="mt-12 grid max-w-lg grid-cols-3 gap-6 border-t border-ink-100 pt-8">
                    @foreach ($statistik as $stat)
                        <div>
                            <dt class="text-2xl font-extrabold text-brand-700 sm:text-3xl">{{ $stat['nilai'] }}</dt>
                            <dd class="mt-1 text-xs font-semibold tracking-wide text-ink-500 uppercase sm:text-sm">
                                {{ $stat['label'] }}
                            </dd>
                        </div>
                    @endforeach
                </dl>
            </div>

            <div class="relative animate-fade-up [animation-delay:120ms]">
                <div class="relative mx-auto max-w-md">
                    <a href="{{ route('ppdb') }}"
                        class="group block overflow-hidden rounded-[2rem] bg-ink-100 shadow-lift ring-1 ring-black/5">
                        <img src="{{ asset('img/spmb-sd.jpg') }}" alt="Brosur PPDB {{ $namaSekolah }}"
                            class="aspect-4/5 w-full object-cover transition duration-500 group-hover:scale-105"
                            loading="lazy" decoding="async">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="border-y border-ink-100 bg-ink-50/60">
        <div class="container-page grid grid-cols-2 gap-6 py-10 sm:grid-cols-4">
            @foreach ([
                ['Akreditasi A', 'Peringkat Unggul', 'check-badge'],
                ['Kurikulum Merdeka', 'Standar Pembelajaran 2026', 'book-open'],
                ['Tahfidz Al-Qur\'an', 'Program Unggulan', 'academic-cap'],
                ['Kelas 1 sampai 6', 'Reguler dan Bilingual', 'users'],
            ] as [$judul, $sub, $ikon])
                <div class="flex items-start gap-3">
                    <span class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-white text-brand-700 shadow-soft">
                        <x-icon :name="$ikon" class="size-5" />
                    </span>
                    <div>
                        <p class="text-sm font-bold text-ink-900">{{ $judul }}</p>
                        <p class="text-xs text-ink-500">{{ $sub }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="relative overflow-hidden bg-brand-950">
        <div class="absolute inset-0">
            <div class="absolute -top-24 right-0 size-80 rounded-full bg-gold-500/20 blur-3xl"></div>
            <div class="absolute -bottom-24 left-10 size-96 rounded-full bg-brand-500/25 blur-3xl"></div>
            <div class="divider-dots absolute inset-0 text-white/5"></div>
        </div>

        <div class="container-page relative py-16 sm:py-20">
            <div class="flex flex-wrap items-end justify-between gap-6">
                <div class="max-w-2xl">
                    <span class="eyebrow !bg-white/10 !text-gold-300 !ring-white/15">
                        <span class="size-1.5 rounded-full bg-gold-400"></span>
                        Sekolah dalam Angka
                    </span>

                    <h2 class="mt-5 text-3xl text-white sm:text-4xl lg:leading-[1.1]">
                        Angka yang hidup di balik kegiatan harian kami
                    </h2>

                    <p class="mt-5 text-base leading-relaxed text-brand-100/80">
                        Data diperbarui otomatis dari sistem sekolah, mulai dari jumlah murid, guru,
                        rombongan belajar, sampai jumlah pendaftar PPDB.
                    </p>
                </div>

                <a href="{{ route('ppdb') }}" class="btn-accent">
                    Daftar PPDB {{ config('sekolah.tahun_ajaran') }}
                    <x-icon name="arrow-right" class="size-4" />
                </a>
            </div>

            <dl class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($angka as $item)
                    <div class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10 transition hover:bg-white/10">
                        <div class="flex items-center gap-3">
                            <span class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-gold-400/15 text-gold-300">
                                <x-icon :name="$item['ikon']" class="size-5" />
                            </span>
                            <dd class="text-3xl font-extrabold text-white sm:text-4xl">{{ $item['nilai'] }}</dd>
                        </div>
                        <dt class="mt-4 text-sm font-bold tracking-wide text-white uppercase">
                            {{ $item['label'] }}
                        </dt>
                        <p class="mt-1.5 text-sm leading-relaxed text-brand-100/70">
                            {{ $item['catatan'] }}
                        </p>
                    </div>
                @endforeach
            </dl>
        </div>
    </section>

    <section class="section">
        <div class="container-page">
            <div class="grid items-center gap-14 lg:grid-cols-2 lg:gap-16">
                <div class="relative order-2 lg:order-1">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="rounded-2xl bg-gradient-to-br from-brand-700 to-brand-900 p-6 text-white sm:p-8">
                            <x-icon name="heart" class="size-8 text-gold-300" />
                            <p class="mt-5 text-sm leading-relaxed text-brand-100/85">
                                Pendidikan terbaik adalah pendidikan yang membangun karakter, bukan sekadar
                                mengisi kepala dengan hafalan.
                            </p>
                        </div>
                        <div class="space-y-4">
                            <div class="rounded-2xl border border-ink-100 bg-white p-6 shadow-soft">
                                <p class="text-2xl font-extrabold text-brand-700">20+</p>
                                <p class="mt-1 text-xs font-semibold tracking-wide text-ink-500 uppercase">
                                    Tahun mengabdi
                                </p>
                            </div>
                            <div class="rounded-2xl border border-ink-100 bg-white p-6 shadow-soft">
                                <p class="text-2xl font-extrabold text-brand-700">92%</p>
                                <p class="mt-1 text-xs font-semibold tracking-wide text-ink-500 uppercase">
                                    Alumni lanjut studi
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2">
                    @include('partials.section-heading', [
                        'eyebrow' => 'Tentang Kami',
                        'title' => 'Mendidik dengan hati, tumbuh bersama keluarga',
                        'lead' => 'Sejak 2004, '.$namaSekolah.' mendampingi anak-anak Indonesia bertumbuh menjadi pribadi yang berakhlak mulia, unggul dalam ilmu, dan berani bermimpi.',
                        'align' => 'left',
                    ])

                    <ul class="mt-8 space-y-4">
                        @foreach ([
                            ['Pembelajaran berbasis Al-Qur\'an', 'Tahfidz, tilawah rutin, dan pembiasaan ibadah harian yang menyenangkan.', 'academic-cap'],
                            ['Kurikulum Merdeka yang humanis', 'Asesmen formatif, projek penguatan profil pelajar Pancasila, dan pembelajaran berbasis proyek.', 'book-open'],
                            ['Penguatan literasi digital', 'Literasi informasi, keamanan digital, dan pengenalan teknologi sejak dini secara bertanggung jawab.', 'computer'],
                            ['Kemitraan orang tua aktif', 'Kelas parenting, buku penghubung digital, dan komunikasi rutin lewat kelas wali.', 'users'],
                        ] as [$judul, $deskripsi, $ikon])
                            <li class="flex gap-4 rounded-2xl border border-ink-100 bg-white p-5 shadow-soft">
                                <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-700">
                                    <x-icon :name="$ikon" class="size-5" />
                                </span>
                                <div>
                                    <p class="text-sm font-bold text-ink-900">{{ $judul }}</p>
                                    <p class="mt-1 text-sm leading-relaxed text-ink-500">{{ $deskripsi }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('profil') }}" class="btn-primary mt-8">
                        Selengkapnya tentang sekolah
                        <x-icon name="arrow-right" class="size-4" />
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-soft">
        <div class="container-page">
            @include('partials.section-heading', [
                'eyebrow' => 'Program Unggulan',
                'title' => 'Pembelajaran yang tumbuh utuh',
                'lead' => 'Delapan program utama yang dirancang agar setiap murid berkembang secara akademik, emosional, spiritual, dan fisik.',
            ])

            <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($program as $item)
                    <article class="card-hover group flex h-full flex-col p-6">
                        <span class="flex size-12 items-center justify-center rounded-2xl bg-brand-50 text-brand-700 transition group-hover:bg-brand-700 group-hover:text-white">
                            <x-icon :name="$item['ikon']" class="size-6" />
                        </span>
                        <h3 class="mt-5 text-lg">{{ $item['judul'] }}</h3>
                        <p class="mt-2.5 flex-1 text-sm leading-relaxed text-ink-500">{{ $item['deskripsi'] }}</p>
                        <span class="chip mt-5 self-start bg-gold-100 text-gold-800">{{ $item['tag'] }}</span>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container-page">
            <div class="grid gap-14 lg:grid-cols-12 lg:gap-12">
                <div class="lg:col-span-5">
                    @include('partials.section-heading', [
                        'eyebrow' => 'Fasilitas',
                        'title' => 'Ruang belajar yang nyaman',
                        'lead' => 'Lingkungan yang bersih, aman, dan mendukung eksplorasi anak. Seluruh fasilitas kami rawat secara berkala setiap semester.',
                        'align' => 'left',
                    ])

                    <div class="mt-8 space-y-3">
                        @foreach ($fasilitas as $item)
                            <div class="flex items-start gap-4 rounded-2xl border border-ink-100 bg-white p-5 shadow-soft">
                                <span class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-700">
                                    <x-icon :name="$item['ikon']" class="size-5" />
                                </span>
                                <div>
                                    <p class="text-sm font-bold text-ink-900">{{ $item->nama }}</p>
                                    <p class="mt-1 text-sm leading-relaxed text-ink-500">{{ $item->deskripsi }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($galeri->take(4) as $foto)
                            <a href="{{ route('galeri') }}"
                                class="group relative block overflow-hidden rounded-2xl bg-ink-100 shadow-soft">
                                <div class="grid aspect-4/3 place-items-center bg-gradient-to-br from-brand-800 to-ink-900">
                                    <x-icon name="photo" class="size-10 text-white/25" />
                                </div>
                                <div class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-ink-950/85 via-ink-950/10 to-transparent p-4">
                                    <p class="text-xs font-semibold text-gold-300">{{ $foto->kategori }}</p>
                                    <p class="mt-1 text-sm font-bold text-white">{{ $foto->judul }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-6 flex flex-wrap items-center justify-between gap-4 rounded-2xl border border-ink-100 bg-white p-6 shadow-soft">
                        <div>
                            <p class="text-sm font-bold text-ink-900">Lihat seluruh dokumentasi kegiatan</p>
                            <p class="mt-1 text-sm text-ink-500">Ribuan foto kegiatan belajar, iqra, dan kegiatan luar kelas.</p>
                        </div>
                        <a href="{{ route('galeri') }}" class="btn-outline">Buka Galeri</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-soft">
        <div class="container-page">
            <div class="flex flex-wrap items-end justify-between gap-6">
                @include('partials.section-heading', [
                    'eyebrow' => 'Tenaga Pengajar',
                    'title' => 'Dibimbing oleh trainer terbaik',
                    'align' => 'left',
                ])

                <a href="{{ route('pengajar') }}" class="btn-outline">
                    Semua pengajar
                    <x-icon name="arrow-right" class="size-4" />
                </a>
            </div>

            <div class="mt-12">
                <x-guru-marquee :guru="$guru" :jumlah="8" label="Tenaga pengajar" />
            </div>
        </div>
    </section>

    <section class="section section-soft">
        <div class="container-page">
            <div class="flex flex-wrap items-end justify-between gap-6">
                @include('partials.section-heading', [
                    'eyebrow' => 'Berita & Informasi',
                    'title' => 'Kabar terbaru dari sekolah',
                    'align' => 'left',
                ])

                <a href="{{ route('berita.index') }}" class="btn-outline">
                    Semua berita
                    <x-icon name="arrow-right" class="size-4" />
                </a>
            </div>

            <div class="mt-12 grid gap-6 lg:grid-cols-3">
                @foreach ($berita as $b)
                    <article class="card-hover group flex h-full flex-col overflow-hidden">
                        <div class="grid aspect-16/10 place-items-center bg-gradient-to-br from-brand-800 to-ink-900">
                            <x-icon name="newspaper" class="size-10 text-white/25" />
                        </div>
                        <div class="flex flex-1 flex-col p-6">
                            <div class="flex items-center gap-3 text-xs text-ink-500">
                                <span class="chip bg-brand-50 text-brand-700">{{ $b->kategori }}</span>
                                <time datetime="{{ $b->tanggal->toDateString() }}">
                                    {{ $b->tanggal->translatedFormat('d M Y') }}
                                </time>
                            </div>
                            <h3 class="mt-4 text-lg leading-snug">
                                <a href="{{ route('berita.show', $b) }}" class="transition group-hover:text-brand-700">
                                    {{ $b->judul }}
                                </a>
                            </h3>
                            <p class="mt-3 line-clamp-3 flex-1 text-sm leading-relaxed text-ink-500">
                                {{ $b->excerpt }}
                            </p>
                            <a href="{{ route('berita.show', $b) }}"
                                class="mt-5 inline-flex items-center gap-1.5 text-sm font-bold text-brand-700">
                                Baca selengkapnya
                                <x-icon name="arrow-right" class="size-4 transition group-hover:translate-x-1" />
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.cta-ppdb')
@endsection
