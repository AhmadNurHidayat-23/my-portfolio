@extends('layouts.app')

@php
    $totalCount = $totalRepositoriesCount ?? count($projects);
@endphp

@section('title', 'All Projects — Ahmad Nur Hidayat | Web & Mobile Developer')
@section('description', 'Browse all ' . $totalCount . ' public software, web, and mobile projects developed by Ahmad Nur Hidayat.')

@section('content')
    <x-navbar />

    <main class="projects-editorial-section pt-12 pb-24">
        <div class="projects-container">
            {{-- Breadcrumb Navigation --}}
            <nav class="mb-8" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-[#666666] hover:text-[#000000] transition-colors">
                    <span aria-hidden="true">&larr;</span>
                    <span>Back to Portfolio</span>
                </a>
            </nav>

            {{-- Page Header --}}
            <div class="projects-header-row">
                <div>
                    <span class="projects-section-index">
                        Archive / All Projects
                    </span>
                    <h1 class="projects-editorial-heading">
                        All Public Projects.
                    </h1>
                    <p class="projects-editorial-intro">
                        A dynamic overview of all {{ $totalCount }} repositories maintained on GitHub, automatically synchronized via the GitHub REST API.
                    </p>
                </div>

                <div class="projects-header-badge">
                    <span>Showing all {{ $totalCount }} {{ \Illuminate\Support\Str::plural('Repository', $totalCount) }}</span>
                </div>
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
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                @endforelse
            </div>

            {{-- All Repositories Action --}}
            <div class="projects-actions-container">
                <a
                    href="https://github.com/AhmadNurHidayat-23?tab=repositories"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="projects-all-repositories-btn"
                >
                    <svg width="15" height="15" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8C0 11.54 2.29 14.53 5.47 15.59C5.87 15.66 6.02 15.42 6.02 15.21C6.02 15.02 6.01 14.39 6.01 13.72C4 14.09 3.48 13.23 3.32 12.78C3.23 12.55 2.84 11.84 2.5 11.65C2.22 11.5 1.82 11.13 2.49 11.12C3.12 11.11 3.57 11.7 3.72 11.94C4.44 13.15 5.59 12.81 6.05 12.6C6.12 12.08 6.33 11.73 6.56 11.53C4.78 11.33 2.92 10.64 2.92 7.58C2.92 6.71 3.23 5.99 3.74 5.43C3.66 5.23 3.38 4.41 3.82 3.31C3.82 3.31 4.49 3.1 6.02 4.13C6.66 3.95 7.34 3.86 8.02 3.86C8.7 3.86 9.38 3.95 10.02 4.13C11.55 3.09 12.22 3.31 12.22 3.31C12.66 4.41 12.38 5.23 12.3 5.43C12.81 5.99 13.12 6.7 13.12 7.58C13.12 10.65 11.25 11.33 9.47 11.53C9.76 11.78 10.01 12.26 10.01 13.01C10.01 14.09 10 14.96 10 15.21C10 15.42 10.15 15.67 10.55 15.59C13.71 14.53 16 11.53 16 8Z"/>
                    </svg>
                    <span>All Repositories</span>
                    <svg width="12" height="12" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path d="M4 12L12 4M12 4H6M12 4V10" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </div>
    </main>

    {{-- Floating WhatsApp Action --}}
    <x-whatsapp />
@endsection
