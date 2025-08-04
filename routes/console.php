<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Carbon\Carbon;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('role:creat {name}', function ($roleName) {
    // Logika untuk membuat role sesuai argumen
    $this->info("Role '{$roleName}' telah dibuat.");
})->purpose('Create a new role');

// nanti di run di server
Schedule::command('app:evaluate-monthly-purchases')->monthlyOn(Carbon::now()->endOfMonth()->day, '23:55');
Schedule::command('app:generate-profit')->monthlyOn(Carbon::now()->endOfMonth()->day, '23:55');
// Jalankan setiap jam, bisa disesuaikan
Schedule::command('stock')->everyMinute();

/*app:generate-profit
Selain everyHour(), 
Laravel menyediakan beberapa opsi lain 
untuk menjadwalkan tugas. 
Beberapa opsi yang umum digunakan adalah 
everyMinute(), everyTwoMinutes(), everyFiveMinutes(), 
everyTenMinutes, everyThirtyMinutes, dailyAt(), 
twiceDaily(), weekly(), monthly(), yearly(), dan cron().*/
