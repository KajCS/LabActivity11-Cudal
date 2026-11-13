<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Barangay Bulletin – Purok Cudal')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <nav class="bg-emerald-700 text-white">
        <div class="max-w-6xl mx-auto px-4 py-3 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <a href="{{ route('posts.index') }}" class="font-bold text-lg">Barangay Bulletin – Purok Cudal</a>
            <div class="flex items-center gap-4 text-sm">
                <a href="{{ route('posts.index') }}" class="hover:underline">All Posts</a>
            </div>
        </div>
    </nav>

    <main class="flex-1 w-full max-w-6xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    <footer class="bg-white border-t text-center text-sm text-gray-500 py-4">
        Barangay Matina Crossing Hall · Davao City
    </footer>
</body>
</html>