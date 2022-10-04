<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.meta')
    @include('partials.styles')

    {{-- Injectable styles --}}
    @yield('styles')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    @include('layouts.navigation')

    <div class="my-5">
        {{-- Dynamically Injectable Content --}}
        {{ $slot }}
        @yield('content')
    </div>

    @include('partials.footer')
    @include('partials.scripts')

    {{-- Injectable script --}}
    @yield('scripts')
</body>

</html>
