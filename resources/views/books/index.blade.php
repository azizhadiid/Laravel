<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan Mini</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-amber-50 p-8 font-serif">

    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6 border-b-2 border-amber-800 pb-4">
            <h1 class="text-3xl font-bold text-amber-900">📚 Perpustakaan Mini</h1>
            <a href="{{ route('books.create') }}" class="bg-amber-700 hover:bg-amber-900 text-white px-4 py-2 rounded shadow">
                + Tambah Buku
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4 border border-green-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid gap-4">
            @foreach($books as $book)
            <div class="bg-white p-6 rounded-lg shadow-md border-l-8 border-amber-600 flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">{{ $book->title }}</h3>
                    <p class="text-gray-600 italic">Penulis: {{ $book->author }} ({{ $book->year }})</p>
                    
                    <span class="inline-block mt-2 bg-amber-100 text-amber-800 text-xs px-2 py-1 rounded-full font-bold uppercase">
                        {{ $book->category->name }}
                    </span>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('books.edit', $book->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    <span class="text-gray-300">|</span>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Hapus buku ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</body>
</html>