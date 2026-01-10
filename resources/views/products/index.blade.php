@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Product List</h2>
        <a href="/products/create"
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            + Add Product
        </a>
    </div>

    <table class="w-full border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Price</th>
                <th class="border px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
            <tr class="text-center">
                <td class="border px-4 py-2">{{ $item->id }}</td>
                <td class="border px-4 py-2">{{ $item->name }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($item->price) }}</td>
                <td class="border px-4 py-2 space-x-2">
                    <a href="/products/edit/{{ $item->id }}"
                       class="bg-yellow-500 text-white px-3 py-1 rounded">
                        Edit
                    </a>
                    <a href="/products/delete/{{ $item->id }}"
                       onclick="return confirm('Yakin hapus?')"
                       class="bg-red-600 text-white px-3 py-1 rounded">
                        Delete
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
