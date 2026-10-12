@extends('layouts.app')

@section('title', 'Pendaftaran Murid Baru - '.$namaSekolah)
@section('description', 'Pendaftaran murid baru '.$namaSekolah.' '.config('sekolah.ppdb.gelombang').'. Daftar online sekarang.')

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => config('sekolah.ppdb.gelombang'),
        'title' => 'Pendaftaran Murid Baru',
        'lead' => config('sekolah.ppdb.periode').' - kuota '.config('sekolah.ppdb.kuota').' murid.',
    ])

    <section class="section">
        <div class="container-page grid gap-12 lg:grid-cols-12 lg:gap-10">
            <div class="space-y-6 lg:col-span-5">
                <div class="card p-6 sm:p-8">
                    <h2 class="text-lg">Persyaratan</h2>

                    <ul class="mt-5 space-y-3">
                        @foreach ($persyaratan as $p)
                            <li class="flex gap-3 text-sm leading-relaxed text-ink-600">
                                <x-icon name="check" class="mt-0.5 size-4 shrink-0 text-brand-600" />
                                {{ $p }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="card p-6 sm:p-8">
                    <h2 class="text-lg">Biaya pendidikan</h2>

                    <ul class="mt-5 divide-y divide-ink-100">
                        @foreach ($biaya as $b)
                            <li class="flex items-start justify-between gap-4 py-4 first:pt-0 last:pb-0">
                                <div>
                                    <p class="text-sm font-bold text-ink-900">{{ $b['nama'] }}</p>
                                    <p class="mt-0.5 text-xs text-ink-500">{{ $b['keterangan'] }}</p>
                                </div>
                                <p class="shrink-0 text-sm font-extrabold text-brand-700">{{ $b['nominal'] }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="rounded-2xl bg-brand-950 p-6 text-white sm:p-8">
                    <x-icon name="question-mark-circle" class="size-7 text-gold-300" />
                    <h2 class="mt-4 text-lg">Masih ada pertanyaan?</h2>
                    <p class="mt-2 text-sm leading-relaxed text-brand-100/80">
                        Tim admisi siap membantu setiap hari kerja pukul 07.15 sampai 14.00 WIB.
                    </p>
                    <a href="{{ route('kontak') }}" class="btn-accent mt-5 w-full !py-2.5 text-xs">
                        Hubungi Tim Admisi
                    </a>
                </div>
            </div>

            <div class="lg:col-span-7">
                <div class="card p-6 sm:p-8">
                    <h2 class="text-xl">Formulir pendaftaran</h2>
                    <p class="mt-2 text-sm text-ink-500">
                        Isi data berikut dengan lengkap. Anda akan menerima kode pendaftaran setelah mengirim formulir.
                    </p>

                    @if ($errors->any())
                        <div class="mt-6 rounded-xl bg-red-50 p-4 text-sm text-red-700 ring-1 ring-red-100 ring-inset">
                            <p class="font-bold">Periksa kembali isian Anda.</p>
                            <ul class="mt-2 list-disc pl-5">
                                @foreach ($errors->all() as $pesan)
                                    <li>{{ $pesan }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('ppdb.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <fieldset>
                            <legend class="form-label !text-base">Data calon murid</legend>

                            <div class="space-y-5">
                                <div>
                                    <label for="nama_anak" class="form-label">Nama lengkap</label>
                                    <input type="text" name="nama_anak" id="nama_anak" value="{{ old('nama_anak') }}" required
                                        class="form-input">
                                    @error('nama_anak')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid gap-5 sm:grid-cols-2">
                                    <div>
                                        <label for="nisn" class="form-label">
                                            NISN <span class="font-normal text-ink-400">(opsional)</span>
                                        </label>
                                        <input type="text" name="nisn" id="nisn" value="{{ old('nisn') }}" inputmode="numeric"
                                            maxlength="10" class="form-input">
                                        @error('nisn')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="jenis_kelamin" class="form-label">Jenis kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" required class="form-input">
                                            <option value="">Pilih</option>
                                            <option value="L" @selected(old('jenis_kelamin') === 'L')>Laki-laki</option>
                                            <option value="P" @selected(old('jenis_kelamin') === 'P')>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid gap-5 sm:grid-cols-2">
                                    <div>
                                        <label for="tempat_lahir" class="form-label">Tempat lahir</label>
                                        <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                            required class="form-input">
                                        @error('tempat_lahir')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="tanggal_lahir" class="form-label">Tanggal lahir</label>
                                        <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                            value="{{ old('tanggal_lahir') }}" required class="form-input">
                                        @error('tanggal_lahir')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="sekolah_asal" class="form-label">
                                        Asal sekolah <span class="font-normal text-ink-400">(opsional)</span>
                                    </label>
                                    <input type="text" name="sekolah_asal" id="sekolah_asal" value="{{ old('sekolah_asal') }}"
                                        class="form-input">
                                    @error('sekolah_asal')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="form-label !text-base">Data orang tua</legend>

                            <div class="space-y-5">
                                <div>
                                    <label for="nama_orang_tua" class="form-label">Nama orang tua atau wali</label>
                                    <input type="text" name="nama_orang_tua" id="nama_orang_tua" value="{{ old('nama_orang_tua') }}"
                                        required class="form-input">
                                    @error('nama_orang_tua')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid gap-5 sm:grid-cols-2">
                                    <div>
                                        <label for="pekerjaan" class="form-label">
                                            Pekerjaan <span class="font-normal text-ink-400">(opsional)</span>
                                        </label>
                                        <input type="text" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan') }}"
                                            class="form-input">
                                        @error('pekerjaan')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="telepon" class="form-label">Nomor telepon / WhatsApp</label>
                                        <input type="text" name="telepon" id="telepon" value="{{ old('telepon') }}" required
                                            autocomplete="tel" class="form-input">
                                        @error('telepon')
                                            <p class="form-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="email" class="form-label">
                                        Surel <span class="font-normal text-ink-400">(opsional)</span>
                                    </label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" autocomplete="email"
                                        class="form-input">
                                    @error('email')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="alamat" class="form-label">Alamat domisili</label>
                                    <textarea name="alamat" id="alamat" rows="3" required
                                        class="form-input resize-y">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="form-label !text-base">Pilihan kelas</legend>

                            <div class="space-y-5">
                                <div>
                                    <label for="kelas_tujuan" class="form-label">Kelas tujuan</label>
                                    <select name="kelas_tujuan" id="kelas_tujuan" required class="form-input">
                                        <option value="">Pilih kelas</option>
                                        @foreach ($kelasTujuan as $namaKelas)
                                            <option value="{{ $namaKelas }}" @selected(old('kelas_tujuan') === $namaKelas)>
                                                {{ $namaKelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kelas_tujuan')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="catatan" class="form-label">
                                        Catatan tambahan <span class="font-normal text-ink-400">(opsional)</span>
                                    </label>
                                    <textarea name="catatan" id="catatan" rows="3"
                                        class="form-input resize-y">{{ old('catatan') }}</textarea>
                                    @error('catatan')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>

                        <div class="rounded-xl bg-ink-50 p-4 text-xs leading-relaxed text-ink-500">
                            Dengan mengirim formulir ini, Anda menyatakan bahwa data yang diisi benar dan dapat
                            dihubungi oleh tim admisi {{ $namaSekolah }}.
                        </div>

                        <button type="submit" class="btn-primary w-full sm:w-auto">
                            <x-icon name="clipboard-check" class="size-4" />
                            Kirim Pendaftaran
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
