@props(['title', 'lead' => null, 'eyebrow' => null, 'align' => 'center'])

<div @class([
    'max-w-2xl',
    'mx-auto text-center' => $align === 'center',
    'text-left' => $align !== 'center',
])>
    @if ($eyebrow)
        <span class="eyebrow">{{ $eyebrow }}</span>
    @endif

    <h2 @class(['section-title', 'mt-4' => $eyebrow])>{{ $title }}</h2>

    @if ($lead)
        <p @class(['section-lead', 'mx-auto' => $align === 'center'])>{{ $lead }}</p>
    @endif
</div>
