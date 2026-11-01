@props([
    'certificate' => [],
])

@php
    $number = (string) ($certificate['number'] ?? '01');
    $title = (string) ($certificate['title'] ?? 'Certificate');
    $issuer = (string) ($certificate['issuer'] ?? '');
    $year = (string) ($certificate['year'] ?? '');
    $description = (string) ($certificate['description'] ?? '');
    $image = (string) ($certificate['image'] ?? '');
    $imageVersion = $image && file_exists(public_path($image)) ? (string) filemtime(public_path($image)) : '1';
@endphp

<article class="certificate-card">
    {{-- Left: Certificate Preview Frame --}}
    <div class="certificate-media-wrapper">
        @if ($image)
            @php
                $webpImage = preg_replace('/\.(png|jpe?g)$/i', '.webp', $image);
                $hasWebp = file_exists(public_path($webpImage));
            @endphp
            @if ($hasWebp)
                <picture>
                    <source srcset="{{ asset($webpImage) }}?v={{ $imageVersion }}" type="image/webp">
                    <img
                        src="{{ asset($image) }}?v={{ $imageVersion }}"
                        alt="{{ $title }} - {{ $issuer }}"
                        loading="lazy"
                        class="certificate-image"
                    />
                </picture>
            @else
                <img
                    src="{{ asset($image) }}?v={{ $imageVersion }}"
                    alt="{{ $title }} - {{ $issuer }}"
                    loading="lazy"
                    class="certificate-image"
                />
            @endif
        @else
            <div class="certificate-placeholder" aria-hidden="true">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                    <line x1="7" y1="8" x2="17" y2="8"></line>
                    <line x1="7" y1="12" x2="13" y2="12"></line>
                </svg>
            </div>
        @endif
    </div>

    {{-- Right: Certificate Information & Metadata --}}
    <div class="certificate-content">
        <div class="certificate-meta-row">
            <span class="certificate-number">{{ $number }}</span>
            <span class="certificate-divider" aria-hidden="true">/</span>
            <span class="certificate-year">{{ $year }}</span>
        </div>

        <h3 class="certificate-title">
            {{ $title }}
        </h3>

        <div class="certificate-issuer">
            {{ $issuer }}
        </div>

        <p class="certificate-description">
            {{ $description }}
        </p>
    </div>
</article>

