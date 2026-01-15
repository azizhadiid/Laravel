<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Satu Kategori punya BANYAK Buku
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
