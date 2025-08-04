<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransactionHistory extends Model
{
    //
    // kolom yang bisa diisi massal
    protected $table = 'transaction_history';
    
    protected $fillable = [
        'transaction_id',
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

    public function transaction()
    {
        // Jika transaksi hanya melibatkan satu penjual
        return $this->belongsTo(Transaction::class, 'id');
    }

    public function transactionHistoryProduct()
    {
        return $this->hasMany(TransactionHistoryProduct::class);
    }

    // Pada model User
    public function deleteWithTransaction()
    {
        DB::transaction(function () {
            // Hapus profile terkait
            $this->profile()->delete();
            // Hapus user
            $this->delete();
        });
    }
}
