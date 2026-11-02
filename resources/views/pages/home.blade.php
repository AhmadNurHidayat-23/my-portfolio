@extends('layouts.app')

@section('content')
    {{-- Editorial Hero Section (Sticky Background Layer) --}}
    @include('sections.hero')

    {{-- Editorial Content Flow (Scroll Overlay Layer) --}}
    <main id="main-content" class="editorial-content-overlay">
        {{-- Editorial About Me Section --}}
        @include('sections.about')

        {{-- Editorial Skills & Technologies Section --}}
        @include('sections.skills')

        {{-- Editorial Selected Work Section (All GitHub Repositories) --}}
        @include('sections.projects', [
            'projects' => $projects,
            'totalRepositoriesCount' => $totalRepositoriesCount ?? null,
        ])

        {{-- Editorial Certificates Section --}}
        @include('sections.certificates', ['certificates' => $certificates ?? []])

        {{-- Editorial What I Do Section (Professional Services) --}}
        @include('sections.services', ['services' => $services ?? []])

        {{-- Editorial Contact & Footer Section (Full-screen Dark Backdrop) --}}
        @include('sections.contact')
    </main>

    {{-- Floating WhatsApp Action --}}
    <x-whatsapp />
@endsection
