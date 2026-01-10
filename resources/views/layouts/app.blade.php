<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Laravel CRUD')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-blue-600 text-white px-6 py-4">
        <h1 class="text-xl font-semibold">Laravel CRUD (No Model)</h1>
    </nav>

    <main class="p-6">
        @yield('content')
    </main>

</body>
</html>
