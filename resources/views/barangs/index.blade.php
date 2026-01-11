@extends('layouts.app2')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-700">Daftar Barang</h2>
    <a href="{{ route('barangs.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        + Tambah Barang
    </a>
</div>

<div class="bg-white shadow-md rounded my-6 overflow-x-auto">
    <table class="min-w-full table-auto">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Nama Barang</th>
                <th class="py-3 px-6 text-left">Kategori</th>
                <th class="py-3 px-6 text-left">Harga</th>
                <th class="py-3 px-6 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($barangs as $barang)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left font-medium">{{ $barang->name }}</td>
                <td class="py-3 px-6 text-left">
                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">
                        {{ $barang->category_name }}
                    </span>
                </td>
                <td class="py-3 px-6 text-left">Rp {{ number_format($barang->price) }}</td>
                <td class="py-3 px-6 text-center flex justify-center gap-2">
                    <a href="{{ route('barangs.edit', $barang->id) }}" class="text-yellow-500 hover:text-yellow-700 transform hover:scale-110">
                        Edit
                    </a>
                    <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 transform hover:scale-110">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection