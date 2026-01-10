@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-6">Edit Product</h2>

    <form action="/products/update/{{ $product->id }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-medium">Product Name</label>
            <input type="text" name="name" value="{{ $product->name }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block mb-1 font-medium">Price</label>
            <input type="number" name="price" value="{{ $product->price }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex justify-end space-x-2">
            <a href="/products" class="px-4 py-2 border rounded">Cancel</a>
            <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                Update
            </button>
        </div>

    </form>
</div>
@endsection
