@props([
    'certificates' => [],
])

@php
    $certificatesList = !empty($certificates) ? $certificates : config('certificates.items', []);
    $totalCount = count($certificatesList);
@endphp

<section class="certificates-editorial-section" id="certificates">
    <div class="certificates-container">

        {{-- Section Header --}}
        <div class="certificates-header-row">
            <div>
                <span class="certificates-section-index">
                    04 / Certificates
                </span>
                <h2 class="certificates-editorial-heading">
                    Certificates.
                </h2>
                <p class="certificates-editorial-intro">
                    Certifications &amp; Achievements
                </p>
            </div>

            @if ($totalCount > 0)
                <div class="certificates-header-badge">
                    <span>{{ $totalCount }} {{ \Illuminate\Support\Str::plural('Certificate', $totalCount) }}</span>
                </div>
            @endif
        </div>

        {{-- Editorial 2-Column Grid (Desktop) / 1-Column (Mobile) --}}
        <div class="certificates-grid">
            @forelse ($certificatesList as $certificate)
                <x-certificate-card :certificate="$certificate" />
            @empty
                <div class="certificates-empty-state">
                    <p class="certificates-empty-text">No certificates available at this time.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>
