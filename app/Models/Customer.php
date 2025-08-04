<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    // kolom yang boleh diisi secara massak
    protected $fillable = [ 'name',
                            'phone',
                            'email',
                            'password',
                            'adress',
                            ];

    // relasi ke tabel transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
