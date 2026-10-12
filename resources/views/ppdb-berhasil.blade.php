@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil - '.$namaSekolah)
@section('description', 'Pendaftaran berhasil dikirim. Simpan kode pendaftaran Anda.')

@section('content')
    <section class="section">
        <div class="container-page">
            <div class="mx-auto max-w-2xl text-center">
                <span class="mx-auto flex size-20 items-center justify-center rounded-3xl bg-brand-50 text-brand-700">
                    <x-icon name="check-badge" class="size-10" />
                </span>

                <h1 class="mt-8 text-3xl sm:text-4xl">Pendaftaran berhasil dikirim</h1>

                <p class="mt-4 text-base leading-relaxed text-ink-500">
                    Terima kasih. Tim admisi {{ $namaSekolah }} akan menghubungi Anda pada jam kerja
                    untuk menjadwalkan verifikasi berkas dan wawancara.
                </p>

                <div class="mt-10 rounded-2xl border border-ink-100 bg-ink-50/60 p-8 text-left">
                    <p class="text-xs font-semibold tracking-wide text-ink-500 uppercase">Kode pendaftaran</p>
                    <p class="mt-2 font-mono text-3xl font-extrabold tracking-wider text-brand-700">
                        {{ $pendaftaran->kode }}
                    </p>

                    <dl class="mt-8 grid gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-xs font-semibold tracking-wide text-ink-500 uppercase">Nama calon murid</dt>
                            <dd class="mt-1 text-sm font-bold text-ink-900">{{ $pendaftaran->nama_anak }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold tracking-wide text-ink-500 uppercase">Kelas tujuan</dt>
                            <dd class="mt-1 text-sm font-bold text-ink-900">{{ $pendaftaran->kelas_tujuan }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold tracking-wide text-ink-500 uppercase">Orang tua / wali</dt>
                            <dd class="mt-1 text-sm font-bold text-ink-900">{{ $pendaftaran->nama_orang_tua }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold tracking-wide text-ink-500 uppercase">Nomor telepon</dt>
                            <dd class="mt-1 text-sm font-bold text-ink-900">{{ $pendaftaran->telepon }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold tracking-wide text-ink-500 uppercase">Tanggal daftar</dt>
                            <dd class="mt-1 text-sm font-bold text-ink-900">
                                {{ $pendaftaran->created_at->translatedFormat('d F Y') }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold tracking-wide text-ink-500 uppercase">Status</dt>
                            <dd class="mt-1">
                                <span class="chip bg-gold-100 text-gold-800">Menunggu verifikasi</span>
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="mt-10 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('beranda') }}" class="btn-primary">
                        Kembali ke Beranda
                        <x-icon name="arrow-right" class="size-4" />
                    </a>
                    <a href="{{ route('kontak') }}" class="btn-outline">Hubungi Sekolah</a>
                </div>

                <p class="mt-8 text-xs text-ink-400">
                    Simpan kode pendaftaran ini untuk mengecek status penerimaan calon murid.
                </p>
            </div>
        </div>
    </section>
@endsection
