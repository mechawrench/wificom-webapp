<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <meta name="application-name" content="{{ config('app.name') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles -->
        <style>[x-cloak] { display: none !important; }</style>
        @livewireStyles
        <script src="https://kit.fontawesome.com/your-fontawesome-kit-code.js" crossorigin="anonymous"></script>
    </head>

    <body class="antialiased">
        {{ $slot }}
    </body>
    <!-- Scripts -->
    @livewireScripts
    @stack('scripts')

</html>
