<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-md text-center">
        <h1 class="text-3xl font-bold mb-4">
            Hello, Laravel with Vite!
        </h1>

        <a href="/products"
           class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
            Go to Products
        </a>
    </div>

</body>
</html>
