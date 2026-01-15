<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa (No Model/Controller)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-10 font-sans">

    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">🎓 Data Siswa Sekolah</h1>
                <p class="text-gray-500">Contoh Relasi Manual (Join Table)</p>
            </div>
            <a href="{{ route('siswa.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-bold shadow hover:bg-indigo-700 transition">
                + Tambah Siswa
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">NIS</th>
                        <th class="py-3 px-6 text-left">Nama Siswa</th>
                        <th class="py-3 px-6 text-left">Kelas</th>
                        <th class="py-3 px-6 text-left">Wali Kelas</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @foreach($students as $s)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left font-mono font-bold">{{ $s->nis }}</td>
                        <td class="py-3 px-6 text-left font-medium">{{ $s->name }}</td>
                        <td class="py-3 px-6 text-left">
                            <span class="bg-indigo-100 text-indigo-800 py-1 px-3 rounded-full text-xs font-bold">
                                {{ $s->class_name }}
                            </span>
                        </td>
                        <td class="py-3 px-6 text-left text-xs">{{ $s->teacher }}</td>
                        <td class="py-3 px-6 text-center flex justify-center gap-2">
                            <a href="{{ route('siswa.edit', $s->id) }}" class="text-yellow-500 hover:text-yellow-700 font-bold">Edit</a>
                            <form action="{{ route('siswa.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus siswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:text-red-700 font-bold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>