<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Ahmad Nur Hidayat — Web Developer & Portfolio">
    <title>{{ $title ?? 'Ahmad Nur Hidayat | Web Developer' }}</title>

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
