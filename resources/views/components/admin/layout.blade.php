@props(['title' => 'Dasbor'])

@php
    $navigasi = [
        ['label' => 'Dasbor', 'route' => 'admin.dashboard', 'ikon' => 'home'],
        ['label' => 'Pendaftaran PPDB', 'route' => 'admin.ppdb.index', 'ikon' => 'clipboard-check'],
        ['label' => 'Berita', 'route' => 'admin.berita.index', 'ikon' => 'document-text'],
        ['label' => 'Galeri', 'route' => 'admin.galeri.index', 'ikon' => 'photo'],
        ['label' => 'Guru', 'route' => 'admin.guru.index', 'ikon' => 'users'],
        ['label' => 'Kotak Masuk', 'route' => 'admin.pesan.index', 'ikon' => 'envelope', 'badge' => \App\Models\Pesan::where('dibaca', false)->count()],
    ];
@endphp

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ $title }} - Dasbor {{ $namaSekolah ?? config('app.name') }}</title>

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen bg-ink-50/70">
    <div x-data="{sidebar: false}" class="flex min-h-screen">
        <div x-show="sidebar" x-transition.opacity x-cloak
            class="fixed inset-0 z-40 bg-ink-950/50 lg:hidden" x-on:click="sidebar = false"></div>

        <aside
            class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col bg-brand-950 text-brand-100 transition duration-300 lg:static lg:translate-x-0"
            :class="sidebar ? 'translate-x-0' : '-translate-x-full'">
            <div class="flex items-center gap-3 border-b border-white/10 px-6 py-5">
                <x-logo class="size-11" />
                <div class="min-w-0">
                    <p class="truncate text-sm font-extrabold text-white">Dasbor Admin</p>
                    <p class="truncate text-xs text-brand-200/70">{{ $namaSingkat ?? config('app.name') }}</p>
                </div>
                <button type="button" class="ml-auto text-brand-200 lg:hidden" x-on:click="sidebar = false"
                    aria-label="Tutup menu">
                    <x-icon name="x-mark" class="size-6" />
                </button>
            </div>

            <nav class="flex-1 space-y-1 overflow-y-auto px-4 py-6">
                @foreach ($navigasi as $item)
                    @php $active = request()->routeIs($item['route']); @endphp
                    <a href="{{ route($item['route']) }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold transition"
                        @class([
                            'bg-brand-700 text-white shadow-soft' => $active,
                            'text-brand-100/80 hover:bg-white/5 hover:text-white' => ! $active,
                        ])>
                        <x-icon :name="$item['ikon']" class="size-5" />
                        <span class="flex-1">{{ $item['label'] }}</span>
                        @if (($item['badge'] ?? 0) > 0)
                            <span class="rounded-full bg-gold-400 px-2 py-0.5 text-xs font-bold text-brand-950">
                                {{ $item['badge'] }}
                            </span>
                        @endif
                    </a>
                @endforeach
            </nav>

            <div class="space-y-1 border-t border-white/10 px-4 py-5">
                <a href="{{ route('beranda') }}" target="_blank" rel="noopener"
                    class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold text-brand-100/80 transition hover:bg-white/5 hover:text-white">
                    <x-icon name="arrow-up-right" class="size-5" />
                    Lihat situs web
                </a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex w-full items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-semibold text-brand-100/80 transition hover:bg-white/5 hover:text-white">
                        <x-icon name="arrow-right-start-on-rectangle" class="size-5" />
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex min-w-0 flex-1 flex-col">
            <header class="sticky top-0 z-30 border-b border-ink-100 bg-white/95 backdrop-blur-md">
                <div class="flex items-center gap-4 px-4 py-4 sm:px-6 lg:px-8">
                    <button type="button" class="btn !px-2.5 lg:hidden" x-on:click="sidebar = true"
                        aria-label="Buka menu dasbor">
                        <x-icon name="menu" class="size-6" />
                    </button>

                    <div class="min-w-0 flex-1">
                        <p class="truncate text-lg font-extrabold text-ink-900">{{ $title }}</p>
                        <p class="truncate text-xs text-ink-500">
                            {{ now()->translatedFormat('l, d F Y') }} - {{ auth()->user()->name }}
                        </p>
                    </div>

                    @yield('aksi-halaman')
                </div>
            </header>

            <main class="flex-1 px-4 py-8 sm:px-6 lg:px-8">
                @foreach ([
                    'sukses' => 'border-green-200 bg-green-50 text-green-800',
                    'perlu-login' => 'border-gold-200 bg-gold-50 text-gold-800',
                    'gagal' => 'border-red-200 bg-red-50 text-red-800',
                ] as $kunci => $kelas)
                    @if (session($kunci))
                        <div class="mb-6 flex items-start gap-3 rounded-xl border px-4 py-3 text-sm font-semibold {{ $kelas }}">
                            <x-icon name="check-badge" class="size-5 shrink-0" />
                            <p>{{ session($kunci) }}</p>
                        </div>
                    @endif
                @endforeach

                @if ($errors->any())
                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-800">
                        <p class="flex items-center gap-2">
                            <x-icon name="exclamation-triangle" class="size-5 shrink-0" />
                            Periksa kembali isian yang ditandai.
                        </p>
                        <ul class="mt-2 list-disc space-y-1 pl-6 font-medium">
                            @foreach ($errors->all() as $pesan)
                                <li>{{ $pesan }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
