@props(['status' => 'baru'])

@php
    $peta = [
        'baru' => ['label' => 'Baru', 'kelas' => 'bg-gold-100 text-gold-800'],
        'diperiksa' => ['label' => 'Diperiksa', 'kelas' => 'bg-brand-100 text-brand-800'],
        'diterima' => ['label' => 'Diterima', 'kelas' => 'bg-green-100 text-green-800'],
        'ditolak' => ['label' => 'Ditolak', 'kelas' => 'bg-red-100 text-red-800'],
    ];

    $data = $peta[$status] ?? ['label' => ucfirst((string) $status), 'kelas' => 'bg-ink-100 text-ink-700'];
@endphp

<span {{ $attributes->merge(['class' => 'chip '.$data['kelas']]) }}>{{ $data['label'] }}</span>
