@extends('layouts.app')

@section('title', '404 — Page Not Found | Ahmad Nur Hidayat')
@section('description', 'The page you requested could not be found.')

@section('content')
    <x-navbar />

    <main class="min-h-[75vh] flex items-center justify-center px-6 py-24 bg-white text-[#111111]">
        <div class="max-w-2xl mx-auto text-center">
            {{-- Editorial Index / Eyebrow --}}
            <span class="inline-block text-xs font-mono uppercase tracking-[0.2em] text-[#666666] mb-6">
                Error 404 / Page Not Found
            </span>

            {{-- Main Editorial Heading --}}
            <h1 class="text-5xl sm:text-7xl font-serif font-bold tracking-tight text-[#111111] mb-6 leading-none">
                Lost in whitespace.
            </h1>

            {{-- Description --}}
            <p class="text-base sm:text-lg text-[#666666] font-sans leading-relaxed max-w-lg mx-auto mb-10">
                The page you are looking for does not exist, has been removed, or is temporarily unavailable.
            </p>

            {{-- Action Group --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a
                    href="{{ route('home') }}"
                    class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-[#111111] text-white text-xs font-semibold uppercase tracking-wider hover:bg-[#333333] transition-colors"
                >
                    <span>Back to Portfolio</span>
                    <span aria-hidden="true">&rarr;</span>
                </a>

                <a
                    href="{{ route('projects.index') }}"
                    class="inline-flex items-center justify-center gap-3 px-8 py-4 border border-[#E5E5E5] text-[#111111] text-xs font-semibold uppercase tracking-wider hover:border-[#111111] transition-colors"
                >
                    <span>View Projects</span>
                </a>
            </div>
        </div>
    </main>

    {{-- Minimal Dark Editorial Footer --}}
    <footer class="bg-[#0a0a0a] text-white py-8 border-t border-[#222222]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-[#888888]">
            <p>&copy; {{ date('Y') }} Ahmad Nur Hidayat. All rights reserved.</p>
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">
                ahmadnurhidayat.com
            </a>
        </div>
    </footer>
@endsection

