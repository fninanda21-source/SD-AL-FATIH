@extends('layouts.app')

@section('title', 'Profil '. $namaSekolah)
@section('description', 'Sejarah, visi, misi, dan fasilitas '.$namaSekolah.', sekolah dasar Islam terpadu di Kota Pekanbaru.')

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'Profil Sekolah',
        'title' => 'Mengenal '.$namaSekolah,
        'lead' => 'Pendidikan yang memadukan kecintaan pada ilmu, kecintaan pada Al-Qur\'an, dan tanggung jawab kepada sesama.',
    ])

    <section class="section">
        <div class="container-page grid gap-14 lg:grid-cols-12 lg:gap-12">
            <div class="lg:col-span-7">
                <h2 class="section-title text-2xl sm:text-3xl">Sekolah yang tumbuh bersama zaman</h2>

                <div class="prose-article mt-6">
                    <p>
                        {{ $namaSekolah }} berdiri pada tahun 2004 atas kecetakan para pendiri yang menghendaki
                        sebuah sekolah dasar Islam yang mengajar anak dengan cara yang hangat, inklusif, dan
                        berakar pada nilai keislaman.
                    </p>
                    <p>
                        Selama dua dekade, sekolah ini tumbuh menjadi salah satu sekolah dasar Islam terpadu
                        favorit di Kota Pekanbaru. Kami percaya bahwa anak usia dini belajar paling baik ketika
                        merasa aman, dihargai, dan memiliki ruang untuk mencoba.
                    </p>
                    <p>
                        Karena itu, setiap keputusan di sekolah selalu kami ukur dari satu pertanyaan sederhana:
                        apakah ini baik untuk anak?
                    </p>
                </div>

                <div class="mt-10 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl border border-ink-100 bg-ink-50/60 p-6">
                        <x-icon name="map-pin" class="size-6 text-brand-700" />
                        <p class="mt-4 text-sm font-bold text-ink-900">Lokasi</p>
                        <p class="mt-1 text-sm leading-relaxed text-ink-500">
                            {{ config('sekolah.alamat') }}
                        </p>
                    </div>
                    <div class="rounded-2xl border border-ink-100 bg-ink-50/60 p-6">
                        <x-icon name="building-library" class="size-6 text-brand-700" />
                        <p class="mt-4 text-sm font-bold text-ink-900">Legalitas</p>
                        <p class="mt-1 text-sm leading-relaxed text-ink-500">
                            NPSN {{ config('sekolah.npsn') }}<br>
                            Akreditasi Unggul, izin operasional berlaku
                        </p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="sticky top-28 space-y-5">
                    @if ($kepalaSekolah)
                        <div class="card overflow-hidden">
                            <div class="grid aspect-4/3 place-items-center bg-gradient-to-br from-brand-100 to-brand-50">
                                <span class="text-5xl font-extrabold text-brand-700">{{ $kepalaSekolah->inisial }}</span>
                            </div>
                            <div class="p-6">
                                <span class="chip bg-gold-100 text-gold-800">Kepala Sekolah</span>
                                <h3 class="mt-3 text-lg">{{ $kepalaSekolah->nama }}</h3>
                                <p class="mt-3 text-sm leading-relaxed text-ink-500">{{ $kepalaSekolah->bio }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="card p-6">
                        <p class="text-sm font-bold text-ink-900">Ingin tahu lebih lanjut?</p>
                        <a href="{{ route('kontak') }}" class="btn-primary mt-4 w-full">Hubungi Sekolah</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section section-soft">
        <div class="container-page grid gap-8 lg:grid-cols-2">
            <div class="card p-8 sm:p-10">
                <span class="eyebrow">Visi</span>
                <p class="mt-5 text-xl leading-relaxed font-bold text-ink-900 sm:text-2xl">
                    {{ $visiMisi['Visi'] }}
                </p>
            </div>

            <div class="card p-8 sm:p-10">
                <span class="eyebrow">Misi</span>
                <ol class="mt-6 space-y-4">
                    @foreach ($visiMisi['Misi'] as $i => $misi)
                        <li class="flex gap-4">
                            <span class="flex size-7 shrink-0 items-center justify-center rounded-full bg-brand-700 text-xs font-extrabold text-white">
                                {{ $i + 1 }}
                            </span>
                            <p class="text-sm leading-relaxed text-ink-600">{{ $misi }}</p>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container-page">
            @include('partials.section-heading', [
                'eyebrow' => 'Perjalanan Kami',
                'title' => 'Jejak '.$namaSekolah,
                'lead' => 'Perjalanan panjang yang kami jalani bersama murid, orang tua, dan masyarakat.',
            ])

            <ol class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($sejarah as $item)
                    <li class="card p-6">
                        <span class="text-3xl font-extrabold text-brand-200">{{ $item['tahun'] }}</span>
                        <h3 class="mt-2 text-base">{{ $item['judul'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-ink-500">{{ $item['deskripsi'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section class="section section-soft">
        <div class="container-page">
            @include('partials.section-heading', [
                'eyebrow' => 'Fasilitas',
                'title' => 'Sarana yang mendukung tumbuh kembang anak',
                'lead' => 'Setiap fasilitas dibuat untuk mendukung kegiatan belajar murid kami.',
            ])

            <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($fasilitas as $item)
                    <article class="card-hover h-full p-6">
                        <span class="flex size-12 items-center justify-center rounded-2xl bg-brand-50 text-brand-700">
                            <x-icon :name="$item->ikon" class="size-6" />
                        </span>
                        <h3 class="mt-5 text-base">{{ $item->nama }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-ink-500">{{ $item->deskripsi }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.cta-ppdb')
@endsection
