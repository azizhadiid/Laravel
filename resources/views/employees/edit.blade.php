@extends('layouts.app2')

@section('content')
<div class="w-full max-w-lg mx-auto bg-white p-8 rounded-lg shadow-xl">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Edit Data Karyawan</h2>

    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
            <input type="text" name="name" value="{{ $employee->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-yellow-200" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Departemen</label>
            <div class="relative">
                <select name="department_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ $employee->department_id == $dept->id ? 'selected' : '' }}>
                            {{ $dept->name }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Jabatan</label>
            <input type="text" name="position" value="{{ $employee->position }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-yellow-200" required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Gaji (Rp)</label>
            <input type="number" name="salary" value="{{ $employee->salary }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:ring-yellow-200" required>
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-yellow-600 hover:bg-yellow-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition" type="submit">
                Update
            </button>
            <a href="{{ route('employees.index') }}" class="text-gray-500 hover:text-gray-800">Batal</a>
        </div>
    </form>
</div>
@endsection