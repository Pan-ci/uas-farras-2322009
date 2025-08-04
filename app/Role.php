<?php

namespace App;

enum Role: string
{
    case Admin = 'admin';
    case Seller = 'seller';
    case Buyer = 'buyer';

    // Opsional: nama yang bisa ditampilkan di dropdown
    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Admin',
            self::Seller => 'Penjual',
            self::Buyer => 'Pembeli',
        };
    }
}