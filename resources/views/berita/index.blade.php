@extends('layouts.app')

@section('title', 'Berita '. $namaSekolah)
@section('description', 'Kabar terbaru, prestasi, dan kegiatan di '.$namaSekolah.'.')

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'Berita & Informasi',
        'title' => 'Kabar dari sekolah',
        'lead' => 'Prestasi, kegiatan belajar, dan pengumuman resmi untuk orang tua dan murid.',
    ])

    <section class="section">
        <div class="container-page">
            <form method="GET" action="{{ route('berita.index') }}" class="mb-10 flex flex-col gap-3 sm:flex-row">
                <div class="flex-1">
                    <label for="cari" class="sr-only">Cari berita</label>
                    <input type="search" name="cari" id="cari" value="{{ $cari }}" placeholder="Cari judul atau isi berita..."
                        class="form-input">
                </div>

                @if ($kategori !== '')
                    <input type="hidden" name="kategori" value="{{ $kategori }}">
                @endif

                <button type="submit" class="btn-primary">Cari</button>

                @if ($cari !== '' || $kategori !== '')
                    <a href="{{ route('berita.index') }}" class="btn-outline">Reset</a>
                @endif
            </form>

            <div class="mb-10 flex flex-wrap gap-2">
                <a href="{{ route('berita.index', array_filter(['cari' => $cari])) }}"
                    class="chip !px-4 !py-2 transition"
                    @class([
                        'bg-brand-700 text-white' => $kategori === '',
                        'bg-white text-ink-600 ring-1 ring-ink-200 hover:bg-ink-50' => $kategori !== '',
                    ])>
                    Semua
                </a>

                @foreach ($daftarKategori as $k)
                    <a href="{{ route('berita.index', array_filter(['kategori' => $k, 'cari' => $cari])) }}"
                        class="chip !px-4 !py-2 transition"
                        @class([
                            'bg-brand-700 text-white' => $kategori === $k,
                            'bg-white text-ink-600 ring-1 ring-ink-200 hover:bg-ink-50' => $kategori !== $k,
                        ])>
                        {{ $k }}
                    </a>
                @endforeach
            </div>

            @if ($berita->isEmpty())
                <div class="card grid place-items-center p-16 text-center">
                    <x-icon name="newspaper" class="size-10 text-ink-300" />
                    <p class="mt-4 text-sm font-semibold text-ink-500">Berita yang Anda cari tidak ditemukan.</p>
                    <a href="{{ route('berita.index') }}" class="btn-outline mt-6">Lihat semua berita</a>
                </div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
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

                                <h2 class="mt-4 text-lg leading-snug">
                                    <a href="{{ route('berita.show', $b) }}" class="transition group-hover:text-brand-700">
                                        {{ $b->judul }}
                                    </a>
                                </h2>

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

                <div class="mt-14">
                    {{ $berita->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
