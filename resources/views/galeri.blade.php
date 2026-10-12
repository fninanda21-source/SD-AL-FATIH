@extends('layouts.app')

@section('title', 'Galeri Kegiatan '. $namaSekolah)
@section('description', 'Dokumentasi kegiatan belajar, ibadah, lomba, dan kegiatan luar kelas '.$namaSekolah.'.')

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'Galeri',
        'title' => 'Dokumentasi Kegiatan',
        'lead' => 'Potongan keseharian murid di kelas, di masjid, di lapangan, dan di luar sekolah.',
    ])

    @php
        $fotos = $galeri
            ->filter(fn ($f) => $f->gambar !== null)
            ->values()
            ->map(fn ($f) => [
                'src' => asset($f->gambar),
                'judul' => $f->judul,
                'kategori' => $f->kategori,
                'caption' => $f->caption,
                'tanggal' => $f->tanggal->translatedFormat('d F Y'),
            ]);
    @endphp

    <section class="section">
        <div class="container-page">
            <div class="mb-10 flex flex-wrap gap-2">
                <a href="{{ route('galeri') }}"
                    class="chip !px-4 !py-2 transition"
                    @class([
                        'bg-brand-700 text-white' => $kategori === '',
                        'bg-white text-ink-600 ring-1 ring-ink-200 hover:bg-ink-50' => $kategori !== '',
                    ])>
                    Semua
                </a>

                @foreach ($daftarKategori as $k)
                    <a href="{{ route('galeri', ['kategori' => $k]) }}"
                        class="chip !px-4 !py-2 transition"
                        @class([
                            'bg-brand-700 text-white' => $kategori === $k,
                            'bg-white text-ink-600 ring-1 ring-ink-200 hover:bg-ink-50' => $kategori !== $k,
                        ])>
                        {{ $k }}
                    </a>
                @endforeach
            </div>

            @if ($galeri->isEmpty())
                <div class="card grid place-items-center p-16 text-center">
                    <x-icon name="photo" class="size-10 text-ink-300" />
                    <p class="mt-4 text-sm font-semibold text-ink-500">Belum ada foto pada kategori ini.</p>
                </div>
            @else
                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3"
                    x-data="{
                        items: {{ Illuminate\Support\Js::from($fotos) }},
                        index: null,
                        get aktif() { return this.index === null ? null : this.items[this.index] },
                        buka(i) {
                            this.index = i
                            document.body.classList.add('overflow-hidden')
                            this.$nextTick(() => this.$refs.tutup?.focus())
                        },
                        tutup() {
                            this.index = null
                            document.body.classList.remove('overflow-hidden')
                        },
                        berikutnya() { this.index = (this.index + 1) % this.items.length },
                        sebelumnya() { this.index = (this.index - 1 + this.items.length) % this.items.length },
                    }"
                    x-on:keydown.escape.window="tutup()"
                    x-on:keydown.arrow-right.window="index !== null && berikutnya()"
                    x-on:keydown.arrow-left.window="index !== null && sebelumnya()">

                    @php $nomor = -1; @endphp

                    @foreach ($galeri as $foto)
                        @php $nomor = $foto->gambar ? $nomor + 1 : null; @endphp

                        <figure
                            class="group relative aspect-4/3 overflow-hidden rounded-2xl bg-ink-900 shadow-soft @if($foto->gambar) cursor-zoom-in @endif">

                            @if ($foto->gambar)
                                <img src="{{ asset($foto->gambar) }}" alt="{{ $foto->judul }}"
                                    class="size-full object-cover transition duration-500 group-hover:scale-105"
                                    loading="lazy" decoding="async">
                            @else
                                <div class="grid size-full place-items-center bg-gradient-to-br from-brand-800 to-ink-900">
                                    <x-icon name="photo" class="size-10 text-white/25" />
                                </div>
                            @endif

                            <figcaption
                                class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-ink-950/90 via-ink-950/25 to-transparent p-5">
                                <span class="self-start rounded-full bg-white/15 px-2.5 py-1 text-[0.68rem] font-bold text-gold-300 uppercase backdrop-blur-sm">
                                    {{ $foto->kategori }}
                                </span>
                                <h3 class="mt-3 text-base font-bold text-white">{{ $foto->judul }}</h3>
                                <p class="mt-1 line-clamp-2 text-xs leading-relaxed text-ink-300">{{ $foto->caption }}</p>
                                <p class="mt-3 text-[0.68rem] text-ink-400">
                                    {{ $foto->tanggal->translatedFormat('d F Y') }}
                                </p>
                            </figcaption>

                            @if ($foto->gambar)
                                <button type="button" x-on:click="buka({{ $nomor }})"
                                    class="absolute inset-0 z-10 focus-visible:rounded-2xl focus-visible:ring-2 focus-visible:ring-gold-400 focus-visible:outline-none"
                                    aria-label="Perbesar foto {{ $foto->judul }}">
                                    <span
                                        class="absolute right-3 bottom-3 flex size-9 items-center justify-center rounded-full bg-ink-950/70 text-white opacity-0 backdrop-blur-sm transition group-hover:opacity-100 focus-visible:opacity-100">
                                        <x-icon name="arrow-up-right" class="size-4" />
                                    </span>
                                </button>
                            @endif
                        </figure>
                    @endforeach

                    @if ($fotos->isNotEmpty())
                        <div x-show="index !== null" x-cloak x-transition.opacity
                            class="fixed inset-0 z-100 flex items-center justify-center p-4 sm:p-6"
                            role="dialog" aria-modal="true" :aria-label="aktif?.judul">

                            <div class="absolute inset-0 bg-ink-950/95 backdrop-blur-sm"
                                x-on:click="tutup()"></div>

                            <div class="relative flex max-h-full w-full max-w-5xl flex-col">
                                <div class="mb-3 flex items-start justify-between gap-4">
                                    <div class="min-w-0">
                                        <span
                                            class="inline-block rounded-full bg-white/15 px-2.5 py-1 text-[0.68rem] font-bold text-gold-300 uppercase backdrop-blur-sm"
                                            x-text="aktif?.kategori"></span>
                                        <h3 class="mt-2 text-lg font-extrabold text-white sm:text-xl"
                                            x-text="aktif?.judul"></h3>
                                    </div>

                                    <button type="button" x-ref="tutup" x-on:click="tutup()"
                                        class="flex size-10 shrink-0 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm transition hover:bg-white/20 focus-visible:ring-2 focus-visible:ring-gold-400 focus-visible:outline-none"
                                        aria-label="Tutup tampilan foto">
                                        <x-icon name="x-mark" class="size-5" />
                                    </button>
                                </div>

                                <template x-if="aktif">
                                    <div class="flex min-h-0 flex-1 items-center justify-center gap-2 sm:gap-4">
                                        <button type="button" x-show="items.length > 1" x-on:click="sebelumnya()"
                                            class="hidden size-11 shrink-0 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm transition hover:bg-white/20 focus-visible:ring-2 focus-visible:ring-gold-400 focus-visible:outline-none sm:flex"
                                            aria-label="Foto sebelumnya">
                                            <x-icon name="arrow-left" class="size-5" />
                                        </button>

                                        <img :src="aktif?.src" :alt="aktif?.judul"
                                            class="max-h-[65vh] w-auto max-w-full rounded-xl object-contain shadow-lift">

                                        <button type="button" x-show="items.length > 1" x-on:click="berikutnya()"
                                            class="hidden size-11 shrink-0 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm transition hover:bg-white/20 focus-visible:ring-2 focus-visible:ring-gold-400 focus-visible:outline-none sm:flex"
                                            aria-label="Foto berikutnya">
                                            <x-icon name="arrow-right" class="size-5" />
                                        </button>
                                    </div>
                                </template>

                                <template x-if="aktif">
                                    <div class="mt-3 flex items-center justify-between gap-4">
                                        <p class="min-w-0 text-xs leading-relaxed text-ink-300 sm:text-sm"
                                            x-text="aktif?.caption"></p>
                                        <p class="shrink-0 text-[0.68rem] text-ink-400" x-text="aktif?.tanggal"></p>
                                    </div>
                                </template>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </section>

    @include('partials.cta-ppdb')
@endsection
