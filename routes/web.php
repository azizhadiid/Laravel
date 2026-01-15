<?php

use App\Http\Controllers\CRUD1\ProductController;
use App\Http\Controllers\CRUD2\BarangsController;
use App\Http\Controllers\CRUD3\StudentController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// // CRUD 1
// Route::get('/products', [ProductController::class, 'index']);
// Route::get('/products/create', [ProductController::class, 'create']);
// Route::post('/products/store', [ProductController::class, 'store']);
// Route::get('/products/edit/{id}', [ProductController::class, 'edit']);
// Route::post('/products/update/{id}', [ProductController::class, 'update']);
// Route::get('/products/delete/{id}', [ProductController::class, 'destroy']);

// CRUD 2
Route::controller(BarangsController::class)->group(function () {
    Route::get('/', 'index')->name('barangs.index');
    Route::get('/create', 'create')->name('barangs.create');
    Route::post('/store', 'store')->name('barangs.store');
    Route::get('/edit/{id}', 'edit')->name('barangs.edit');
    Route::put('/update/{id}', 'update')->name('barangs.update');
    Route::delete('/delete/{id}', 'destroy')->name('barangs.destroy');
});

// CRUD 3
// Route resource ini otomatis membuat route untuk index, create, store, edit, update, destroy
Route::resource('students', StudentController::class);

// CRUD 4
Route::resource('employees', EmployeeController::class);

// 1. READ (Halaman Utama + Form Input)
Route::get('/guestbook', function () {
    $messages = DB::table('guestbooks')
        ->orderBy('id', 'desc')
        ->get();

    return view('guestbook.index', ['messages' => $messages]);
})->name('guestbook.index');

// 2. CREATE (Proses Simpan)
Route::post('/guestbook', function (Request $request) {
    // Validasi input
    $request->validate([
        'visitor_name' => 'required|max:50',
        'message' => 'required',
    ]);

    // Insert Manual (Ingat: Timestamp harus manual kalau tanpa Model)
    DB::table('guestbooks')->insert([
        'visitor_name' => $request->visitor_name,
        'message' => $request->message,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('guestbook.index')->with('success', 'Pesan berhasil dikirim!');
})->name('guestbook.store');

// 3. EDIT (Halaman Edit)
Route::get('/guestbook/{id}/edit', function ($id) {
    $data = DB::table('guestbooks')->where('id', $id)->first();

    // Cek kalau data gak ada
    if (!$data) {
        return abort(404);
    }

    return view('guestbook.edit', ['data' => $data]);
})->name('guestbook.edit');

// 4. UPDATE (Proses Update)
Route::put('/guestbook/{id}', function (Request $request, $id) {
    $request->validate([
        'visitor_name' => 'required|max:50',
        'message' => 'required',
    ]);

    DB::table('guestbooks')->where('id', $id)->update([
        'visitor_name' => $request->visitor_name,
        'message' => $request->message,
        'updated_at' => now(), // Cukup update updated_at saja
    ]);

    return redirect()->route('guestbook.index')->with('success', 'Pesan berhasil diupdate!');
})->name('guestbook.update');

// 5. DELETE (Proses Hapus)
Route::delete('/guestbook/{id}', function ($id) {
    DB::table('guestbooks')->where('id', $id)->delete();

    return redirect()->route('guestbook.index')->with('success', 'Pesan dihapus!');
})->name('guestbook.destroy');

// 1. READ (Tampilkan Data Siswa + Nama Kelasnya)
Route::get('/siswa', function () {
    // MANUAL JOIN:
    // "Ambil data students, gabungkan dengan classrooms,
    // di mana students.classroom_id SAMA DENGAN classrooms.id"
    $students = DB::table('murids')
        ->join('classrooms', 'murids.classroom_id', '=', 'classrooms.id')
        ->select(
            'murids.*',
            'classrooms.name as class_name', // Kita ambil nama kelas sebagai alias
            'classrooms.teacher'
        )
        ->orderBy('murids.id', 'desc')
        ->get();

    return view('siswa.index', ['students' => $students]);
})->name('siswa.index');

// 2. CREATE (Form Tambah - Butuh Data Kelas untuk Dropdown)
Route::get('/siswa/create', function () {
    $classrooms = DB::table('classrooms')->get(); // Ambil semua kelas
    return view('siswa.create', ['classrooms' => $classrooms]);
})->name('siswa.create');

// 3. STORE (Simpan Data)
Route::post('/siswa', function (Request $request) {
    $request->validate([
        'classroom_id' => 'required', // Pastikan ID kelas ada
        'nis' => 'required|numeric|unique:murids,nis',
        'name' => 'required',
    ]);

    DB::table('murids')->insert([
        'classroom_id' => $request->classroom_id,
        'nis' => $request->nis,
        'name' => $request->name,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('siswa.index')->with('success', 'Siswa berhasil didaftarkan');
})->name('siswa.store');

// 4. EDIT (Ambil Data Siswa & Daftar Kelas)
Route::get('/siswa/{id}/edit', function ($id) {
    $student = DB::table('murids')->where('id', $id)->first();
    $classrooms = DB::table('classrooms')->get();

    if (!$student) return abort(404);

    return view('siswa.edit', ['student' => $student, 'classrooms' => $classrooms]);
})->name('siswa.edit');

// 5. UPDATE (Simpan Perubahan)
Route::put('/siswa/{id}', function (Request $request, $id) {
    // Validasi unique nis kecuali punya diri sendiri
    $request->validate([
        'classroom_id' => 'required',
        'nis' => 'required|numeric',
        'name' => 'required',
    ]);

    DB::table('murids')->where('id', $id)->update([
        'classroom_id' => $request->classroom_id,
        'nis' => $request->nis,
        'name' => $request->name,
        'updated_at' => now(),
    ]);

    return redirect()->route('siswa.index')->with('success', 'Data siswa diperbarui');
})->name('siswa.update');

// 6. DELETE (Hapus)
Route::delete('/siswa/{id}', function ($id) {
    DB::table('murids')->where('id', $id)->delete();
    return redirect()->route('siswa.index')->with('success', 'Siswa dihapus');
})->name('siswa.destroy');
