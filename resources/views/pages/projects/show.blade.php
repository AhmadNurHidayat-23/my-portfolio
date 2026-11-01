@extends('layouts.app')

@php
    $name = (string) ($project['name'] ?? 'Untitled Project');
    $owner = (string) ($project['owner_login'] ?? 'AhmadNurHidayat-23');
    $category = (string) ($project['category'] ?? 'Software Project');
    $technology = (string) ($project['technology'] ?? ($project['language'] ?? 'Modern Web Stack'));
    $year = (string) ($project['updated_year'] ?? '2026');
    $description = !empty($project['description']) ? (string) $project['description'] : 'Sistem aplikasi perangkat lunak.';
    $overview = !empty($project['overview']) ? (string) $project['overview'] : $description;
    $features = is_array($project['features'] ?? null) ? $project['features'] : [];
    $technical = !empty($project['technical']) ? (string) $project['technical'] : null;
    $htmlUrl = !empty($project['html_url']) ? (string) $project['html_url'] : null;
    $homepage = !empty($project['homepage']) ? (string) $project['homepage'] : null;
    $imageUrl = !empty($project['image_url']) ? (string) $project['image_url'] : null;
    $imageType = (string) ($project['image_type'] ?? 'web');
    $galleryImages = is_array($project['gallery_images'] ?? null) ? $project['gallery_images'] : [];
    $isCollaborator = (bool) ($project['is_collaborator'] ?? false);
    $defaultBranch = (string) ($project['default_branch'] ?? 'main');
    $license = (string) ($project['license_name'] ?? 'Open Source');
@endphp

