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
        <div class="container mx-auto">
            <a href="{{ url('/') }}" class="font-bold text-lg">MOE ICT Ticketing</a>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html>
