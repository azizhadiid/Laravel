@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-6">Add Product</h2>

    <form action="/products/store" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-medium">Product Name</label>
            <input type="text" name="name"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <div>
            <label class="block mb-1 font-medium">Price</label>
            <input type="number" name="price"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <div class="flex justify-end space-x-2">
            <a href="/products" class="px-4 py-2 border rounded">Cancel</a>
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save
            </button>
        </div>

    </form>
</div>
@endsection
