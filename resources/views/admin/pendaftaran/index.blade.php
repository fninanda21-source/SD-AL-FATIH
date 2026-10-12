<x-admin.layout title="Pendaftaran PPDB">
    <div class="grid gap-4 sm:grid-cols-4">
                @foreach (\App\Models\Pendaftaran::statusOpsi() as $kunci => $label)
            @php $jumlah = $rekap[$kunci] ?? 0; @endphp
            <a href="{{ route('admin.ppdb.index', array_filter(['status' => $kunci, 'cari' => $cari])) }}"
                class="card flex items-center gap-3 p-4 transition
                {{ $status === $kunci ? 'border-brand-300 ring-1 ring-brand-200' : '' }}">
                <div>
                    <p class="text-2xl font-extrabold text-ink-900">{{ $jumlah }}</p>
                    <p class="text-xs font-semibold tracking-wide text-ink-500 uppercase">{{ $label }}</p>
                </div>
            </a>
        @endforeach
    </div>

    <form method="GET" action="{{ route('admin.ppdb.index') }}" class="mt-6 flex flex-wrap items-end gap-3">
        <div class="min-w-56 flex-1">
            <label for="cari" class="form-label">Cari pendaftar</label>
            <input id="cari" name="cari" value="{{ $cari }}" placeholder="Nama anak, kode, atau orang tua"
                class="form-input">
        </div>

        <div class="w-48">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-input">
                <option value="">Semua status</option>
        @foreach (\App\Models\Pendaftaran::statusOpsi() as $kunci => $label)
                    <option value="{{ $kunci }}" @selected($status === $kunci)>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn-primary">Terapkan</button>
        @if ($status || $cari)
            <a href="{{ route('admin.ppdb.index') }}" class="btn-outline">Reset</a>
        @endif
    </form>

    <div class="card mt-6 overflow-hidden">
        @if ($pendaftaran->isEmpty())
            <p class="px-6 py-14 text-center text-sm text-ink-400">Tidak ada data pendaftaran yang cocok.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full min-w-4xl text-left text-sm">
                    <thead class="border-b border-ink-100 bg-ink-50/70 text-xs tracking-wide text-ink-500 uppercase">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Kode</th>
                            <th class="px-6 py-4 font-semibold">Calon Murid</th>
                            <th class="px-6 py-4 font-semibold">Orang Tua</th>
                            <th class="px-6 py-4 font-semibold">Kelas</th>
                            <th class="px-6 py-4 font-semibold">Tanggal</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                            <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-ink-100">
                        @foreach ($pendaftaran as $item)
                            <tr class="transition hover:bg-ink-50/70">
                                <td class="px-6 py-4 font-mono text-xs text-ink-500">{{ $item->kode }}</td>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-ink-900">{{ $item->nama_anak }}</p>
                                    <p class="text-xs text-ink-500">
                                        {{ $item->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }} - {{ $item->umur }} tahun
                                    </p>
                                </td>
                                <td class="px-6 py-4 text-ink-600">{{ $item->nama_orang_tua }}</td>
                                <td class="px-6 py-4 text-ink-600">{{ $item->kelas_tujuan }}</td>
                                <td class="px-6 py-4 text-ink-500">
                                    {{ $item->created_at->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <x-admin.status-pendaftaran :status="$item->status" />
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.ppdb.show', $item) }}" title="Lihat detail"
                                            class="flex size-9 items-center justify-center rounded-lg text-ink-500 transition hover:bg-brand-50 hover:text-brand-700">
                                            <x-icon name="play-circle" class="size-5" />
                                        </a>
                                        <form method="POST" action="{{ route('admin.ppdb.destroy', $item) }}"
                                            onsubmit="return confirm('Hapus data pendaftaran {{ $item->nama_anak }}?')">
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
                {{ $pendaftaran->links() }}
            </div>
        @endif
    </div>
</x-admin.layout>
