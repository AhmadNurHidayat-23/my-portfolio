<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    @php
        $defaultTitle = 'Ahmad Nur Hidayat | Web & Mobile Developer';
        $rawTitle = View::hasSection('title') ? trim(View::yieldContent('title')) : ($title ?? $defaultTitle);
        $pageTitle = html_entity_decode($rawTitle, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $defaultDesc = 'Ahmad Nur Hidayat — Web & Mobile Developer. Personal portfolio showcasing web, mobile, and backend applications, technical skills, and verified credentials.';
        $rawDesc = View::hasSection('description') ? trim(View::yieldContent('description')) : ($description ?? $defaultDesc);
        $pageDescription = html_entity_decode($rawDesc, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $pageImage = View::hasSection('image') ? trim(View::yieldContent('image')) : ($image ?? asset('images/ahmad-portrait-cutout.png'));
        $canonicalUrl = $canonical ?? url()->current();
        $siteName = 'Ahmad Nur Hidayat — Portfolio';
    @endphp

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:image" content="{{ $pageImage }}">
    <meta property="og:site_name" content="{{ $siteName }}">

    {{-- Twitter / X Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $canonicalUrl }}">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ $pageImage }}">

    {{-- Portfolio Favicon (Final Logo TAB) --}}
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v=20261031c">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v=20261031c">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('favicon-48x48.png') }}?v=20261031c">
    <link rel="icon" type="image/png" sizes="180x180" href="{{ asset('favicon-180x180.png') }}?v=20261031c">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v=20261031c">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v=20261031c">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-[#111111] font-sans antialiased selection:bg-[#111111] selection:text-white">
    @isset($slot)
        {{ $slot }}
    @else
        @yield('content')
    @endisset
</body>
</html>
