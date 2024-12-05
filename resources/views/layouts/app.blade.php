<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100">

    <div class="min-h-screen">
        @livewire('navigation-menu')

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            @yield('content')
        </div>
    </div>

    @stack('modals')

    @livewireScripts
</body>
</html>
