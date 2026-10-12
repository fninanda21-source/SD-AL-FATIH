<x-admin.layout title="Dasbor">
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($statistik as $stat)
            @php
                $aksen = [
                    'brand' => 'bg-brand-50 text-brand-700',
                    'green' => 'bg-green-50 text-green-700',
                    'gold' => 'bg-gold-100 text-gold-700',
                    'ink' => 'bg-ink-100 text-ink-700',
                ][$stat['warna']];
            @endphp
            <a href="{{ route($stat['rute']) }}" class="card-hover flex items-start gap-4 p-5">
                <span class="flex size-12 shrink-0 items-center justify-center rounded-2xl {{ $aksen }}">
                    <x-icon :name="$stat['ikon']" class="size-6" />
                </span>
                <div class="min-w-0">
                    <p class="text-xs font-semibold tracking-wide text-ink-500 uppercase">{{ $stat['label'] }}</p>
                    <p class="mt-1 text-3xl font-extrabold text-ink-900">{{ $stat['nilai'] }}</p>
                    <p class="mt-1 truncate text-xs text-ink-400">{{ $stat['catatan'] }}</p>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-6 grid gap-4 sm:grid-cols-3">
        @foreach ($konten as $item)
            <a href="{{ route($item['rute']) }}" class="card flex items-center gap-3 p-5">
                <span class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-ink-50 text-ink-600">
                    <x-icon :name="$item['ikon']" class="size-5" />
                </span>
                <div>
                    <p class="text-2xl font-extrabold text-ink-900">{{ $item['nilai'] }}</p>
                    <p class="text-xs font-semibold tracking-wide text-ink-500 uppercase">{{ $item['label'] }}</p>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-2">
        <section class="card overflow-hidden">
            <div class="flex items-center justify-between gap-4 border-b border-ink-100 px-6 py-4">
                <h2 class="text-base">Pendaftaran Terbaru</h2>
                <a href="{{ route('admin.ppdb.index') }}" class="text-xs font-bold text-brand-700 hover:text-brand-800">
                    Lihat semua
                </a>
            </div>

            @if ($pendaftaranTerbaru->isEmpty())
                <p class="px-6 py-10 text-center text-sm text-ink-400">Belum ada pendaftaran masuk.</p>
            @else
                <ul class="divide-y divide-ink-100">
                    @foreach ($pendaftaranTerbaru as $item)
                        <li>
                            <a href="{{ route('admin.ppdb.show', $item) }}"
                                class="flex items-center gap-4 px-6 py-4 transition hover:bg-ink-50/70">
                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-sm font-bold text-ink-900">{{ $item->nama_anak }}</p>
                                    <p class="truncate text-xs text-ink-500">
                                        {{ $item->kode }} - {{ $item->kelas_tujuan }} -
                                        {{ $item->created_at->translatedFormat('d M Y') }}
                                    </p>
                                </div>
                                <x-admin.status-pendaftaran :status="$item->status" />
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>

        <section class="card overflow-hidden">
            <div class="flex items-center justify-between gap-4 border-b border-ink-100 px-6 py-4">
                <h2 class="text-base">Pesan Terbaru</h2>
                <a href="{{ route('admin.pesan.index') }}" class="text-xs font-bold text-brand-700 hover:text-brand-800">
                    Lihat semua
                </a>
            </div>

            @if ($pesanTerbaru->isEmpty())
                <p class="px-6 py-10 text-center text-sm text-ink-400">Belum ada pesan masuk.</p>
            @else
                <ul class="divide-y divide-ink-100">
                    @foreach ($pesanTerbaru as $item)
                        <li class="flex items-start gap-4 px-6 py-4">
                            <span
                                class="mt-1 size-2.5 shrink-0 rounded-full {{ $item->dibaca ? 'bg-ink-200' : 'bg-gold-400' }}"></span>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-bold text-ink-900">
                                    {{ $item->nama }}
                                    <span class="font-normal text-ink-400">- {{ $item->subjek ?: 'Tanpa subjek' }}</span>
                                </p>
                                <p class="line-clamp-2 text-xs leading-relaxed text-ink-500">{{ $item->pesan }}</p>
                            </div>
                            <span class="shrink-0 text-xs text-ink-400">
                                {{ $item->created_at->diffForHumans(short: true) }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
    </div>

    <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <a href="{{ route('admin.berita.create') }}" class="card-hover flex items-center gap-4 p-5">
            <span class="flex size-11 items-center justify-center rounded-xl bg-brand-50 text-brand-700">
                <x-icon name="newspaper" class="size-5" />
            </span>
            <p class="text-sm font-bold text-ink-900">Tulis berita baru</p>
        </a>
        <a href="{{ route('admin.galeri.create') }}" class="card-hover flex items-center gap-4 p-5">
            <span class="flex size-11 items-center justify-center rounded-xl bg-brand-50 text-brand-700">
                <x-icon name="photo" class="size-5" />
            </span>
            <p class="text-sm font-bold text-ink-900">Unggah foto galeri</p>
        </a>
        <a href="{{ route('beranda') }}" target="_blank" rel="noopener" class="card-hover flex items-center gap-4 p-5">
            <span class="flex size-11 items-center justify-center rounded-xl bg-ink-50 text-ink-600">
                <x-icon name="arrow-up-right" class="size-5" />
            </span>
            <p class="text-sm font-bold text-ink-900">Buka situs web</p>
        </a>
    </div>
</x-admin.layout>
