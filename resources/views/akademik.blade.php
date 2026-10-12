@extends('layouts.app')

@section('title', 'Program Akademik '. $namaSekolah)
@section('description', 'Kurikulum Merdeka, mata pelajaran, jadwal belajar, dan kegiatan ekstrakurikuler '.$namaSekolah.'.')

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'Program Akademik',
        'title' => 'Kurikulum Merdeka di '.$namaSekolah,
        'lead' => 'Pembelajaran tematik yang humanis, projektual, dan tidak membosankan.',
    ])

    <section class="section" id="kurikulum">
        <div class="container-page">
            @include('partials.section-heading', [
                'eyebrow' => 'Kurikulum Merdeka',
                'title' => 'Belajar dengan tujuan, bukan untuk nilai',
                'lead' => 'Kami memakai Kurikulum Merdeka dengan asesmen formatif yang menekankan pemahaman, bukan sekadar hafalan.',
            ])

            <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['Pembelajaran Tematik', 'Materi dari beberapa mata pelajaran dibahas secara utuh melalui tema yang dekat dengan kehidupan murid.', 'book-open'],
                    ['Projek Penguatan Profil', 'Projek pilihan murid untuk literasi, numerasi, karakter, dan literasi digital.', 'sparkles'],
                    ['Asesmen Formatif', 'Guru memetakan pemahaman murid secara berkala untuk menentukan langkah pembelajaran berikutnya.', 'document-text'],
                    ['Pembelajaran Diferensiasi', 'Aktivitas menyesuaikan untuk murid yang cepat, sedang, dan yang memerlukan pendampingan lebih.', 'users'],
                ] as [$judul, $deskripsi, $ikon])
                    <article class="card-hover h-full p-6">
                        <span class="flex size-12 items-center justify-center rounded-2xl bg-brand-50 text-brand-700">
                            <x-icon :name="$ikon" class="size-6" />
                        </span>
                        <h3 class="mt-5 text-base">{{ $judul }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-ink-500">{{ $deskripsi }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section-soft" id="mata-pelajaran">
        <div class="container-page">
            @include('partials.section-heading', [
                'eyebrow' => 'Mata Pelajaran',
                'title' => 'Mata pelajaran yang diajarkan',
                'lead' => 'Tujuh mata pelajaran utama yang membentuk karakter, ilmu, dan keterampilan murid.',
            ])

            <div class="mt-14 overflow-hidden rounded-2xl border border-ink-100 bg-white shadow-soft">
                <div class="hidden border-b border-ink-100 bg-ink-50/60 px-6 py-3 text-xs font-semibold uppercase tracking-wide text-ink-500 sm:grid sm:grid-cols-12 sm:gap-4">
                    <span class="sm:col-span-4">Mata pelajaran</span>
                    <span class="sm:col-span-8">Pembelajaran</span>
                </div>
                <div class="divide-y divide-ink-100">
                    @foreach ($mataPelajaran as $mapel)
                        <div class="grid gap-3 p-6 transition hover:bg-ink-50/60 sm:grid-cols-12 sm:items-center sm:gap-4">
                            <h3 class="text-sm font-bold text-ink-900 sm:col-span-4">{{ $mapel['nama'] }}</h3>
                            <p class="text-sm leading-relaxed text-ink-500 sm:col-span-8">{{ $mapel['deskripsi'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="kelas">
        <div class="container-page">
            @include('partials.section-heading', [
                'eyebrow' => 'Rombongan Belajar',
                'title' => 'Kelas 1 sampai 6',
                'lead' => 'Setiap kelas punya wali kelas yang menjadi pendamping utama orang tua di sekolah.',
            ])

            <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($kelas as $k)
                    <article class="card-hover overflow-hidden p-6">
                        <div class="flex items-center gap-3">
                            <span class="flex size-11 items-center justify-center rounded-xl text-sm font-extrabold text-white"
                                style="background-color: {{ $k->warna }}">
                                {{ $k->tingkat }}
                            </span>
                            <div>
                                <h3 class="text-base">{{ $k->nama }}</h3>
                                <p class="text-xs text-ink-500">Wali: {{ $k->waliKelas?->nama ?? 'Belum ditentukan' }}</p>
                            </div>
                        </div>

                        <p class="mt-4 text-sm leading-relaxed text-ink-500">{{ $k->deskripsi }}</p>

                        <div class="mt-5">
                            <div class="flex items-center justify-between text-xs font-semibold text-ink-500">
                                <span>{{ $k->terisi }} dari {{ $k->kapasitas }} kursi terisi</span>
                                <span>{{ $k->sisa_kursi }} tersisa</span>
                            </div>
                            <div class="mt-2 h-2 overflow-hidden rounded-full bg-ink-100">
                                <div class="h-full rounded-full"
                                    style="width: {{ min(100, round($k->terisi / max(1, $k->kapasitas) * 100)) }}%; background-color: {{ $k->warna }}">
                                </div>
                            </div>
                        </div>

                        @if (! empty($k->fasilitas))
                            <ul class="mt-5 flex flex-wrap gap-1.5">
                                @foreach ($k->fasilitas as $f)
                                    <li class="chip bg-ink-100 text-ink-600">{{ $f }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section section-soft" id="ekstrakurikuler">
        <div class="container-page">
            @include('partials.section-heading', [
                'eyebrow' => 'Ekstrakurikuler',
                'title' => 'Tempat murid menemukan bakat',
                'lead' => 'Delapan pilihan kegiatan yang dapat diambil murid setiap tahun.',
            ])

            <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($ekstrakurikuler as $e)
                    <article class="card-hover h-full p-6">
                        <span class="chip bg-brand-50 text-brand-700">{{ $e['kategori'] }}</span>
                        <h3 class="mt-4 text-base">{{ $e['nama'] }}</h3>
                        <p class="mt-2 flex items-start gap-2 text-sm text-ink-500">
                            <x-icon name="clock" class="mt-0.5 size-4 shrink-0" />
                            {{ $e['jadwal'] }}
                        </p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section" id="jadwal">
        <div class="container-page">
            @include('partials.section-heading', [
                'eyebrow' => 'Jadwal Harian',
                'title' => 'Satu hari di sekolah',
                'lead' => 'Rutinitas yang memberi ruang untuk belajar, ibadah, istirahat, dan bermain.',
            ])

            <div class="mt-14 overflow-hidden rounded-2xl border border-ink-100 bg-white shadow-soft">
                <div class="divide-y divide-ink-100">
                    @foreach ($jadwal as $s)
                        <div class="grid gap-2 p-6 sm:grid-cols-12 sm:items-center sm:gap-4">
                            <p class="text-sm font-extrabold text-brand-700 sm:col-span-3">{{ $s['jam'] }}</p>
                            <p class="text-sm font-semibold text-ink-900 sm:col-span-6">{{ $s['kegiatan'] }}</p>
                            <p class="text-xs text-ink-500 sm:col-span-3 sm:text-right">{{ $s['hari'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @include('partials.cta-ppdb')
@endsection
