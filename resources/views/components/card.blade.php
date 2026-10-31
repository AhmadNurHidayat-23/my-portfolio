@props([
    'class' => '',
])

<div {{ $attributes->merge(['class' => 'rounded-2xl bg-white p-8 shadow-xl border border-slate-200 ' . $class]) }}>
    {{ $slot }}
</div>

