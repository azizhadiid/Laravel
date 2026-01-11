@extends('layouts.app2')

@section('content')
<div class="w-full max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg border-t-4 border-yellow-500">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Data Mahasiswa</h2>

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT') 
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">NIM</label>
            <input type="text" name="nim" value="{{ $student->nim }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-400" >
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
            <input type="text" name="name" value="{{ $student->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Jurusan</label>
            <input type="text" name="major" value="{{ $student->major }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" value="{{ $student->email }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Update Data
            </button>
            <a href="{{ route('students.index') }}" class="text-gray-600 hover:text-gray-900 text-sm font-bold">Batal</a>
        </div>
    </form>
</div>
@endsection