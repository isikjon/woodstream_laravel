<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/icons/logo.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('fonts/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}?v={{ time() }}">
    <title>@yield('title', 'WoodStream')</title>
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        @include('components.header')
        
        <main class="main">
            @yield('content')
        </main>
        
        @include('components.footer')
    </div>
    
    @include('components.modals')
    @include('components.whatsapp-button')
    
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/fancybox.umd.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>

