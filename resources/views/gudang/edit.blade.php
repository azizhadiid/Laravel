<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-800 flex items-center justify-center min-h-screen text-gray-100">

    <div class="w-full max-w-lg bg-gray-700 p-8 rounded-xl shadow-2xl border border-yellow-500">
        <h2 class="text-2xl font-bold mb-6 text-center text-white">✏️ Edit Data Inventaris</h2>

        <form action="{{ route('gudang.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-300 text-sm font-bold mb-2">Nama Barang</label>
                <input type="text" name="nama_barang" value="{{ $item->nama_barang }}" class="w-full bg-gray-900 border border-gray-600 rounded p-3 text-white focus:outline-none focus:border-yellow-500" required>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-300 text-sm font-bold mb-2">Jumlah Stok</label>
                    <input type="number" name="stok" value="{{ $item->stok }}" class="w-full bg-gray-900 border border-gray-600 rounded p-3 text-white focus:outline-none focus:border-yellow-500" required>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-bold mb-2">Kondisi</label>
                    <select name="kondisi" class="w-full bg-gray-900 border border-gray-600 rounded p-3 text-white focus:outline-none focus:border-yellow-500">
                        <option value="Baru" {{ $item->kondisi == 'Baru' ? 'selected' : '' }}>Baru</option>
                        <option value="Bekas Bagus" {{ $item->kondisi == 'Bekas Bagus' ? 'selected' : '' }}>Bekas Bagus</option>
                        <option value="Rusak" {{ $item->kondisi == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-300 text-sm font-bold mb-2">Lokasi Rak</label>
                <input type="text" name="lokasi_rak" value="{{ $item->lokasi_rak }}" class="w-full bg-gray-900 border border-gray-600 rounded p-3 text-white focus:outline-none focus:border-yellow-500" required>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-yellow-600 hover:bg-yellow-500 text-white font-bold py-3 rounded transition">Update Data</button>
                <a href="{{ route('gudang.index') }}" class="flex-1 bg-gray-600 hover:bg-gray-500 text-white font-bold py-3 rounded text-center transition">Batal</a>
            </div>
        </form>
    </div>

</body>
</html>