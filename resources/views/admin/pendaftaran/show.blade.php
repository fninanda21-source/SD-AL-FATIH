<x-admin.layout title="Detail Pendaftaran">
    <a href="{{ route('admin.ppdb.index') }}"
        class="inline-flex items-center gap-2 text-sm font-semibold text-ink-500 transition hover:text-brand-700">
        <x-icon name="arrow-left" class="size-4" />
        Kembali ke daftar
    </a>

    <div class="mt-5 grid gap-6 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-2">
            <section class="card p-6">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <p class="font-mono text-xs text-ink-400">{{ $pendaftaran->kode }}</p>
                        <h2 class="mt-1 text-2xl">{{ $pendaftaran->nama_anak }}</h2>
                        <p class="mt-1 text-sm text-ink-500">
                            {{ $pendaftaran->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }} -
                            {{ $pendaftaran->umur }} tahun -
                            {{ $pendaftaran->tempat_lahir }},
                            {{ $pendaftaran->tanggal_lahir?->translatedFormat('d F Y') }}
                        </p>
                    </div>
                    <x-admin.status-pendaftaran :status="$pendaftaran->status" class="!px-4 !py-1.5 text-sm" />
                </div>

                <dl class="mt-6 grid gap-5 sm:grid-cols-2">
                    @foreach ([
                        'NISN' => $pendaftaran->nisn ?: '-',
                        'Kelas tujuan' => $pendaftaran->kelas_tujuan,
                        'Sekolah asal' => $pendaftaran->sekolah_asal ?: '-',
                        'Nama orang tua' => $pendaftaran->nama_orang_tua,
                        'Pekerjaan' => $pendaftaran->pekerjaan ?: '-',
                        'Telepon' => $pendaftaran->telepon,
                        'Surel' => $pendaftaran->email ?: '-',
                        'Tanggal daftar' => $pendaftaran->created_at->translatedFormat('d F Y H:i'),
                    ] as $label => $nilai)
                        <div>
                            <dt class="text-xs font-semibold tracking-wide text-ink-500 uppercase">{{ $label }}</dt>
                            <dd class="mt-1 text-sm font-semibold text-ink-800">{{ $nilai }}</dd>
                        </div>
                    @endforeach
                    <div class="sm:col-span-2">
                        <dt class="text-xs font-semibold tracking-wide text-ink-500 uppercase">Alamat</dt>
                        <dd class="mt-1 text-sm leading-relaxed text-ink-800">{{ $pendaftaran->alamat }}</dd>
                    </div>
                </dl>
            </section>

            <section class="card p-6">
                <h2 class="text-base">Catatan dari calon murid</h2>
                <p class="mt-3 text-sm leading-relaxed whitespace-pre-line text-ink-600">
                    {{ $pendaftaran->catatan ?: 'Tidak ada catatan.' }}
                </p>
            </section>
        </div>

        <div class="space-y-6">
            <section class="card p-6">
                <h2 class="text-base">Ubah status</h2>

                <form method="POST" action="{{ route('admin.ppdb.update', $pendaftaran) }}" class="mt-4 space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="status" class="form-label">Status pendaftaran</label>
                        <select id="status" name="status" class="form-input">
                            @foreach (\App\Models\Pendaftaran::statusOpsi() as $kunci => $label)
                                <option value="{{ $kunci }}" @selected($pendaftaran->status === $kunci)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="catatan" class="form-label">Catatan tim admisi</label>
                        <textarea id="catatan" name="catatan" rows="4"
                            class="form-input">{{ old('catatan', $pendaftaran->catatan) }}</textarea>
                    </div>

                    <button type="submit" class="btn-primary w-full">Simpan perubahan</button>
                </form>
            </section>

            <section class="card p-6">
                <h2 class="text-base">Tindakan</h2>

                <div class="mt-4 space-y-2">
                    @if ($pendaftaran->email)
                        <a href="mailto:{{ $pendaftaran->email }}" class="btn-outline w-full">
                            <x-icon name="envelope" class="size-4" />
                            Surel orang tua
                        </a>
                    @endif
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pendaftaran->telepon) }}" target="_blank"
                        rel="noopener" class="btn-outline w-full">
                        <x-icon name="whatsapp" class="size-4 text-brand-600" />
                        Hubungi via WhatsApp
                    </a>

                    <form method="POST" action="{{ route('admin.ppdb.destroy', $pendaftaran) }}"
                        onsubmit="return confirm('Hapus data pendaftaran {{ $pendaftaran->nama_anak }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn w-full !bg-red-50 !text-red-700 hover:!bg-red-100">
                            <x-icon name="x-mark" class="size-4" />
                            Hapus data
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</x-admin.layout>
