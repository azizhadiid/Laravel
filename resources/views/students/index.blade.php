@extends('layouts.app2')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-700">Data Mahasiswa</h2>
    <a href="{{ route('students.create') }}" class="bg-indigo-600 hover:bg-indigo-800 text-white font-bold py-2 px-4 rounded shadow">
        + Tambah Mahasiswa
    </a>
</div>

<div class="bg-white shadow-md rounded my-6 overflow-x-auto">
    <table class="min-w-full table-auto">
        <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">NIM</th>
                <th class="py-3 px-6 text-left">Nama</th>
                <th class="py-3 px-6 text-left">Jurusan</th>
                <th class="py-3 px-6 text-left">Email</th>
                <th class="py-3 px-6 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($students as $student)
            <tr class="border-b border-gray-200 hover:bg-gray-50">
                <td class="py-3 px-6 text-left whitespace-nowrap font-bold">{{ $student->nim }}</td>
                <td class="py-3 px-6 text-left">{{ $student->name }}</td>
                <td class="py-3 px-6 text-left">
                    <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs">
                        {{ $student->major }}
                    </span>
                </td>
                <td class="py-3 px-6 text-left">{{ $student->email }}</td>
                <td class="py-3 px-6 text-center flex justify-center gap-2">
                    <a href="{{ route('students.edit', $student->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection