<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateProfit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-profit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hitung profit bulanan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $this->info('Menghitung total profit bulan ini...');

        $bulanIni = now()->format('Y-m');
        
        // Hitung total profit bulan ini
        $total = DB::table('transaction_history')
            ->whereRaw("DATE_FORMAT(updated_at, '%Y-%m') = ?", [$bulanIni])
            ->sum('profit');

        // Cek apakah laporan sudah ada
        $sudahAda = DB::table('profit')->where('bulan', $bulanIni)->exists();

        if ($sudahAda) {
            $this->info("Laporan untuk $bulanIni sudah ada.");
            return;
        }

        DB::table('profit')->insert([
            'bulan' => $bulanIni,
            'total_profit' => $total,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $this->info("Laporan profit untuk bulan $bulanIni telah disimpan: $total");
    }
}
