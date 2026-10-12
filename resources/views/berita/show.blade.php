@extends('layouts.app')

@section('title', $berita->judul.' - '.$namaSekolah)
@section('description', $berita->excerpt)

@section('content')
    <article>
        <header class="relative overflow-hidden bg-brand-950">
            <div class="absolute inset-0">
                <div class="absolute -top-24 right-0 size-96 rounded-full bg-brand-700/40 blur-3xl"></div>
                <div class="absolute -bottom-32 left-10 size-[26rem] rounded-full bg-gold-500/15 blur-3xl"></div>
            </div>

            <div class="container-page relative py-16 sm:py-20">
                <nav aria-label="Breadcrumb" class="mb-6 flex items-center gap-1.5 text-xs font-medium text-brand-200/70">
                    <a href="{{ route('beranda') }}" class="transition hover:text-gold-300">Beranda</a>
                    <x-icon name="chevron-right" class="size-3.5" />
                    <a href="{{ route('berita.index') }}" class="transition hover:text-gold-300">Berita</a>
                    <x-icon name="chevron-right" class="size-3.5" />
                    <span class="text-gold-300">{{ $berita->kategori }}</span>
                </nav>

                <div class="flex flex-wrap items-center gap-3 text-xs text-brand-200/80">
                    <span class="chip bg-white/10 text-gold-300">{{ $berita->kategori }}</span>
                    <time datetime="{{ $berita->tanggal->toDateString() }}">
                        {{ $berita->tanggal->translatedFormat('d F Y') }}
                    </time>
                    <span class="flex items-center gap-1.5">
                        <x-icon name="user" class="size-3.5" />
                        {{ $berita->penulis }}
                    </span>
                    <span class="flex items-center gap-1.5">
                        <x-icon name="play-circle" class="size-3.5" />
                        {{ number_format($berita->views, 0, ',', '.') }} kali dibaca
                    </span>
                </div>

                <h1 class="mt-5 max-w-3xl text-3xl text-white sm:text-4xl lg:text-5xl lg:leading-[1.1]">
                    {{ $berita->judul }}
                </h1>

                <p class="mt-5 max-w-2xl text-base leading-relaxed text-brand-100/80">
                    {{ $berita->excerpt }}
                </p>
            </div>
        </header>

        <div class="section">
            <div class="container-page grid gap-12 lg:grid-cols-12">
                <div class="lg:col-span-8">
                    <div class="overflow-hidden rounded-2xl bg-gradient-to-br from-brand-800 to-ink-900">
                        <div class="grid aspect-16/9 place-items-center">
                            <x-icon name="newspaper" class="size-16 text-white/20" />
                        </div>
                    </div>

                    <div class="prose-article mt-10">
                        {!! $berita->konten !!}
                    </div>

                    <div class="mt-12 flex flex-wrap items-center justify-between gap-4 border-t border-ink-100 pt-8">
                        <a href="{{ route('berita.index') }}" class="btn-outline">
                            <x-icon name="arrow-left" class="size-4" />
                            Kembali ke daftar berita
                        </a>
                        <a href="{{ route('kontak') }}" class="btn-primary">Hubungi Sekolah</a>
                    </div>
                </div>

                <aside class="lg:col-span-4">
                    <div class="sticky top-28 space-y-5">
                        <div class="card p-6">
                            <h2 class="text-base">Berita terbaru</h2>

                            <ul class="mt-5 space-y-5">
                                @foreach ($terbaru as $t)
                                    <li class="border-b border-ink-100 pb-5 last:border-0 last:pb-0">
                                        <span class="text-xs text-ink-500">
                                            {{ $t->tanggal->translatedFormat('d M Y') }}
                                        </span>
                                        <a href="{{ route('berita.show', $t) }}"
                                            class="mt-1.5 block text-sm leading-snug font-semibold text-ink-800 transition hover:text-brand-700">
                                            {{ $t->judul }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="rounded-2xl bg-brand-900 p-6 text-white">
                            <x-icon name="sparkles" class="size-7 text-gold-300" />
                            <p class="mt-4 text-base font-bold">Tertarik mendaftar?</p>
                            <p class="mt-2 text-sm leading-relaxed text-brand-100/80">
                                PPDB {{ config('sekolah.tahun_ajaran') }} sudah dibuka dengan kuota terbatas.
                            </p>
                            <a href="{{ route('ppdb') }}" class="btn-accent mt-5 w-full !py-2.5 text-xs">
                                Daftar Sekarang
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </article>
@endsection
