<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'author', 'year'];

    // Satu Buku MILIK (belongsTo) satu Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
