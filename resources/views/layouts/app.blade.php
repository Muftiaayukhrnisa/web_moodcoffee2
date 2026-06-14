<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MoodCoffee - @yield('title', 'We Already Met')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #fef9f0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    @stack('styles')
</head>
<body class="antialiased">
    <div class="container mx-auto px-4 py-4 @if(!in_array(Route::currentRouteName(), ['login', 'register'])) pb-24 @endif">
        @yield('content')
    </div>
    
    {{-- Bottom navigation hanya muncul jika bukan halaman login/register --}}
    @if(!in_array(Route::currentRouteName(), ['login', 'register']))
        @include('screens.partials.bottom-nav')
    @endif
    
    @stack('scripts')
</body>
</html>