<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Gudang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-800 font-sans text-gray-100 p-8">

    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-8 border-b border-gray-600 pb-4">
            <h1 class="text-3xl font-bold text-white">📦 Data Inventaris Gudang</h1>
            <a href="{{ route('gudang.create') }}" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-6 rounded-lg transition">
                + Catat Barang Masuk
            </a>
        </div>

        @if(session('sukses'))
            <div class="bg-green-600 text-white p-4 rounded-lg mb-6 shadow-lg">
                {{ session('sukses') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($barang as $b)
            <div class="bg-gray-700 rounded-xl p-6 shadow-lg border border-gray-600 hover:border-blue-400 transition">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-xl font-bold text-white">{{ $b->nama_barang }}</h3>
                    <span class="bg-gray-900 text-gray-300 text-xs px-2 py-1 rounded">
                        ID: {{ $b->id }}
                    </span>
                </div>
                
                <div class="space-y-2 text-sm text-gray-300 mb-6">
                    <p class="flex justify-between">
                        <span>Stok:</span> 
                        <span class="font-bold text-white">{{ $b->stok }} Unit</span>
                    </p>
                    <p class="flex justify-between">
                        <span>Kondisi:</span> 
                        <span class="{{ $b->kondisi == 'Rusak' ? 'text-red-400' : 'text-green-400' }} font-bold">
                            {{ $b->kondisi }}
                        </span>
                    </p>
                    <p class="flex justify-between">
                        <span>Rak:</span> 
                        <span class="text-yellow-400">{{ $b->lokasi_rak }}</span>
                    </p>
                </div>

                <div class="flex gap-2 border-t border-gray-600 pt-4">
                    <a href="{{ route('gudang.edit', $b->id) }}" class="flex-1 bg-yellow-600 hover:bg-yellow-500 text-center py-2 rounded text-sm font-bold">Edit</a>
                    
                    <form action="{{ route('gudang.destroy', $b->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus barang ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="w-full bg-red-600 hover:bg-red-500 py-2 rounded text-sm font-bold">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</body>
</html>