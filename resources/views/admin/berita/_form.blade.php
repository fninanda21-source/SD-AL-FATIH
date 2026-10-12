@php
    $kategori = ['Prestasi', 'Kegiatan Sekolah', 'Kegiatan Belajar', 'Program', 'Pengumuman', 'PPDB'];
    $berita = $berita ?? null;
@endphp

<div class="grid gap-6 lg:grid-cols-3">
    <div class="space-y-6 lg:col-span-2">
        <section class="card space-y-5 p-6">
            <div>
                <label for="judul" class="form-label">Judul berita</label>
                <input id="judul" name="judul" value="{{ old('judul', $berita?->judul) }}" required maxlength="200"
                    class="form-input" placeholder="Contoh: Murid Raih Juara Olimpiade Sains">
                @error('judul')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="excerpt" class="form-label">Ringkasan</label>
                <textarea id="excerpt" name="excerpt" rows="2" required maxlength="300"
                    class="form-input"
                    placeholder="Satu paragraf singkat yang tampil di daftar berita.">{{ old('excerpt', $berita?->excerpt) }}</textarea>
                @error('excerpt')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="konten" class="form-label">Isi berita</label>
                <textarea id="konten" name="konten" rows="14" required
                    class="form-input font-mono text-sm leading-relaxed">{{ old('konten', $berita?->konten) }}</textarea>
                @error('konten')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </section>

        <section class="card p-6">
            <h2 class="text-base">Gambar cover</h2>

            <div class="mt-4 flex flex-wrap items-start gap-6">
                <div class="size-40 shrink-0 overflow-hidden rounded-xl bg-ink-50 ring-1 ring-ink-100">
                    @if ($berita?->cover)
                        <img src="{{ asset($berita->cover) }}" alt="Cover berita" class="size-full object-cover">
                    @else
                        <div class="grid size-full place-items-center text-ink-300">
                            <x-icon name="photo" class="size-10" />
                        </div>
                    @endif
                </div>

                <div class="min-w-56 flex-1">
                    <input id="cover" name="cover" type="file" accept="image/jpeg,image/png,image/webp"
                        class="block w-full text-sm text-ink-600 file:mr-4 file:rounded-xl file:border-0 file:bg-brand-50 file:px-4 file:py-2.5 file:text-sm file:font-bold file:text-brand-700 hover:file:bg-brand-100">
                    <p class="mt-2 text-xs text-ink-500">Format JPG, PNG, atau WebP. Maksimal 3 MB. Rasio disarankan 16:10.</p>
                    @error('cover')
                        <p class="form-error">{{ $message }}</p>
                    @enderror

                    @if ($berita?->cover)
                        <p class="mt-3 text-xs font-semibold text-ink-500">Cover saat ini: {{ basename($berita->cover) }}</p>
                    @endif
                </div>
            </div>
        </section>
    </div>

    <div class="space-y-6">
        <section class="card space-y-5 p-6">
            <div>
                <label for="kategori" class="form-label">Kategori</label>
                <select id="kategori" name="kategori" required class="form-input">
                    @foreach ($kategori as $item)
                        <option value="{{ $item }}" @selected(old('kategori', $berita?->kategori) === $item)>{{ $item }}</option>
                    @endforeach
                </select>
                @error('kategori')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal" class="form-label">Tanggal terbit</label>
                <input id="tanggal" name="tanggal" type="date" required class="form-input"
                    value="{{ old('tanggal', $berita?->tanggal?->format('Y-m-d') ?? now()->format('Y-m-d')) }}">
                @error('tanggal')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="penulis" class="form-label">Penulis</label>
                <input id="penulis" name="penulis" value="{{ old('penulis', $berita?->penulis) }}" maxlength="100"
                    class="form-input" placeholder="Humas {{ config('sekolah.nama_singkat') }}">
                @error('penulis')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-3 border-t border-ink-100 pt-5">
                <label class="flex items-start gap-3 text-sm">
                    <input type="checkbox" name="published" value="1" @checked(old('published', $berita?->published ?? true))
                        class="mt-0.5 size-4 rounded border-ink-300 text-brand-600 focus:ring-brand-500">
                    <span>
                        <span class="font-semibold text-ink-800">Terbitkan berita</span>
                        <span class="block text-xs text-ink-500">Jika tidak dicentang, berita hanya menjadi draf.</span>
                    </span>
                </label>

                <label class="flex items-start gap-3 text-sm">
                    <input type="checkbox" name="featured" value="1" @checked(old('featured', $berita?->featured))
                        class="mt-0.5 size-4 rounded border-ink-300 text-brand-600 focus:ring-brand-500">
                    <span>
                        <span class="font-semibold text-ink-800">Jadikan berita unggulan</span>
                        <span class="block text-xs text-ink-500">Tampil menonjol di halaman depan.</span>
                    </span>
                </label>
            </div>
        </section>

        <section class="card p-6">
            <div class="space-y-2">
                <button type="submit" class="btn-primary w-full">
                    {{ $berita ? 'Simpan perubahan' : 'Simpan berita' }}
                </button>
                <a href="{{ route('admin.berita.index') }}" class="btn-outline w-full">Batal</a>
            </div>
        </section>
    </div>
</div>
