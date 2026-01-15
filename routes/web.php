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
