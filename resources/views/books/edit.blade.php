<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-amber-50 flex items-center justify-center h-screen font-serif">

    <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-md border-t-4 border-amber-700">
        <h2 class="text-2xl font-bold mb-6 text-amber-900">Edit Data Buku</h2>

        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-1">Judul Buku</label>
                <input type="text" name="title" value="{{ $book->title }}" class="w-full border-b-2 border-gray-300 focus:border-amber-600 outline-none py-2 transition" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-1">Penulis</label>
                <input type="text" name="author" value="{{ $book->author }}" class="w-full border-b-2 border-gray-300 focus:border-amber-600 outline-none py-2 transition" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-1">Tahun Terbit</label>
                <input type="number" name="year" value="{{ $book->year }}" class="w-full border-b-2 border-gray-300 focus:border-amber-600 outline-none py-2 transition" required>
            </div>

            <div class="mb-8">
                <label class="block text-gray-700 font-bold mb-1">Kategori</label>
                <select name="category_id" class="w-full bg-gray-50 border border-gray-300 rounded p-2 focus:ring-2 focus:ring-amber-500 outline-none">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $book->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-amber-700 hover:bg-amber-900 text-white font-bold py-2 rounded">Update</button>
                <a href="{{ route('books.index') }}" class="flex-1 text-center text-gray-600 hover:text-gray-900 py-2">Batal</a>
            </div>
        </form>
    </div>

</body>
</html>