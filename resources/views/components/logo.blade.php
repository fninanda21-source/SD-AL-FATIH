@props(['class' => 'size-10'])

<span {{ $attributes->merge(['class' => 'inline-flex shrink-0 items-center justify-center overflow-hidden rounded-xl bg-white shadow-soft '.$class]) }}>
    <img src="{{ asset('img/logo-sd.jpg') }}" alt="{{ $namaSekolah ?? config('app.name') }}"
        class="size-full object-cover" loading="lazy" decoding="async">
</span>
