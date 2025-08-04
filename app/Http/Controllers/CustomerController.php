<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules\Password;
use App\Rules\UniqueEmail;

class CustomerController extends Controller
{
    // Menampilkan daftar pelanggan (Read)
    public function index()
    {
        // Mengambil semua data pelanggan dan mem-paginate 10 data per halaman
        $users = User::with('roles')->paginate(10);

        // Filter: hanya user yang TIDAK memiliki role 'admin' atau 'seller'
        $filteredUsers = $users->filter(function ($user) {
            return !$user->getRoleNames()->intersect(['admin', 'seller'])->isNotEmpty();
        });

        // Group berdasarkan role (selain admin & seller)
        $grouped = $filteredUsers->groupBy(function ($user) {
            // Ambil semua role kecuali 'admin' dan 'seller'
            return $user->getRoleNames()
                        ->reject(function ($role) {
                            return in_array($role, ['admin', 'seller']);
                        })->first(); // atau ->implode(', ') kalau ada multi-role
        });

        // Return view dengan data pelanggan
        return view('customers.index', compact('grouped'));
    }

    // Menampilkan form untuk membuat pelanggan baru (Create)
    public function create()
    {
        // Return view untuk menampilkan form pendaftaran pelanggan baru
        return view('customers.create');
    }

    // Menyimpan data pelanggan baru ke database (Store)
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => ['required', 'email', new UniqueEmail], // Custom rule
            'password' => ['required', 'confirmed', Password::defaults()],
            'role' => 'nullable|exists:roles,name', // Boleh kosong, tapi kalau ada harus valid
            'adress' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'adress' => $request->adress,
            'phone' => $request->phone,
        ]);

        $role = Role::findByName('buyer');
        $user->assignRole($role);

        // Redirect ke halaman daftar pelanggan dengan pesan sukses
        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit pelanggan (Edit)
    public function edit($id)
    {
        // Cari pelanggan berdasarkan ID
        $customer = User::findOrFail($id);

        // Return view untuk mengedit data pelanggan
        return view('customers.edit', compact('customer'));
    }

    // Memperbarui data pelanggan di database (Update)
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255', // Validasi role harus ada di tabel roles
            'email' => 'required|email|unique:users,email,' . $id, // Pastikan email unik kecuali untuk pengguna yang sedang diedit
            'password' => ['nullable', 'confirmed', Password::defaults()],  // Password hanya boleh diubah jika diisi
            'phone' => 'nullable|string|max:20',
            'adress' => 'nullable|string|max:255',
        ]);

        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Jika password diisi, hash dan update
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);  // Hashing password baru
        }

        // Update data pengguna di database
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $user->password,
            'adress' => $request->adress,
            'phone' => $request->phone,
        ]);

        // Redirect ke halaman daftar pelanggan dengan pesan sukses
        return redirect()->route('customers.index')->with('success', 'Data pelanggan berhasil diupdate.');
    }

    // Menghapus pelanggan dari database (Delete)
    public function destroy($id)
    {
        // Cari pelanggan berdasarkan ID
        $customer = User::findOrFail($id);

        // Hapus pelanggan dari database
        $customer->delete();

        // Redirect ke halaman daftar pelanggan dengan pesan sukses
        return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
