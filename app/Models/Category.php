<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // kolom yang boleh diisi secara massal
    protected $fillable = ['name'];

    // relasi ke tabel products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
