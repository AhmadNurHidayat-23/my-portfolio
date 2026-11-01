@props([
    'projects' => [],
])

@php
    $totalCount = count($projects);
@endphp

<section class="projects-editorial-section" id="projects">
    <div class="projects-container">
        
        {{-- Section Header --}}
        <div class="projects-header-row">
            <div>
                <span class="projects-section-index">
                    03 / Works
                </span>
                <h2 class="projects-editorial-heading">
                    Selected Work.
                </h2>
                <p class="projects-editorial-intro">
                    A collection of things I've built.
                </p>
            </div>

            @if ($totalCount > 0)
                <div class="projects-header-badge">
                    <span>{{ $totalCount }} {{ \Illuminate\Support\Str::plural('Repository', $totalCount) }}</span>
                </div>
            @endif
        </div>

        {{-- Compact Editorial Project Grid --}}
        <div class="projects-grid">
            @forelse ($projects as $project)
                <x-project-card :project="$project" />
            @empty
                <div class="projects-empty-state">
                    <h3 class="projects-empty-title">Repositories Updating</h3>
                    <p class="projects-empty-description">
                        Currently synchronizing with GitHub API or rate limit temporarily reached. Please refresh in a moment or visit GitHub directly.
                    </p>
                    <a
                        href="https://github.com/AhmadNurHidayat-23"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="projects-empty-link"
                    >
                        <span>Visit @AhmadNurHidayat-23 on GitHub</span>
                        <svg width="12" height="12" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                            <path d="M4 12L12 4M12 4H6M12 4V10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            @endforelse
        </div>

    </div>
</section>

