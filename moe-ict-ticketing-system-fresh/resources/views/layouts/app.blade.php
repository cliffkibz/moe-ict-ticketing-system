<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'MOE ICT Ticketing') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-800 text-white p-4 mb-6">
        <div class="container mx-auto flex items-center gap-6">
            <a href="{{ route('dashboard') }}" class="font-bold text-lg">MOE ICT Ticketing</a>
            <a href="{{ route('tickets.index') }}" class="hover:underline">Tickets</a>
            <a href="{{ route('kb.index') }}" class="hover:underline">Knowledge Base</a>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
