<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-slate-800 text-center">Edit Pesan</h2>

        <form action="{{ route('guestbook.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama</label>
                <input type="text" name="visitor_name" value="{{ $data->visitor_name }}" class="border p-3 rounded-lg w-full focus:ring-2 focus:ring-yellow-500 outline-none" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Pesan</label>
                <textarea name="message" rows="4" class="border p-3 rounded-lg w-full focus:ring-2 focus:ring-yellow-500 outline-none" required>{{ $data->message }}</textarea>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 rounded-lg transition">Update</button>
                <a href="{{ route('guestbook.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-3 rounded-lg text-center transition">Batal</a>
            </div>
        </form>
    </div>

</body>
</html>