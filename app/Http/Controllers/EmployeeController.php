<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        // with('department') adalah "Eager Loading"
        // Ini teknik optimasi agar query database lebih ringan saat ambil data relasi
        $employees = Employee::with('department')->latest()->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        // Kita butuh data departemen untuk ditampilkan di dropdown (select option)
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required',
            'name' => 'required',
            'position' => 'required',
            'salary' => 'required|numeric'
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil direkrut!');
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        return view('employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'department_id' => 'required',
            'name' => 'required',
            'salary' => 'numeric'
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Data karyawan diperbarui!');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Karyawan dihapus.');
    }
}
