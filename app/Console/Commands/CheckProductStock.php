<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class CheckProductStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cek stok, dan beri peringatan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = Product::where('quantity', '<=', 'minimum_quantity')->get();

        foreach ($products as $product) {
            // Logika pengiriman notifikasi atau penyimpanan data peringatan
            // Contoh: kirim email, simpan ke database, dsb.
            \Log::warning("Stok produk {$product->name} sudah mencapai minimum.");
        }

        $this->info('Pengecekan stok produk selesai.');
    }
}
