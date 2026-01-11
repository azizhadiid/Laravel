<?php

use App\Http\Controllers\CRUD1\ProductController;
use App\Http\Controllers\CRUD2\BarangsController;
use App\Http\Controllers\CRUD3\StudentController;
use App\Http\Controllers\EmployeeController;
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
