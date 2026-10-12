@extends('layouts.app')

@section('title', 'Kontak '. $namaSekolah)
@section('description', 'Alamat, telepon, surel, dan formulir kontak '.$namaSekolah.'. Hubungi kami pada jam kerja.')

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'Kontak',
        'title' => 'Hubungi Kami',
        'lead' => 'Punya pertanyaan tentang sekolah, PPDB, atau kerja sama? Sampaikan melalui formulir di bawah ini.',
    ])

    <section class="section">
        <div class="container-page grid gap-12 lg:grid-cols-12 lg:gap-10">
            <div class="lg:col-span-5">
                <div class="card divide-y divide-ink-100">
                    <a href="https://maps.google.com/?q={{ urlencode(config('sekolah.alamat')) }}"
                        target="_blank" rel="noopener"
                        class="flex gap-4 p-6 transition hover:bg-ink-50/60">
                        <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-700">
                            <x-icon name="map-pin" class="size-5" />
                        </span>
                        <div>
                            <p class="text-sm font-bold text-ink-900">Alamat</p>
                            <p class="mt-1 text-sm leading-relaxed text-ink-500">{{ config('sekolah.alamat') }}</p>
                        </div>
                    </a>

                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', config('sekolah.telepon')) }}"
                        class="flex gap-4 p-6 transition hover:bg-ink-50/60">
                        <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-700">
                            <x-icon name="phone" class="size-5" />
                        </span>
                        <div>
                            <p class="text-sm font-bold text-ink-900">Telepon</p>
                            <p class="mt-1 text-sm text-ink-500">{{ config('sekolah.telepon') }}</p>
                        </div>
                    </a>

                    <a href="https://wa.me/{{ config('sekolah.whatsapp') }}" target="_blank" rel="noopener"
                        class="flex gap-4 p-6 transition hover:bg-ink-50/60">
                        <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-700">
                            <x-icon name="whatsapp" class="size-5" />
                        </span>
                        <div>
                            <p class="text-sm font-bold text-ink-900">WhatsApp</p>
                            <p class="mt-1 text-sm text-ink-500">+{{ config('sekolah.whatsapp') }}</p>
                        </div>
                    </a>

                    <a href="mailto:{{ config('sekolah.email') }}"
                        class="flex gap-4 p-6 transition hover:bg-ink-50/60">
                        <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-700">
                            <x-icon name="envelope" class="size-5" />
                        </span>
                        <div>
                            <p class="text-sm font-bold text-ink-900">Surel</p>
                            <p class="mt-1 text-sm text-ink-500">{{ config('sekolah.email') }}</p>
                        </div>
                    </a>
                </div>

                <div class="card mt-5 p-6">
                    <h2 class="text-base">Jam Layanan</h2>

                    <dl class="mt-4 space-y-3 text-sm">
                        @foreach ($jamOperasional as $hari => $waktu)
                            <div class="flex items-center justify-between gap-4">
                                <dt class="text-ink-500">{{ $hari }}</dt>
                                <dd class="font-semibold text-ink-900">{{ $waktu }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>

                <div class="card mt-5 p-6">
                    <h2 class="text-base">Media Sosial</h2>

                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($sosialMedia as $s)
                            <a href="{{ $s['url'] }}" target="_blank" rel="noopener"
                                class="btn-outline !px-3.5 !py-2 text-xs">
                                <x-brand :name="$s['ikon']" class="size-4" />
                                {{ $s['nama'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7">
                <div class="card p-6 sm:p-8">
                    <h2 class="text-xl">Kirim pesan</h2>
                    <p class="mt-2 text-sm text-ink-500">
                        Isi formulir berikut dan tim admisi akan membalas pada jam kerja.
                    </p>

                    @if (session('sukses'))
                        <div class="mt-6 flex gap-3 rounded-xl bg-brand-50 p-4 text-sm text-brand-800 ring-1 ring-brand-100 ring-inset">
                            <x-icon name="check-badge" class="size-5 shrink-0" />
                            <p>{{ session('sukses') }}</p>
                        </div>
                    @endif

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

                    <form method="POST" action="{{ route('kontak.store') }}" class="mt-6 space-y-5">
                        @csrf

                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label for="nama" class="form-label">Nama lengkap</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                                    autocomplete="name" class="form-input">
                                @error('nama')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="form-label">Surel</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                    autocomplete="email" class="form-input">
                                @error('email')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="subjek" class="form-label">Subjek <span class="font-normal text-ink-400">(opsional)</span></label>
                            <input type="text" name="subjek" id="subjek" value="{{ old('subjek') }}" class="form-input">
                            @error('subjek')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea name="pesan" id="pesan" rows="5" required minlength="10"
                                class="form-input resize-y">{{ old('pesan') }}</textarea>
                            @error('pesan')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn-primary w-full sm:w-auto">
                            <x-icon name="envelope" class="size-4" />
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
