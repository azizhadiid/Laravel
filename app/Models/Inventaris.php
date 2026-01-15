<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    // PENTING: Karena nama tabelnya 'inventaris' (bukan bahasa inggris),
    // kita harus definisikan secara manual.
    protected $table = 'inventaris';

    protected $fillable = [
        'nama_barang',
        'stok',
        'kondisi',
        'lokasi_rak'
    ];
}
