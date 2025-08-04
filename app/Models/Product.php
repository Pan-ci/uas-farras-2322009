<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // kolom yang bisa diisi massal
    protected $fillable = [
        'name', 
        'price', 
        'category_id', 
        'category_name', 
        'writer', 
        'quantity', 
        'minimum_quantity'
    ];

    // relasi ke tabel categories
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // relasi ke tabel categories
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'transaction_product')
                    ->withPivot(['product_name', 'product_price','quantity', 'subtotal'])  // Mengambil data dari pivot table
                    ->withTimestamps();
    }
}
