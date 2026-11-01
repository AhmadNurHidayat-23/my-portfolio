@props([
    'project' => [],
])

@php
    $name = (string) ($project['name'] ?? 'Untitled Project');
    $slug = (string) ($project['slug'] ?? \Illuminate\Support\Str::slug($name));
    $category = (string) ($project['category'] ?? 'Software Project');
    $description = !empty($project['description']) ? (string) $project['description'] : 'Sistem aplikasi perangkat lunak.';
    $htmlUrl = !empty($project['html_url']) ? (string) $project['html_url'] : null;
    $imageUrl = !empty($project['image_url']) ? (string) $project['image_url'] : null;
    $detailRoute = route('projects.show', $slug);
@endphp

<article class="project-card group">
    {{-- 16:10 Aspect Ratio Visual Preview --}}
    <div class="project-card-media">
        <a href="{{ $detailRoute }}" class="project-card-media-link" aria-label="View details for {{ $name }}">
            @if ($imageUrl)
                @php
                    $urlPath = parse_url($imageUrl, PHP_URL_PATH);
                    $relativeImg = $urlPath ? ltrim($urlPath, '/') : null;
                    $webpRelative = $relativeImg ? preg_replace('/\.(png|jpe?g)$/i', '.webp', $relativeImg) : null;
                    $hasWebp = $webpRelative && file_exists(public_path($webpRelative));
                @endphp
                @if ($hasWebp)
                    <picture>
                        <source srcset="{{ asset($webpRelative) }}" type="image/webp">
                        <img
                            src="{{ $imageUrl }}"
                            alt="Screenshot of {{ $name }}"
                            loading="lazy"
                            class="project-card-image"
                        />
                    </picture>
                @else
                    <img
                        src="{{ $imageUrl }}"
                        alt="Screenshot of {{ $name }}"
                        loading="lazy"
                        class="project-card-image"
                    />
                @endif
            @else
                <div class="project-card-placeholder">
                    <div class="project-placeholder-inner">
                        <svg class="project-placeholder-icon" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="16 18 22 12 16 6"></polyline>
                            <polyline points="8 6 2 12 8 18"></polyline>
                        </svg>
                        <span class="project-placeholder-tag">{{ $category }}</span>
                    </div>
                </div>
            @endif
        </a>
    </div>

    {{-- Minimal Editorial Card Body --}}
    <div class="project-card-body">
        {{-- Metadata Row: Small Category & Accessible GitHub Icon --}}
        <div class="project-card-meta-row">
            <span class="project-card-category">{{ $category }}</span>

            @if ($htmlUrl)
                <a
                    href="{{ $htmlUrl }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="project-card-github-icon"
                    aria-label="View {{ $name }} source code on GitHub"
                    title="View source on GitHub"
                >
                    <svg width="15" height="15" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8C0 11.54 2.29 14.53 5.47 15.59C5.87 15.66 6.02 15.42 6.02 15.21C6.02 15.02 6.01 14.39 6.01 13.72C4 14.09 3.48 13.23 3.32 12.78C3.23 12.55 2.84 11.84 2.5 11.65C2.22 11.5 1.82 11.13 2.49 11.12C3.12 11.11 3.57 11.7 3.72 11.94C4.44 13.15 5.59 12.81 6.05 12.6C6.12 12.08 6.33 11.73 6.56 11.53C4.78 11.33 2.92 10.64 2.92 7.58C2.92 6.71 3.23 5.99 3.74 5.43C3.66 5.23 3.38 4.41 3.82 3.31C3.82 3.31 4.49 3.1 6.02 4.13C6.66 3.95 7.34 3.86 8.02 3.86C8.7 3.86 9.38 3.95 10.02 4.13C11.55 3.09 12.22 3.31 12.22 3.31C12.66 4.41 12.38 5.23 12.3 5.43C12.81 5.99 13.12 6.7 13.12 7.58C13.12 10.65 11.25 11.33 9.47 11.53C9.76 11.78 10.01 12.26 10.01 13.01C10.01 14.09 10 14.96 10 15.21C10 15.42 10.15 15.67 10.55 15.59C13.71 14.53 16 11.53 16 8C16 3.58 12.42 0 8 0Z"/>
                    </svg>
                </a>
            @endif
        </div>

        {{-- Project Title & Diagonal Arrow --}}
        <a href="{{ $detailRoute }}" class="project-card-title-link">
            <h3 class="project-card-title">{{ $name }}</h3>
            <svg class="project-card-arrow" width="15" height="15" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M4 12L12 4M12 4H6M12 4V10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>

        {{-- Concise System Description (Max 2 lines, line-clamp-2) --}}
        <p class="project-card-description" title="{{ $description }}">
            {{ $description }}
        </p>
    </div>
</article>
