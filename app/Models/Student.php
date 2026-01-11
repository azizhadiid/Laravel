<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Masukkan nama kolom tabel di sini agar bisa disimpan menggunakan create/update
    protected $fillable = [
        'nim',
        'name',
        'major',
        'email'
    ];
}
