@php
    $jabatan = ['Guru', 'Guru Kelas', 'Wali Kelas', 'Kepala Sekolah', 'Guru Agama', 'Guru Tahfidz'];
    $guru = $guru ?? null;
@endphp

<div class="grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2">
        <section class="card p-6">
            <div class="flex flex-wrap items-start gap-6">
                <div class="size-32 shrink-0 overflow-hidden rounded-xl bg-ink-50 ring-1 ring-ink-100">
                    @if ($guru?->foto)
                        <img src="{{ asset($guru->foto) }}" alt="{{ $guru->nama }}" class="size-full object-cover">
                    @else
                        <div class="grid size-full place-items-center text-3xl font-extrabold text-brand-700">
                            {{ $guru?->inisial ?? '?' }}
                        </div>
                    @endif
                </div>

                <div class="min-w-56 flex-1">
                    <label for="foto" class="form-label">{{ $guru ? 'Ganti foto' : 'Unggah foto' }}</label>
                    <input id="foto" name="foto" type="file" accept="image/jpeg,image/png,image/webp"
                        class="block w-full text-sm text-ink-600 file:mr-4 file:rounded-xl file:border-0 file:bg-brand-50 file:px-4 file:py-2.5 file:text-sm file:font-bold file:text-brand-700 hover:file:bg-brand-100">
                    <p class="mt-2 text-xs text-ink-500">
                        Format JPG, PNG, atau WebP. Maksimal 3 MB. Rasio disarankan 4:5.
                        @if ($guru?->foto)
                            Foto saat ini: {{ basename($guru->foto) }}.
                        @else
                            Bila kosong, website menampilkan inisial nama.
                        @endif
                    </p>
                    @error('foto')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </section>

        <section class="card mt-6 space-y-5 p-6">
            <div>
                <label for="nama" class="form-label">Nama lengkap dan gelar</label>
                <input id="nama" name="nama" value="{{ old('nama', $guru?->nama) }}" required maxlength="150"
                    class="form-input" placeholder="Contoh: H. Ahmad Fauzi, S.Pd.I.">
                @error('nama')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="bio" class="form-label">Profil singkat</label>
                <textarea id="bio" name="bio" rows="4" required maxlength="1000"
                    class="form-input">{{ old('bio', $guru?->bio) }}</textarea>
                @error('bio')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </section>
    </div>

    <div class="space-y-6">
        <section class="card space-y-5 p-6">
            <div>
                <label for="jabatan" class="form-label">Jabatan</label>
                <select id="jabatan" name="jabatan" required class="form-input">
                    @foreach ($jabatan as $item)
                        <option value="{{ $item }}" @selected(old('jabatan', $guru?->jabatan) === $item)>{{ $item }}</option>
                    @endforeach
                </select>
                @error('jabatan')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="mata_pelicaran" class="form-label">Mata pelajaran</label>
                <input id="mata_pelicaran" name="mata_pelicaran" value="{{ old('mata_pelicaran', $guru?->mata_pelicaran) }}"
                    maxlength="80" class="form-input" placeholder="Contoh: Pendidikan Agama Islam">
                @error('mata_pelicaran')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nip" class="form-label">NIP</label>
                <input id="nip" name="nip" value="{{ old('nip', $guru?->nip) }}" maxlength="40" class="form-input"
                    placeholder="Opsional bila tidak memiliki NIP">
                @error('nip')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="urutan" class="form-label">Urutan tampil</label>
                <input id="urutan" name="urutan" type="number" min="0" max="9999" class="form-input"
                    value="{{ old('urutan', $guru?->urutan) }}">
                @error('urutan')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <label class="flex items-start gap-3 border-t border-ink-100 pt-5 text-sm">
                <input type="checkbox" name="aktif" value="1" @checked(old('aktif', $guru?->aktif ?? true))
                    class="mt-0.5 size-4 rounded border-ink-300 text-brand-600 focus:ring-brand-500">
                <span>
                    <span class="font-semibold text-ink-800">Tampilkan di website</span>
                    <span class="block text-xs text-ink-500">Guru nonaktif disembunyikan dari halaman pengajar.</span>
                </span>
            </label>
        </section>

        <section class="card p-6">
            <div class="space-y-2">
                <button type="submit" class="btn-primary w-full">
                    {{ $guru ? 'Simpan perubahan' : 'Tambahkan guru' }}
                </button>
                <a href="{{ route('admin.guru.index') }}" class="btn-outline w-full">Batal</a>
            </div>
        </section>
    </div>
</div>
