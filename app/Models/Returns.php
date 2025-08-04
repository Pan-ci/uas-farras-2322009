<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    //
    protected $fillable = [
        'transaction_id',
        'employee_id',
        'employee_name',
        'employee_email',
        'customer_id',
        'customer_name',
        'customer_email',
        'returned_at',
        'total_price',
        'discount',
        'final_price',
        'profit',
    ];

    public function returnItem()
    {
        return $this->belongsToMany(ReturnItem::class, 'return_items')
                    ->withPivot(['product_id','product_name','quantity'])  // Mengambil data dari pivot table
                    ->withTimestamps();
    }

    public function employee()
    {
        // Jika transaksi hanya melibatkan satu penjual
        return $this->belongsTo(User::class, 'employee_id');
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