@section('content')
    <x-navbar />

    <main class="project-detail-main">
        <div class="project-detail-container">
            {{-- Navigation Back Link --}}
            <nav aria-label="Back Navigation">
                <a href="{{ route('home') }}#projects" class="project-detail-back-link">
                    <span aria-hidden="true">&larr;</span>
                    <span>Back to Selected Work</span>
                </a>
            </nav>

            {{-- Project Introduction Header --}}
            <header class="project-detail-header">
                <span class="project-detail-category">
                    {{ $category }} &mdash; {{ $technology }}
                </span>
                <h1 class="project-detail-title">
                    {{ $name }}
                </h1>
                <p class="project-detail-description">
                    {{ $description }}
                </p>

                {{-- Action Links --}}
                <div class="project-detail-cta-group">
                    @if ($htmlUrl)
                        <a
                            href="{{ $htmlUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="project-detail-btn-primary"
                        >
                            <svg width="15" height="15" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8C0 11.54 2.29 14.53 5.47 15.59C5.87 15.66 6.02 15.42 6.02 15.21C6.02 15.02 6.01 14.39 6.01 13.72C4 14.09 3.48 13.23 3.32 12.78C3.23 12.55 2.84 11.84 2.5 11.65C2.22 11.5 1.82 11.13 2.49 11.12C3.12 11.11 3.57 11.7 3.72 11.94C4.44 13.15 5.59 12.81 6.05 12.6C6.12 12.08 6.33 11.73 6.56 11.53C4.78 11.33 2.92 10.64 2.92 7.58C2.92 6.71 3.23 5.99 3.74 5.43C3.66 5.23 3.38 4.41 3.82 3.31C3.82 3.31 4.49 3.1 6.02 4.13C6.66 3.95 7.34 3.86 8.02 3.86C8.7 3.86 9.38 3.95 10.02 4.13C11.55 3.09 12.22 3.31 12.22 3.31C12.66 4.41 12.38 5.23 12.3 5.43C12.81 5.99 13.12 6.7 13.12 7.58C13.12 10.65 11.25 11.33 9.47 11.53C9.76 11.78 10.01 12.26 10.01 13.01C10.01 14.09 10 14.96 10 15.21C10 15.42 10.15 15.67 10.55 15.59C13.71 14.53 16 11.53 16 8C16 3.58 12.42 0 8 0Z"/>
                            </svg>
                            <span>View on GitHub</span>
                        </a>
                    @endif

                    @if ($homepage)
                        <a
                            href="{{ $homepage }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="project-detail-btn-secondary"
                        >
                            <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <circle cx="8" cy="8" r="7"/>
                                <path d="M1 8H15M8 1C9.8 3.4 10.8 5.7 10.8 8C10.8 10.3 9.8 12.6 8 15C6.2 12.6 5.2 10.3 5.2 8C5.2 5.7 6.2 3.4 8 1Z"/>
                            </svg>
                            <span>Live Website</span>
                            <span aria-hidden="true">&nearr;</span>
                        </a>
                    @endif
                </div>
            </header>

            {{-- Specifications Grid --}}
            <section class="project-detail-spec-grid" aria-label="Project Specifications">
                <div class="project-spec-item">
                    <span class="project-spec-label">Category</span>
                    <span class="project-spec-value">{{ $category }}</span>
                </div>
                <div class="project-spec-item">
                    <span class="project-spec-label">Technology</span>
                    <span class="project-spec-value">{{ $technology }}</span>
                </div>
                <div class="project-spec-item">
                    <span class="project-spec-label">Role</span>
                    <span class="project-spec-value">
                        @if ($isCollaborator)
                            Collaborator ({{ $owner }})
                        @else
                            Author &bull; Ahmad
                        @endif
                    </span>
                </div>
                <div class="project-spec-item">
                    <span class="project-spec-label">Year</span>
                    <span class="project-spec-value">{{ $year }}</span>
                </div>
            </section>

            {{-- Project Screenshots / Multi-Screen Showcase --}}
            @if ($imageUrl)
                <section class="project-detail-visuals" aria-label="Project Visual Showcase">
                    <div class="project-detail-hero-media">
                        <img
                            src="{{ $imageUrl }}"
                            alt="Visual showcase of {{ $name }}"
                            loading="eager"
                            class="project-detail-cover-image"
                        />
                    </div>

                    @if (count($galleryImages) > 1)
                        <div class="project-detail-gallery-wrap">
                            <span class="project-detail-gallery-tag">Application Screen Previews</span>
                            <div class="project-detail-gallery-grid {{ $imageType === 'mobile' ? 'is-mobile-grid' : 'is-web-grid' }}">
                                @foreach ($galleryImages as $index => $screen)
                                    <div class="project-detail-gallery-item">
                                        <img
                                            src="{{ $screen }}"
                                            alt="{{ $name }} screen preview {{ $index + 1 }}"
                                            loading="lazy"
                                            class="project-detail-gallery-img"
                                        />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </section>
            @endif

            {{-- Project Overview --}}
            <section class="project-detail-section">
                <h2 class="project-detail-section-title">Project Overview</h2>
                <p class="project-detail-section-body">
                    {{ $overview }}
                </p>
            </section>

            {{-- Key Features (If Available) --}}
            @if (!empty($features))
                <section class="project-detail-section">
                    <h2 class="project-detail-section-title">Key Features</h2>
                    <ul class="project-detail-features-list">
                        @foreach ($features as $feature)
                            <li class="project-detail-feature-item">
                                <span class="project-detail-feature-bullet" aria-hidden="true"></span>
                                <span>{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endif

            {{-- Technical Implementation --}}
            <section class="project-detail-section">
                <h2 class="project-detail-section-title">Technical Implementation</h2>
                @if ($technical)
                    <p class="project-detail-section-body mb-4">
                        {{ $technical }}
                    </p>
                @endif

                @if ($htmlUrl)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 py-4 border-t border-b border-[#E5E5E5] my-4 text-xs font-sans">
                        <div>
                            <span class="block uppercase tracking-wider text-[#888888] font-semibold mb-1">Branch</span>
                            <span class="font-mono bg-[#F5F5F5] px-2 py-0.5 rounded">{{ $defaultBranch }}</span>
                        </div>
                        <div>
                            <span class="block uppercase tracking-wider text-[#888888] font-semibold mb-1">License</span>
                            <span class="text-[#111111]">{{ $license }}</span>
                        </div>
                    </div>

                    <div class="p-3.5 bg-[#FAFAFA] border border-[#E5E5E5] rounded-sm font-mono text-xs text-[#333333]">
                        <span>git clone {{ $htmlUrl }}.git</span>
                    </div>
                @else
                    <p class="project-detail-section-body text-xs text-[#888888]">
                        Source code repository dalam tahap pengembangan atau konfigurasi akses privat.
                    </p>
                @endif
            </section>

            {{-- Next Project Navigation --}}
            @if ($nextProject)
                <nav class="pt-8 mt-12 border-t border-[#E5E5E5] flex items-center justify-between" aria-label="Next Project">
                    <span class="text-xs font-semibold uppercase tracking-wider text-[#888888]">Next Project</span>
                    <a
                        href="{{ route('projects.show', $nextProject['slug']) }}"
                        class="inline-flex items-center gap-2 font-serif text-lg font-bold text-[#111111] hover:underline"
                    >
                        <span>{{ $nextProject['name'] }}</span>
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </nav>
            @endif
        </div>
    </main>

    {{-- Floating WhatsApp Action --}}
    <x-whatsapp />
@endsection
