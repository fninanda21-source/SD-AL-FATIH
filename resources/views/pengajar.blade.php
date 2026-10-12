@extends('layouts.app')

@section('title', 'Tenaga Pengajar '. $namaSekolah)
@section('description', 'Guru dan tenaga kependidikan '.$namaSekolah.' yang berdedikasi mendidik murid kelas satu sampai enam.')

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'Tenaga Pengajar',
        'title' => 'Guru-guru kami',
        'lead' => 'Guru yang tahu nama setiap murid, sabar, dan siap mendampingi.',
    ])

    <section class="section">
        <div class="container-page">
            <div class="mb-12 grid gap-4 sm:grid-cols-3">
                @foreach ([
                    ['Pengajar', $guru->count().' orang', 'users'],
                    ['Rasio kelas', '1 : 14 murid', 'document-text'],
                    ['Pengalaman rata-rata', '9 tahun', 'clock'],
                ] as [$judul, $nilai, $ikon])
                    <div class="card flex items-center gap-4 p-6">
                        <span class="flex size-12 shrink-0 items-center justify-center rounded-2xl bg-brand-50 text-brand-700">
                            <x-icon :name="$ikon" class="size-6" />
                        </span>
                        <div>
                            <p class="text-xs font-semibold tracking-wide text-ink-500 uppercase">{{ $judul }}</p>
                            <p class="mt-1 text-lg font-extrabold text-ink-900">{{ $nilai }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mb-10">
                <x-guru-marquee :guru="$guru" label="Galeris tenaga pengajar" />
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($guru as $g)
                    <article class="card-hover flex h-full flex-col overflow-hidden">
                        <div class="grid aspect-4/3 place-items-center bg-gradient-to-br from-brand-100 to-brand-50">
                            <span class="text-5xl font-extrabold text-brand-700">{{ $g->inisial }}</span>
                        </div>

                        <div class="flex flex-1 flex-col p-6">
                            @if ($g->jabatan !== 'Guru')
                                <span class="chip self-start bg-gold-100 text-gold-800">{{ $g->jabatan }}</span>
                            @endif

                            <h3 class="mt-3 text-lg leading-snug">{{ $g->nama }}</h3>
                            <p class="mt-1 text-sm font-semibold text-brand-600">
                                {{ $g->mata_pelicaran ?? $g->jabatan }}
                            </p>

                            <p class="mt-3 flex-1 text-sm leading-relaxed text-ink-500">{{ $g->bio }}</p>

                            <p class="mt-5 flex items-center gap-2 border-t border-ink-100 pt-4 text-xs text-ink-400">
                                <x-icon name="clipboard-check" class="size-4" />
                                NIP {{ $g->nip }}
                            </p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.cta-ppdb')
@endsection
