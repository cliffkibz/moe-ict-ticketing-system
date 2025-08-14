<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'MOE ICT Ticketing') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        :root {
            --brand-green: #0c5c2c; /* deep green */
            --brand-green-dark: #094521; /* darker green */
            --brand-gold: #F0B429; /* gold accent */
            --brand-gray: #1f2937; /* gray-800 */
        }
        /* Quick theming overrides for existing utility classes */
        .bg-blue-800 { background-color: var(--brand-green-dark) !important; }
        .bg-blue-600 { background-color: var(--brand-green) !important; }
        .hover\:bg-blue-700:hover { background-color: var(--brand-green-dark) !important; }
        .text-blue-600 { color: var(--brand-green) !important; }
        .bg-indigo-600 { background-color: var(--brand-gold) !important; color: var(--brand-gray) !important; }
        .text-indigo-700 { color: var(--brand-gold) !important; }
        .ring-brand { box-shadow: 0 0 0 1px var(--brand-green) inset; }
        a:hover { opacity: .95; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Government ribbon (Kenyan flag colors) -->
    <div class="w-full h-1">
        <div class="h-1" style="background: linear-gradient(to right, #000 0 20%, #ffffff 20% 22%, #c8102e 22% 78%, #ffffff 78% 80%, #006400 80% 100%);"></div>
    </div>

    <!-- Navbar -->
    <nav class="bg-blue-800 text-white">
        <div class="container mx-auto px-4 py-4 flex items-center gap-6">
            <a href="{{ route('dashboard') }}" class="font-bold text-lg tracking-wide">MOE ICT Ticketing</a>
            <a href="{{ route('tickets.index') }}" class="hover:underline">Tickets</a>
            <a href="{{ route('kb.index') }}" class="hover:underline">Knowledge Base</a>
            <a href="http://127.0.0.1:8000/users" class="hover:underline">Users</a>
        </div>
    </nav>

    <!-- Main -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 mt-8">
        <div class="container mx-auto px-4 py-6 flex flex-col md:flex-row items-center justify-between gap-3">
            <div>
                <div class="font-semibold text-white">Ministry of Education — ICT Ticketing</div>
                <div class="text-sm text-gray-400">Improving efficiency, accountability, and service quality</div>
            </div>
            <div class="flex items-center gap-6 text-sm">
                <a href="{{ route('tickets.index') }}" class="hover:text-white">Tickets</a>
                <a href="{{ route('kb.index') }}" class="hover:text-white">Knowledge Base</a>
            </div>
        </div>
        <div class="bg-gray-800 text-gray-400 text-xs">
            <div class="container mx-auto px-4 py-2">&copy; {{ date('Y') }} Ministry of Education</div>
        </div>
    </footer>

    @include('chat.widget')
    @stack('scripts')
</body>
</html>
