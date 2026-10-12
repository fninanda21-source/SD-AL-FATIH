<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $namaSekolah ?? config('app.name'))</title>
    <meta name="description" content="@yield('description', $taglineSekolah ?? '')">
    <meta name="author" content="{{ $namaSekolah ?? config('app.name') }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $namaSekolah ?? config('app.name') }}">
    <meta property="og:title" content="@yield('title', $namaSekolah ?? config('app.name'))">
    <meta property="og:description" content="@yield('description', $taglineSekolah ?? '')">

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen bg-white">
    <a href="#konten-utama"
        class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-100 focus:rounded-lg focus:bg-brand-700 focus:px-4 focus:py-2 focus:text-sm focus:font-bold focus:text-white">
        Lewati ke konten utama
    </a>

    @include('partials.navbar')

    <main id="konten-utama">
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
