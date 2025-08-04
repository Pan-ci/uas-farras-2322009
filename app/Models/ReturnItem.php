<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnItem extends Model
{
    //
    protected $fillable = [
        'return_id',
        'product_id',
        'product_name',
        'product_price',
        'quantity',
        'subtotal',
    ];

    public function returns()
    {
        return $this->belongsTo(Returns::class);
    }
}
