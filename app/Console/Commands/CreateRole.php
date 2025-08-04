<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class CreateRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:create {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new role';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $roleName = $this->argument('name');

        try {
            // Mulai transaksi
            DB::beginTransaction();

            // Cek apakah role sudah ada
            if (Role::where('name', $roleName)->exists()) {
                $this->info('Role sudah ada.');
                return;
            }

            // Buat role baru
            Role::create(['name' => $roleName]);

            // Commit transaksi
            DB::commit();

            $this->info('Role berhasil dibuat.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();

            // Tampilkan pesan error
            $this->error('Gagal membuat role: ' . $e->getMessage());
        }
    }
}
