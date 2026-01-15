<?php

use App\Http\Controllers\CRUD1\ProductController;
use App\Http\Controllers\CRUD2\BarangsController;
use App\Http\Controllers\CRUD3\StudentController;
use App\Http\Controllers\EmployeeController;
use App\Models\Book;
use App\Models\Category;
use App\Models\Inventaris;
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

// 1. INDEX (Tampilkan Semua)
Route::get('/gudang', function () {
    // Pakai Model, lebih elegan
    $barang = Inventaris::latest()->get();
    return view('gudang.index', compact('barang'));
})->name('gudang.index');

// 2. CREATE (Form Tambah)
Route::get('/gudang/tambah', function () {
    return view('gudang.create');
})->name('gudang.create');

// 3. STORE (Simpan Data)
Route::post('/gudang', function (Request $request) {
    $request->validate([
        'nama_barang' => 'required',
        'stok' => 'required|numeric',
        'kondisi' => 'required',
        'lokasi_rak' => 'required'
    ]);

    // Simpan pakai Model (otomatis created_at terisi)
    Inventaris::create($request->all());

    return redirect()->route('gudang.index')->with('sukses', 'Barang masuk gudang!');
})->name('gudang.store');

// 4. EDIT (Form Edit)
Route::get('/gudang/{id}/edit', function ($id) {
    // Cari data berdasarkan ID, kalau ga ada otomatis 404
    $item = Inventaris::findOrFail($id);
    return view('gudang.edit', compact('item'));
})->name('gudang.edit');

// 5. UPDATE (Simpan Perubahan)
Route::put('/gudang/{id}', function (Request $request, $id) {
    $item = Inventaris::findOrFail($id);

    $item->update($request->all());

    return redirect()->route('gudang.index')->with('sukses', 'Data barang diperbarui!');
})->name('gudang.update');

// 6. DESTROY (Hapus)
Route::delete('/gudang/{id}', function ($id) {
    $item = Inventaris::findOrFail($id);
    $item->delete();

    return redirect()->route('gudang.index')->with('sukses', 'Barang dihapus dari stok.');
})->name('gudang.destroy');

// 1. INDEX (Tampilkan Buku + Nama Kategorinya)
Route::get('/books', function () {
    // Eager Loading: Ambil buku BESERTA data kategorinya
    $books = Book::with('category')->latest()->get();

    return view('books.index', compact('books'));
})->name('books.index');

// 2. CREATE (Form Tambah - Butuh data kategori buat dropdown)
Route::get('/books/create', function () {
    $categories = Category::all();
    return view('books.create', compact('categories'));
})->name('books.create');

// 3. STORE (Simpan)
Route::post('/books', function (Request $request) {
    $request->validate([
        'category_id' => 'required|exists:categories,id', // Validasi FK
        'title' => 'required',
        'author' => 'required',
        'year' => 'required|numeric',
    ]);

    // Simpan pakai Model (Laravel otomatis mapping field)
    Book::create($request->all());

    return redirect()->route('books.index')->with('success', 'Buku baru ditambahkan!');
})->name('books.store');

// 4. EDIT (Form Edit - Load data buku & kategori)
Route::get('/books/{id}/edit', function ($id) {
    $book = Book::findOrFail($id);
    $categories = Category::all();

    return view('books.edit', compact('book', 'categories'));
})->name('books.edit');

// 5. UPDATE (Update Data)
Route::put('/books/{id}', function (Request $request, $id) {
    $book = Book::findOrFail($id);

    $request->validate([
        'category_id' => 'required',
        'title' => 'required',
        'author' => 'required',
        'year' => 'required|numeric',
    ]);

    $book->update($request->all());

    return redirect()->route('books.index')->with('success', 'Data buku diperbarui!');
})->name('books.update');

// 6. DESTROY (Hapus)
Route::delete('/books/{id}', function ($id) {
    $book = Book::findOrFail($id);
    $book->delete();

    return redirect()->route('books.index')->with('success', 'Buku dihapus dari rak.');
})->name('books.destroy');
