<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Carbon\Carbon;

class Transaction extends Model
{
    // kolom yang bisa diisi massal
    protected $fillable = [
        'seller_id',
        'seller_name',
        'seller_email',
        'customer_id',
        'customer_name',
        'customer_email',
        'transaction_date',
        'discount',
        'total_price',
        'final_price',
        'payment',
        'change',
        'profit',
    ];
    // protected $dates = ['transaction_date']; // Menambahkan kolom transaction_date sebagai tanggal

    public function products()
    {
        return $this->belongsToMany(Product::class, 'transaction_product')
                    ->withPivot(['product_name', 'product_price','quantity', 'subtotal'])  // Mengambil data dari pivot table
                    ->withTimestamps();
    }

    public function seller()
    {
        // Jika transaksi hanya melibatkan satu penjual
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function customer()
    {
        // Jika transaksi hanya melibatkan satu penjual
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function scopeForCustomer($query, $userId)
    {
        return $query->where('customer_id', $userId);
    }
}
