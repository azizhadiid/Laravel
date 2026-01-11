<?php

namespace App\Http\Controllers\CRUD3;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data mahasiswa
        $students = Student::latest()->get();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi sederhana (opsional tapi disarankan)
        $request->validate([
            'nim' => 'required',
            'name' => 'required',
            'major' => 'required',
            'email' => 'required|email'
        ]);

        // Simpan data (Otomatis mapping field dari form ke database)
        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        // Laravel otomatis mencarikan data student berdasarkan ID (Route Model Binding)
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        // Update data
        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        // Hapus data
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Data dihapus');
    }
}
