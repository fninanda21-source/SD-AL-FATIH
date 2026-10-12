@php
    $menu = [
        ['label' => 'Beranda', 'route' => 'beranda'],
        ['label' => 'Profil', 'route' => 'profil'],
        ['label' => 'Akademik', 'route' => 'akademik'],
        ['label' => 'Pengajar', 'route' => 'pengajar'],
        ['label' => 'Galeri', 'route' => 'galeri'],
        ['label' => 'Berita', 'route' => 'berita.index'],
        ['label' => 'Kontak', 'route' => 'kontak'],
    ];
@endphp

@php
    $wa = 'https://wa.me/'.config('sekolah.whatsapp');
@endphp

@php
    $tujuanDasbor = route('admin.login');
$teksDasbor = 'Masuk Dasbor Admin';
$teksDasborDesktop = 'Dasbor';
@endphp

<header x-data="{ open: false, scrolled: false }" x-on:scroll.window="scrolled = window.scrollY > 20"
    class="sticky top-0 z-50 w-full transition duration-300"
    :class="scrolled ? 'bg-brand-700/95 shadow-soft backdrop-blur-md' : 'bg-brand-700'">

    <div class="hidden border-b border-white/10 bg-brand-950 text-brand-100 lg:block">
        <div class="container-page flex h-10 items-center justify-between text-xs">
            <p class="flex items-center gap-2">
                <x-icon name="map-pin" class="size-3.5 text-gold-300" />
                {{ config('sekolah.alamat') }}
            </p>
            <div class="flex items-center gap-6">
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', config('sekolah.telepon')) }}"
                    class="flex items-center gap-1.5 transition hover:text-gold-300">
                    <x-icon name="phone" class="size-3.5" />
                    {{ config('sekolah.telepon') }}
                </a>
                <a href="mailto:{{ config('sekolah.email') }}"
                    class="flex items-center gap-1.5 transition hover:text-gold-300">
                    <x-icon name="envelope" class="size-3.5" />
                    {{ config('sekolah.email') }}
                </a>
                <span class="flex items-center gap-1.5">
                    <x-icon name="clock" class="size-3.5" />
                    NPSN {{ config('sekolah.npsn') }}
                </span>
            </div>
        </div>
    </div>

    <nav class="container-page flex h-18 items-center justify-between gap-4 py-3.5">
        <a href="{{ route('beranda') }}" class="flex shrink-0 items-center gap-3">
            <x-logo class="size-11" />
            <span class="flex flex-col leading-tight">
                <span class="text-lg font-extrabold tracking-tight text-white">
                    {{ $namaSekolah ?? config('app.name') }}
                </span>
                <span class="text-[0.68rem] font-semibold tracking-widest text-gold-300 uppercase">
                    Sekolah Dasar Islam Terpadu
                </span>
            </span>
        </a>

        <ul class="hidden items-center gap-1 lg:flex">
            @foreach ($menu as $item)
                @php $active = request()->routeIs($item['route']); @endphp
                <li>
                    <a href="{{ route($item['route']) }}"
                        @class([
                            'relative rounded-lg px-3.5 py-2 text-sm font-semibold transition',
                            'bg-white/15 text-white' => $active,
                            'text-brand-100 hover:bg-white/10 hover:text-white' => ! $active,
                        ])
                        @if ($active) aria-current="page" @endif>
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="flex items-center gap-2">
            <a href="{{ $tujuanDasbor }}" class="btn-ghost-light hidden !px-3.5 lg:inline-flex">
                <x-icon name="shield-check" class="size-4 text-white" />
                Dasbor
            </a>
            <a href="{{ route('kontak') }}" target="_blank" rel="noopener"
                class="btn-ghost-light hidden !px-3.5 xl:inline-flex">
                <x-icon name="whatsapp" class="size-4 text-white" />
                <span class="sr-only">Hubungi via WhatsApp</span>
            </a>
            <a href="{{ route('ppdb') }}" class="btn-accent hidden sm:inline-flex">
                Daftar PPDB
                <x-icon name="arrow-right" class="size-4" />
            </a>

            <button type="button" x-on:click="open = ! open" class="btn !px-2.5 lg:hidden"
                :class="open ? 'bg-white/20 text-white' : 'bg-white/10 text-white'"
                :aria-expanded="open" aria-controls="menu-mobile" aria-label="Buka menu navigasi">
                <x-icon name="menu" class="size-6" x-show="! open" />
                <x-icon name="x-mark" class="size-6" x-show="open" x-cloak />
            </button>
        </div>
    </nav>

    <div id="menu-mobile" x-show="open" x-transition x-cloak
        class="border-t border-white/10 bg-brand-700 lg:hidden">
        <ul class="container-page grid gap-1 py-4">
            @foreach ($menu as $item)
                @php $active = request()->routeIs($item['route']); @endphp
                <li>
                    <a href="{{ route($item['route']) }}"
                        @class([
                            'flex items-center justify-between rounded-xl px-4 py-3 text-sm font-semibold transition',
                            'bg-white/15 text-white' => $active,
                            'text-brand-100 hover:bg-white/10 hover:text-white' => ! $active,
                        ])>
                        {{ $item['label'] }}
                        <x-icon name="chevron-right" class="size-4 opacity-40" />
                    </a>
                </li>
            @endforeach
            <li class="mt-2 grid grid-cols-2 gap-2">
                <a href="{{ route('ppdb') }}" class="btn-accent">Daftar PPDB</a>
                <a href="{{ $wa }}" target="_blank" rel="noopener" class="btn-ghost-light">WhatsApp</a>
            </li>
            <li class="mt-1">
                <a href="{{ $tujuanDasbor }}"
                    class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-semibold text-brand-100 transition hover:bg-white/10 hover:text-white">
                    <span class="flex items-center gap-2.5">
                        <x-icon name="shield-check" class="size-4" />
                        {{ auth()->check() ? 'Buka Dasbor Admin' : 'Masuk Dasbor Admin' }}
                    </span>
                    <x-icon name="chevron-right" class="size-4 opacity-40" />
                </a>
            </li>
        </ul>
    </div>
</header>
