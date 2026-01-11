@extends('layouts.app2')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Daftar Karyawan</h2>
    <a href="{{ route('employees.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded shadow transition duration-300">
        + Tambah Karyawan
    </a>
</div>

<div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead>
            <tr class="bg-gray-800 text-white text-left text-xs uppercase font-semibold tracking-wider">
                <th class="px-5 py-3">Nama</th>
                <th class="px-5 py-3">Departemen</th>
                <th class="px-5 py-3">Jabatan</th>
                <th class="px-5 py-3">Gaji</th>
                <th class="px-5 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @foreach($employees as $emp)
            <tr class="border-b border-gray-200 hover:bg-gray-50">
                <td class="px-5 py-5 bg-white text-sm font-bold">
                    {{ $emp->name }}
                </td>
                <td class="px-5 py-5 bg-white text-sm">
                    <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full font-semibold text-xs">
                        {{ $emp->department->name }} 
                    </span>
                    <div class="text-xs text-gray-400 mt-1">{{ $emp->department->location }}</div>
                </td>
                <td class="px-5 py-5 bg-white text-sm">
                    {{ $emp->position }}
                </td>
                <td class="px-5 py-5 bg-white text-sm font-mono">
                    Rp {{ number_format($emp->salary, 0, ',', '.') }}
                </td>
                <td class="px-5 py-5 bg-white text-sm text-center flex justify-center gap-3">
                    <a href="{{ route('employees.edit', $emp->id) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                    <form action="{{ route('employees.destroy', $emp->id) }}" method="POST" onsubmit="return confirm('Pecat karyawan ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:text-red-900">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection