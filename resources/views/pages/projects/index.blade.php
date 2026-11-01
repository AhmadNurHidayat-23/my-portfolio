@extends('layouts.app')

@php
    $totalCount = count($projects);
@endphp

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
        </div>
    </main>

    {{-- Floating WhatsApp Action --}}
    <x-whatsapp />
@endsection

