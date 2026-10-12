<x-admin.layout title="Kotak Masuk">
    <div class="grid gap-4 sm:grid-cols-3">
        @foreach ([
            'semua' => ['label' => 'Semua pesan', 'nilai' => $total],
            'belum' => ['label' => 'Belum dibaca', 'nilai' => $belum],
            'sudah' => ['label' => 'Sudah dibaca', 'nilai' => $total - $belum],
        ] as $kunci => $ringkas)
            <a href="{{ route('admin.pesan.index', array_filter(['filter' => $kunci, 'cari' => $cari])) }}"
                class="card flex items-center gap-3 p-4 transition
                {{ $filter === $kunci ? 'border-brand-300 ring-1 ring-brand-200' : '' }}">
                <div>
                    <p class="text-2xl font-extrabold text-ink-900">{{ $ringkas['nilai'] }}</p>
                    <p class="text-xs font-semibold tracking-wide text-ink-500 uppercase">{{ $ringkas['label'] }}</p>
                </div>
            </a>
        @endforeach
    </div>

    <form method="GET" action="{{ route('admin.pesan.index') }}" class="mt-6 flex flex-wrap items-end gap-3">
        <input type="hidden" name="filter" value="{{ $filter }}">
        <div class="min-w-56 flex-1">
            <label for="cari" class="form-label">Cari pesan</label>
            <input id="cari" name="cari" value="{{ $cari }}" placeholder="Nama, subjek, atau isi pesan" class="form-input">
        </div>
        <button type="submit" class="btn-primary">Cari</button>
        @if ($cari)
            <a href="{{ route('admin.pesan.index', ['filter' => $filter]) }}" class="btn-outline">Reset</a>
        @endif
    </form>

    <div class="mt-6 space-y-3">
        @forelse ($pesan as $item)
            <article @class([
                'card p-6',
                'ring-1 ring-gold-200' => ! $item->dibaca,
            ])>
                <div class="flex flex-wrap items-start gap-4">
                    <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-sm font-extrabold text-brand-700">
                        {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::of($item->nama)->explode(' ')->take(2)->map(fn ($bagian) => \Illuminate\Support\Str::substr($bagian, 0, 1))->implode('')) }}
                    </span>

                    <div class="min-w-56 flex-1">
                        <div class="flex flex-wrap items-center gap-2">
                            <p class="text-sm font-bold text-ink-900">{{ $item->nama }}</p>
                            <a href="mailto:{{ $item->email }}" class="text-xs text-brand-700 hover:underline">{{ $item->email }}</a>
                            @unless ($item->dibaca)
                                <span class="chip bg-gold-100 text-gold-800">Baru</span>
                            @endunless
                        </div>
                        <p class="mt-1 text-sm font-semibold text-ink-700">{{ $item->subjek ?: 'Tanpa subjek' }}</p>
                        <p class="mt-2 text-sm leading-relaxed whitespace-pre-line text-ink-500">{{ $item->pesan }}</p>
                        <p class="mt-3 text-xs text-ink-400">
                            Masuk {{ $item->created_at->translatedFormat('d F Y H:i') }}
                        </p>
                    </div>

                    <div class="flex items-center gap-1">
                        <form method="POST" action="{{ route('admin.pesan.update', $item) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="dibaca" value="{{ $item->dibaca ? 0 : 1 }}">
                            <button type="submit" title="{{ $item->dibaca ? 'Tandai belum dibaca' : 'Tandai sudah dibaca' }}"
                                class="flex size-9 items-center justify-center rounded-lg text-ink-500 transition hover:bg-brand-50 hover:text-brand-700">
                                @if ($item->dibaca)
                                    <x-icon name="envelope" class="size-5" />
                                @else
                                    <x-icon name="check" class="size-5" />
                                @endif
                            </button>
                        </form>

                        <a href="mailto:{{ $item->email }}" title="Balas lewat surel"
                            class="flex size-9 items-center justify-center rounded-lg text-ink-500 transition hover:bg-brand-50 hover:text-brand-700">
                            <x-icon name="arrow-up-right" class="size-5" />
                        </a>

                        <form method="POST" action="{{ route('admin.pesan.destroy', $item) }}"
                            onsubmit="return confirm('Hapus pesan dari {{ $item->nama }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus"
                                class="flex size-9 items-center justify-center rounded-lg text-ink-500 transition hover:bg-red-50 hover:text-red-600">
                                <x-icon name="x-mark" class="size-5" />
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="card px-6 py-16 text-center">
                <span class="mx-auto flex size-14 items-center justify-center rounded-2xl bg-ink-50 text-ink-300">
                    <x-icon name="envelope" class="size-7" />
                </span>
                <p class="mt-4 text-sm font-semibold text-ink-600">Tidak ada pesan yang cocok.</p>
            </div>
        @endforelse
    </div>

    @if ($pesan->hasPages())
        <div class="mt-6">
            {{ $pesan->links() }}
        </div>
    @endif
</x-admin.layout>
