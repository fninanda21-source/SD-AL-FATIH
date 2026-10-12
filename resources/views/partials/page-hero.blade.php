@props(['eyebrow' => null, 'title', 'lead' => null])

<section class="relative overflow-hidden bg-brand-950">
    <div class="absolute inset-0 opacity-90">
        <div class="absolute -top-24 -right-16 size-96 rounded-full bg-brand-700/40 blur-3xl"></div>
        <div class="absolute -bottom-32 -left-20 size-[28rem] rounded-full bg-gold-500/15 blur-3xl"></div>
        <div class="divider-dots absolute inset-0 text-white/5"></div>
    </div>

    <div class="container-page relative py-16 sm:py-20 lg:py-24">
        <nav aria-label="Breadcrumb" class="mb-6 flex items-center gap-1.5 text-xs font-medium text-brand-200/70">
            <a href="{{ route('beranda') }}" class="transition hover:text-gold-300">Beranda</a>
            <x-icon name="chevron-right" class="size-3.5" />
            <span class="text-gold-300">{{ $title }}</span>
        </nav>

        @if ($eyebrow)
            <span class="eyebrow !bg-white/10 !text-gold-300 !ring-white/15">{{ $eyebrow }}</span>
        @endif

        <h1 class="mt-4 max-w-3xl text-4xl text-white sm:text-4xl lg:text-5xl lg:leading-[1.1]">
            {{ $title }}
        </h1>

        @if ($lead)
            <p class="mt-5 max-w-2xl text-base leading-relaxed text-brand-100/80 sm:text-lg">
                {{ $lead }}
            </p>
        @endif
    </div>
</section>
