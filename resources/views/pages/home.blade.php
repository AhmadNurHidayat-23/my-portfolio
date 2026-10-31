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
    </main>

    {{-- Floating WhatsApp Action --}}
    <x-whatsapp />
@endsection
