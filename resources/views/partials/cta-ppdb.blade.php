<section class="relative overflow-hidden bg-brand-900">
    <div class="absolute inset-0">
        <div class="absolute -top-20 right-0 size-80 rounded-full bg-gold-500/20 blur-3xl"></div>
        <div class="absolute -bottom-24 left-10 size-96 rounded-full bg-brand-500/25 blur-3xl"></div>
        <div class="divider-dots absolute inset-0 text-white/5"></div>
    </div>

    <div class="container-page relative py-16 sm:py-20">
        <div class="grid items-center gap-10 lg:grid-cols-2">
            <div>
                <span class="eyebrow !bg-white/10 !text-gold-300 !ring-white/15">
                    <span class="size-1.5 rounded-full bg-gold-400"></span>
                    PPDB {{ config('sekolah.tahun_ajaran') }} Dibuka
                </span>

                <h2 class="mt-5 text-3xl text-white sm:text-4xl lg:leading-[1.1]">
                    Bergabunglah bersama keluarga besar {{ $namaSekolah ?? config('app.name') }}
                </h2>

                <p class="mt-5 max-w-lg text-base leading-relaxed text-brand-100/80">
                    Kuota terbatas {{ config('sekolah.ppdb.kuota') }} murid untuk tahun ajaran baru. Pendaftaran
                    dilakukan secara online dan dapat diselesaikan kapan saja selama periode pendaftaran masih dibuka.
                </p>

                <dl class="mt-8 grid max-w-lg grid-cols-2 gap-4 sm:grid-cols-3">
                    <div class="rounded-xl bg-white/5 p-4 ring-1 ring-white/10">
                        <dt class="text-xs text-brand-200/70">Periode</dt>
                        <dd class="mt-1 text-sm font-bold text-white">{{ config('sekolah.ppdb.periode') }}</dd>
                    </div>
                    <div class="rounded-xl bg-white/5 p-4 ring-1 ring-white/10">
                        <dt class="text-xs text-brand-200/70">Biaya</dt>
                        <dd class="mt-1 text-sm font-bold text-white">{{ config('sekolah.ppdb.biaya') }}</dd>
                    </div>
                    <div class="col-span-2 rounded-xl bg-white/5 p-4 ring-1 ring-white/10 sm:col-span-1">
                        <dt class="text-xs text-brand-200/70">Kuota</dt>
                        <dd class="mt-1 text-sm font-bold text-white">
                            {{ config('sekolah.ppdb.kuota') }} murid
                        </dd>
                    </div>
                </dl>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('ppdb') }}" class="btn-accent">
                        Daftar Online Sekarang
                        <x-icon name="arrow-right" class="size-4" />
                    </a>
                    <a href="{{ route('kontak') }}" class="btn-ghost-light">Tanya Admin</a>
                </div>
            </div>

            <div class="relative">
                <div class="rounded-3xl bg-white/5 p-6 ring-1 ring-white/10 backdrop-blur-sm sm:p-8">
                    <h3 class="text-sm font-bold tracking-wide text-white uppercase">Alur Pendaftaran</h3>

                    <ol class="mt-6 space-y-5">
                        @foreach ([
                            ['Isi Formulir Online', 'Lengkapi data calon murid dan orang tua dalam 5 menit.'],
                            ['Unggah Berkas', 'Kirim fotokopi akta kelahiran dan kartu keluarga.'],
                            ['Wawancara Orang Tua', 'Diskusi dan konsultasi bersama tim admisi sekolah.'],
                            ['Pengumuman', 'Hasil seleksi diumumkan maksimal 7 hari kerja.'],
                        ] as $i => $step)
                            <li class="flex gap-4">
                                <span class="flex size-8 shrink-0 items-center justify-center rounded-full bg-gold-400 text-sm font-extrabold text-brand-950">
                                    {{ $i + 1 }}
                                </span>
                                <div>
                                    <p class="text-sm font-bold text-white">{{ $step[0] }}</p>
                                    <p class="mt-0.5 text-sm text-brand-100/70">{{ $step[1] }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
