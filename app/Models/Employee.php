<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id', // Penting agar foreign key bisa diisi
        'name',
        'position',
        'salary'
    ];

    // Relasi: Karyawan adalah MILIK (belongsTo) satu departemen
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
