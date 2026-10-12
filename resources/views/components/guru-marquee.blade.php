@props(['guru', 'jumlah' => null, 'label' => 'Tenaga Pengajar'])

@php
    $daftar = $jumlah ? $guru->take($jumlah) : $guru->values();
@endphp

@if ($daftar->isNotEmpty())
    <div class="guru-marquee" role="region" aria-label="{{ $label }}">
        <div class="guru-marquee__track">
            @for ($putaran = 0; $putaran < 2; $putaran++)
                <ul class="guru-marquee__list" @if ($putaran === 1) aria-hidden="true" @endif>
                    @foreach ($daftar as $g)
                        <li class="guru-marquee__item">
                            <span class="guru-marquee__foto">
                                @if ($g->foto)
                                    <img src="{{ asset($g->foto) }}" alt="{{ $putaran === 0 ? $g->nama : '' }}"
                                        loading="lazy" decoding="async" width="168" height="210">
                                @else
                                    <span class="guru-marquee__inisial">{{ $g->inisial }}</span>
                                @endif
                            </span>
                            <span class="guru-marquee__nama">{{ $g->nama }}</span>
                            <span class="guru-marquee__mapel">{{ $g->mata_pelicaran ?? $g->jabatan }}</span>
                        </li>
                    @endforeach
                </ul>
            @endfor
        </div>
    </div>
@endif
