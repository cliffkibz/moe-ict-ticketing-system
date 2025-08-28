<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

<<<<<<< HEAD
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
=======
    <!-- Navbar -->
    <nav class="bg-blue-800 text-white">
        <div class="container mx-auto px-4 py-4 flex items-center gap-6">
            <a href="{{ route('dashboard') }}" class="font-bold text-lg tracking-wide">MOE ICT Ticketing</a>
            <a href="{{ route('tickets.index') }}" class="hover:underline">Tickets</a>
            <a href="{{ route('kb.index') }}" class="hover:underline">Knowledge Base</a>
            <a href="http://127.0.0.1:8000/users" class="hover:underline">Users</a>
>>>>>>> 68af52fa054b2312466ce70c28bc354680ce7bd4
        </div>
    </body>
</html>
