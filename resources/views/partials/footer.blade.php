@php
    $sosial = collect(config('sekolah.sosial_media'));
    $tautan = [
        ['label' => 'Tentang Kami', 'route' => 'profil'],
        ['label' => 'Program Akademik', 'route' => 'akademik'],
        ['label' => 'Tenaga Pengajar', 'route' => 'pengajar'],
        ['label' => 'Galeri Kegiatan', 'route' => 'galeri'],
        ['label' => 'Informasi PPDB', 'route' => 'ppdb'],
    ];
    $tautanLain = [
        ['label' => 'Berita Sekolah', 'route' => 'berita.index'],
        ['label' => 'Kontak', 'route' => 'kontak'],
        ['label' => 'Ekstrakurikuler', 'route' => 'akademik', 'fragment' => '#ekstrakurikuler'],
        ['label' => 'Dasbor Admin', 'route' => 'admin.login'],
    ];
@endphp

<footer class="mt-auto bg-ink-950 text-ink-300">
    <div class="container-page grid gap-12 py-16 lg:grid-cols-12 lg:gap-8">
        <div class="lg:col-span-4">
            <a href="{{ route('beranda') }}" class="flex items-center gap-3">
                <x-logo class="size-12" />
                <span class="flex flex-col leading-tight">
                    <span class="text-lg font-extrabold text-white">{{ $namaSekolah ?? config('app.name') }}</span>
                    <span class="text-[0.68rem] font-semibold tracking-widest text-gold-300 uppercase">
                        Sekolah Dasar Islam Terpadu
                    </span>
                </span>
            </a>

            <p class="mt-6 max-w-sm text-sm leading-relaxed text-ink-400">
                {{ $taglineSekolah ?? '' }} Bersama orang tua, kami membangun kebiasaan belajar dan akhlak yang baik sejak dini.
            </p>

            <div class="mt-6 flex flex-wrap gap-2">
                @foreach ($sosial as $s)
                    <a href="{{ $s['url'] }}" target="_blank" rel="noopener"
                        class="flex size-10 items-center justify-center rounded-xl bg-white/5 text-ink-300 ring-1 ring-white/10 transition hover:bg-gold-400 hover:text-ink-950 hover:ring-gold-400"
                        title="{{ $s['nama'] }}">
                        <x-brand :name="$s['ikon']" class="size-4" />
                        <span class="sr-only">{{ $s['nama'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="lg:col-span-2">
            <h3 class="text-sm font-bold tracking-wide text-white uppercase">Menu</h3>
            <ul class="mt-5 space-y-3 text-sm">
                @foreach ($tautan as $t)
                    <li>
                        <a href="{{ route($t['route']) }}"
                            class="transition hover:text-gold-300">{{ $t['label'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="lg:col-span-2">
            <h3 class="text-sm font-bold tracking-wide text-white uppercase">Informasi</h3>
            <ul class="mt-5 space-y-3 text-sm">
                @foreach ($tautanLain as $t)
                    <li>
                        <a href="{{ route($t['route']) }}{{ $t['fragment'] ?? '' }}"
                            class="transition hover:text-gold-300">{{ $t['label'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="lg:col-span-4">
            <h3 class="text-sm font-bold tracking-wide text-white uppercase">Hubungi Kami</h3>
            <ul class="mt-5 space-y-4 text-sm">
                <li class="flex gap-3">
                    <x-icon name="map-pin" class="mt-0.5 size-4.5 shrink-0 text-gold-300" />
                    <span class="leading-relaxed text-ink-400">{{ config('sekolah.alamat') }}</span>
                </li>
                <li class="flex gap-3">
                    <x-icon name="phone" class="mt-0.5 size-4.5 shrink-0 text-gold-300" />
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', config('sekolah.telepon')) }}"
                        class="text-ink-400 transition hover:text-gold-300">{{ config('sekolah.telepon') }}</a>
                </li>
                <li class="flex gap-3">
                    <x-icon name="envelope" class="mt-0.5 size-4.5 shrink-0 text-gold-300" />
                    <a href="mailto:{{ config('sekolah.email') }}"
                        class="text-ink-400 transition hover:text-gold-300">{{ config('sekolah.email') }}</a>
                </li>
            </ul>

            <div class="mt-6 rounded-xl bg-white/5 p-4 ring-1 ring-white/10">
                <p class="text-xs font-semibold tracking-wide text-white uppercase">PPDB {{ config('sekolah.tahun_ajaran') }}</p>
                <p class="mt-1.5 text-sm text-ink-400">{{ config('sekolah.ppdb.periode') }}</p>
                <a href="{{ route('ppdb') }}"
                    class="btn-accent mt-4 w-full !py-2.5 text-xs">Daftar Sekarang</a>
            </div>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="container-page flex flex-col items-center justify-between gap-3 py-5 text-xs text-ink-500 sm:flex-row">
            <p>&copy; {{ now()->year }} {{ $namaSekolah ?? config('app.name') }}. Seluruh hak cipta dilindungi.</p>
            <p class="flex items-center gap-1.5">
                Dibangun dengan
                <span class="font-bold text-red-500">Laravel</span>
                &amp;
                <span class="font-bold text-sky-400">Tailwind CSS</span>
            </p>
        </div>
    </div>
</footer>
