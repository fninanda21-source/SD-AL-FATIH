@php
    $kategori = ['Kegiatan Belajar', 'Kegiatan Sekolah', 'Ekstrakurikuler', 'Prestasi', 'Fasilitas', 'PPDB'];
    $galeri = $galeri ?? null;
@endphp

<div class="grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2">
        <section class="card p-6">
            <div class="aspect-4/3 overflow-hidden rounded-xl bg-ink-50 ring-1 ring-ink-100">
                @if ($galeri?->gambar)
                    <img src="{{ asset($galeri->gambar) }}" alt="{{ $galeri->judul }}" class="size-full object-cover">
                @else
                    <div class="grid size-full place-items-center text-ink-300">
                        <x-icon name="photo" class="size-12" />
                    </div>
                @endif
            </div>

            <div class="mt-5">
                <label for="gambar" class="form-label">
                    {{ $galeri ? 'Ganti foto' : 'Unggah foto' }}
                </label>
                <input id="gambar" name="gambar" type="file" accept="image/jpeg,image/png,image/webp"
                    @required(! $galeri)
                    class="block w-full text-sm text-ink-600 file:mr-4 file:rounded-xl file:border-0 file:bg-brand-50 file:px-4 file:py-2.5 file:text-sm file:font-bold file:text-brand-700 hover:file:bg-brand-100">
                <p class="mt-2 text-xs text-ink-500">
                    Format JPG, PNG, atau WebP. Maksimal 4 MB. Rasio disarankan 4:3.
                    @if ($galeri?->gambar)
                        Foto saat ini: {{ basename($galeri->gambar) }}.
                    @endif
                </p>
                @error('gambar')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </section>
    </div>

    <div class="space-y-6">
        <section class="card space-y-5 p-6">
            <div>
                <label for="judul" class="form-label">Judul foto</label>
                <input id="judul" name="judul" value="{{ old('judul', $galeri?->judul) }}" required maxlength="150"
                    class="form-input" placeholder="Contoh: Upacara Bendera Hari Senin">
                @error('judul')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="kategori" class="form-label">Kategori</label>
                <select id="kategori" name="kategori" required class="form-input">
                    @foreach ($kategori as $item)
                        <option value="{{ $item }}" @selected(old('kategori', $galeri?->kategori) === $item)>{{ $item }}</option>
                    @endforeach
                </select>
                @error('kategori')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal" class="form-label">Tanggal kegiatan</label>
                <input id="tanggal" name="tanggal" type="date" required class="form-input"
                    value="{{ old('tanggal', $galeri?->tanggal?->format('Y-m-d') ?? now()->format('Y-m-d')) }}">
                @error('tanggal')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="caption" class="form-label">Keterangan</label>
                <textarea id="caption" name="caption" rows="3" maxlength="300"
                    class="form-input">{{ old('caption', $galeri?->caption) }}</textarea>
                @error('caption')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="urutan" class="form-label">Urutan tampil</label>
                <input id="urutan" name="urutan" type="number" min="0" max="9999" class="form-input"
                    value="{{ old('urutan', $galeri?->urutan) }}">
                @error('urutan')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </section>

        <section class="card p-6">
            <div class="space-y-2">
                <button type="submit" class="btn-primary w-full">
                    {{ $galeri ? 'Simpan perubahan' : 'Tambahkan foto' }}
                </button>
                <a href="{{ route('admin.galeri.index') }}" class="btn-outline w-full">Batal</a>
            </div>
        </section>
    </div>
</div>
