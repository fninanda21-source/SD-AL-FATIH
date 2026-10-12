<x-admin.layout title="Guru">
    <x-slot:aksi-halaman>
        <a href="{{ route('admin.guru.create') }}" class="btn-primary !py-2.5">
            <x-icon name="users" class="size-4" />
            Tambah guru
        </a>
    </x-slot:aksi-halaman>

    <form method="GET" action="{{ route('admin.guru.index') }}" class="flex flex-wrap items-end gap-3">
        <div class="min-w-56 flex-1">
            <label for="cari" class="form-label">Cari guru</label>
            <input id="cari" name="cari" value="{{ $cari }}" placeholder="Nama atau mata pelajaran" class="form-input">
        </div>
        <button type="submit" class="btn-primary">Cari</button>
        @if ($cari)
            <a href="{{ route('admin.guru.index') }}" class="btn-outline">Reset</a>
        @endif
    </form>

    @if ($guru->isEmpty())
        <div class="card mt-6 px-6 py-16 text-center">
            <span class="mx-auto flex size-14 items-center justify-center rounded-2xl bg-ink-50 text-ink-300">
                <x-icon name="users" class="size-7" />
            </span>
            <p class="mt-4 text-sm font-semibold text-ink-600">Data guru tidak ditemukan.</p>
            <a href="{{ route('admin.guru.create') }}" class="btn-primary mt-5">Tambah guru pertama</a>
        </div>
    @else
        <div class="card mt-6 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-3xl text-left text-sm">
                    <thead class="border-b border-ink-100 bg-ink-50/70 text-xs tracking-wide text-ink-500 uppercase">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Nama</th>
                            <th class="px-6 py-4 font-semibold">Jabatan</th>
                            <th class="px-6 py-4 font-semibold">Mata Pelajaran</th>
                            <th class="px-6 py-4 font-semibold">Kelas Diampu</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                            <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-ink-100">
                        @foreach ($guru as $item)
                            <tr class="transition hover:bg-ink-50/70">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="size-11 shrink-0 overflow-hidden rounded-xl bg-ink-50 ring-1 ring-ink-100">
                                            @if ($item->foto)
                                                <img src="{{ asset($item->foto) }}" alt="{{ $item->nama }}" class="size-full object-cover">
                                            @else
                                                <div class="grid size-full place-items-center text-sm font-extrabold text-brand-700">
                                                    {{ $item->inisial }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <p class="truncate font-bold text-ink-900">{{ $item->nama }}</p>
                                            <p class="text-xs text-ink-500">{{ $item->nip ?: 'Tanpa NIP' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-ink-600">{{ $item->jabatan }}</td>
                                <td class="px-6 py-4 text-ink-600">{{ $item->mata_pelicaran ?: '-' }}</td>
                                <td class="px-6 py-4 text-ink-600">{{ $item->kelas->count() }} kelas</td>
                                <td class="px-6 py-4">
                                    <span @class([
                                        'chip bg-green-100 text-green-800' => $item->aktif,
                                        'chip bg-ink-100 text-ink-600' => ! $item->aktif,
                                    ])>
                                        {{ $item->aktif ? 'Aktif' : 'Disembunyikan' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.guru.edit', $item) }}" title="Ubah"
                                            class="flex size-9 items-center justify-center rounded-lg text-ink-500 transition hover:bg-brand-50 hover:text-brand-700">
                                            <x-icon name="document-text" class="size-5" />
                                        </a>
                                        <form method="POST" action="{{ route('admin.guru.destroy', $item) }}"
                                            onsubmit="return confirm('Hapus data guru {{ $item->nama }}?')">
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
                {{ $guru->links() }}
            </div>
        </div>
    @endif
</x-admin.layout>
