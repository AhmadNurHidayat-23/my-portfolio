<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Ahmad Nur Hidayat — Independent Creative Developer & Portfolio">
    <title>{{ $title ?? 'Ahmad Nur Hidayat — Independent Creative Developer' }}</title>

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
