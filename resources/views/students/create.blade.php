@extends('layouts.app2')

@section('content')
<div class="w-full max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg border-t-4 border-indigo-600">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Input Mahasiswa Baru</h2>

    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">NIM</label>
            <input type="text" name="nim" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-400" placeholder="Contoh: 1910114012" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
            <input type="text" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Jurusan</label>
            <input type="text" name="major" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-400" placeholder="Sistem Informasi">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-400">
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-indigo-600 hover:bg-indigo-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Simpan Data
            </button>
            <a href="{{ route('students.index') }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-bold">Batal</a>
        </div>
    </form>
</div>
@endsection