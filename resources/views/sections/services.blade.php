@props([
    'services' => [],
])

@php
    $servicesList = !empty($services) ? $services : config('portfolio.services', []);
    $whatsappNumber = config('portfolio.whatsapp_number');
    $cleanNumber = $whatsappNumber ? preg_replace('/[^0-9]/', '', (string) $whatsappNumber) : null;
    $defaultMessage = config('portfolio.whatsapp_message', 'Halo Ahmad, saya melihat portofolio Anda dan tertarik untuk berdiskusi mengenai kerja sama atau proyek.');
    $contactUrl = $cleanNumber
        ? 'https://wa.me/' . $cleanNumber . '?text=' . urlencode($defaultMessage)
        : '#contact';
    $isExternal = !empty($cleanNumber);
@endphp

<section class="services-editorial-section" id="services">
    <div class="services-container">

        {{-- Section Header --}}
        <div class="services-header-row">
            <div>
                <span class="services-section-index">
                    06 / EXPERTISE &amp; SERVICES
                </span>
                <h2 class="services-editorial-heading">
                    What I Do.
                </h2>
            </div>
            <div class="services-intro-column">
                <p class="services-editorial-intro">
                    I transform ideas into functional digital experiences through thoughtful design and development.
                </p>
            </div>
        </div>

        {{-- 2-Column Editorial Services Grid --}}
        <div class="services-grid">
            @foreach ($servicesList as $service)
                <x-service-item :service="$service" />
            @endforeach
        </div>

        {{-- Editorial Minimalist CTA --}}
        <div class="services-cta-row">
            <span class="services-cta-label">Have a project in mind?</span>
            <a
                href="{{ $contactUrl }}"
                @if ($isExternal)
                    target="_blank"
                    rel="noopener noreferrer"
                @endif
                class="services-cta-link"
            >
                <span>Let's Talk</span>
                <span class="services-cta-arrow" aria-hidden="true">↗</span>
            </a>
        </div>

    </div>
</section>

