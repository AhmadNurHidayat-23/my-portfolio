@props([
    'variant' => 'emerald',
])

@php
    $variants = [
        'emerald' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
        'sky' => 'bg-sky-50 text-sky-700 border-sky-200',
        'slate' => 'bg-slate-100 text-slate-700 border-slate-200',
    ];
    $variantClass = $variants[$variant] ?? $variants['emerald'];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 rounded-full border px-3 py-1 text-xs font-semibold uppercase tracking-wider ' . $variantClass]) }}>
    {{ $slot }}
</span>

