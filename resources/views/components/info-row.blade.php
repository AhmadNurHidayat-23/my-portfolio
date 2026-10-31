@props([
    'label',
    'value' => null,
    'valueClass' => 'font-semibold text-slate-800',
    'hasBorder' => true,
])

<div class="flex justify-between items-center py-1 {{ $hasBorder ? 'border-b border-slate-200' : '' }}">
    <span class="text-slate-500">{{ $label }}</span>
    <span class="{{ $valueClass }}">{{ $value ?? $slot }}</span>
</div>

