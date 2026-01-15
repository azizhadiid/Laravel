<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg border-t-4 border-yellow-400">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Edit Siswa</h2>

        <form action="{{ route('siswa.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">NIS</label>
                <input type="number" name="nis" value="{{ $student->nis }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ $student->name }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Pilih Kelas</label>
                <select name="classroom_id" class="w-full px-3 py-2 border rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    @foreach($classrooms as $class)
                        <option value="{{ $class->id }}" {{ $student->classroom_id == $class->id ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="w-full bg-yellow-500 text-white font-bold py-2 rounded-lg hover:bg-yellow-600">Update</button>
                <a href="{{ route('siswa.index') }}" class="w-full bg-gray-300 text-gray-700 font-bold py-2 rounded-lg text-center hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>

</body>
</html>