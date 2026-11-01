@props([
    'service' => [],
])

@php
    $number = (string) ($service['number'] ?? '01');
    $title = (string) ($service['title'] ?? 'Service');
    $description = (string) ($service['description'] ?? '');
@endphp

<article class="service-item">
    <div class="service-item-header">
        <span class="service-item-number">{{ $number }}</span>
        <h3 class="service-item-title">{{ $title }}</h3>
    </div>
    <p class="service-item-description">
        {{ $description }}
    </p>
</article>

