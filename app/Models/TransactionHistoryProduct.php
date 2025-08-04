<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionHistoryProduct extends Model
{
    //
    protected $table = 'transaction_history_product'; // nama tabel pivot kamu

    protected $fillable = [
        'transaction_history_id',
        'product_id',
        'product_name',
        'product_price',
        'quantity',
        'subtotal',
    ];

    public function transactionHistory()
    {
        return $this->belongsTo(TransactionHistory::class);
    }
}
