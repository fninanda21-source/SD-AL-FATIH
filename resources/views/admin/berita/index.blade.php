<x-admin.layout title="Berita">
    <x-slot:aksi-halaman>
        <a href="{{ route('admin.berita.create') }}" class="btn-primary !py-2.5">
            <x-icon name="sparkles" class="size-4" />
            Tulis berita
        </a>
    </x-slot:aksi-halaman>

    <form method="GET" action="{{ route('admin.berita.index') }}" class="flex flex-wrap items-end gap-3">
        <div class="min-w-56 flex-1">
            <label for="cari" class="form-label">Cari berita</label>
            <input id="cari" name="cari" value="{{ $cari }}" placeholder="Judul atau kategori" class="form-input">
        </div>
        <button type="submit" class="btn-primary">Cari</button>
        @if ($cari)
            <a href="{{ route('admin.berita.index') }}" class="btn-outline">Reset</a>
        @endif
    </form>

    <div class="card mt-6 overflow-hidden">
        @if ($berita->isEmpty())
            <p class="px-6 py-14 text-center text-sm text-ink-400">Belum ada berita.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full min-w-3xl text-left text-sm">
                    <thead class="border-b border-ink-100 bg-ink-50/70 text-xs tracking-wide text-ink-500 uppercase">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Cover</th>
                            <th class="px-6 py-4 font-semibold">Judul</th>
                            <th class="px-6 py-4 font-semibold">Kategori</th>
                            <th class="px-6 py-4 font-semibold">Tanggal</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                            <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-ink-100">
                        @foreach ($berita as $item)
                            <tr class="transition hover:bg-ink-50/70">
                                <td class="px-6 py-4">
                                    <div class="h-14 w-20 shrink-0 overflow-hidden rounded-lg bg-ink-50 ring-1 ring-ink-100">
                                        @if ($item->cover)
                                            <img src="{{ asset($item->cover) }}" alt="" class="size-full object-cover">
                                        @else
                                            <div class="grid size-full place-items-center text-ink-300">
                                                <x-icon name="photo" class="size-6" />
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="max-w-sm truncate font-bold text-ink-900">{{ $item->judul }}</p>
                                    <p class="text-xs text-ink-500">
                                        {{ $item->penulis }} - {{ $item->views }} kali dibaca
                                        @if ($item->featured)
                                            <span class="font-bold text-gold-700">- unggulan</span>
                                        @endif
                                    </p>
                                </td>
                                <td class="px-6 py-4 text-ink-600">{{ $item->kategori }}</td>
                                <td class="px-6 py-4 text-ink-500">{{ $item->tanggal->translatedFormat('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    <span @class([
                                        'chip bg-green-100 text-green-800' => $item->published,
                                        'chip bg-ink-100 text-ink-600' => ! $item->published,
                                    ])>
                                        {{ $item->published ? 'Terbit' : 'Draf' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('berita.show', $item) }}" target="_blank" rel="noopener" title="Lihat"
                                            class="flex size-9 items-center justify-center rounded-lg text-ink-500 transition hover:bg-brand-50 hover:text-brand-700">
                                            <x-icon name="play-circle" class="size-5" />
                                        </a>
                                        <a href="{{ route('admin.berita.edit', $item) }}" title="Ubah"
                                            class="flex size-9 items-center justify-center rounded-lg text-ink-500 transition hover:bg-brand-50 hover:text-brand-700">
                                            <x-icon name="document-text" class="size-5" />
                                        </a>
                                        <form method="POST" action="{{ route('admin.berita.destroy', $item) }}"
                                            onsubmit="return confirm('Hapus berita &quot;{{ $item->judul }}&quot;?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus"
                                                class="flex size-9 items-center justify-center rounded-lg text-ink-500 transition hover:bg-red-50 hover:text-red-600">
                                                <x-icon name="x-mark" class="size-5" />
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="border-t border-ink-100 px-6 py-4">
                {{ $berita->links() }}
            </div>
        @endif
    </div>
</x-admin.layout>
