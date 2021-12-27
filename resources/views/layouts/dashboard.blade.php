<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="initData" lang="en" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css?v=1.3') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js?v=2.3') }}" defer></script>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
        defer
    ></script>

    <script src="{{ asset('js/charts-lines.js') }}" defer></script>
    <script src="{{ asset('js/charts-pie.js') }}" defer></script>

    @livewireStyles
</head>
<body>
<div
    class="flex h-screen bg-gray-50 dark:bg-gray-900"
    :class="{ 'overflow-hidden': isSideMenuOpen }"
>
    <x-dashboard.sidebar/>

    <div class="flex flex-col flex-1 w-full">
        <x-dashboard.header/>

        <main class="h-full overflow-y-auto">
            {{ $slot }}
        </main>
    </div>
</div>

@livewireScripts
</body>
</html>
