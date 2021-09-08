<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{--Document Meta--}}
        <meta name="title" content="Donaciones | Living Room">
        <meta name="description" content="Web oficial de donaciones de la Fundación Living Room Global.">
        <meta name="keywords" content="Living Room, Fundación, Comunidad, Fe, LVR, Living Room Global, Iglesia Living Room, Livingroom, LVR Colombia, Living Room Colombia, Living Room Barranquilla">
        <meta name="robots" content="index, follow">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="Spanish">
        {{--End Document Meta--}}

        {{--Favicon Stuff--}}
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#000000">
        <meta name="msapplication-TileColor" content="#2b5797">
        <meta name="theme-color" content="#ffffff">
        {{--End Favicon Stuff--}}

        <title>Donaciones | Living Room</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css?v=2.2') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js?v=1.7') }}" defer></script>

        @livewireStyles

        @yield('styles')
    </head>
    <body class="bg-gray-100">
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts

        @yield('scripts')
    </body>
</html>
