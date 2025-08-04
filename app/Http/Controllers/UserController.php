<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role; // Import Role dari Spatie
use Spatie\Permission\Models\Permission;
use App\Rules\UniqueEmail;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function __construct()
    {
        // Middleware untuk memastikan hanya admin yang bisa mengakses halaman ini
        // $this->middleware('can:view-users');
    }

    public function index()
    {
        // Daftar role yang ingin difilter
        $filter = ['buyer', 'regular'];

        // Ambil semua user dengan role, paginasi 10 per halaman
        $users = User::with('roles')->paginate(10);

        // Ambil koleksi dari paginated users
        $filteredUsers = $users->getCollection()->filter(function ($user) use ($filter) {
            return $user->getRoleNames()->intersect($filter)->isEmpty();
        });

        // Group berdasarkan role (selain yang difilter)
        $grouped = $filteredUsers->groupBy(function ($user) use ($filter) {
            return $user->getRoleNames()
                        ->reject(function ($role) use ($filter) {
                            return in_array($role, $filter);
                        })->first(); // bisa juga ->implode(', ') jika banyak role
        });

        // Ganti isi koleksi paginated dengan filtered collection
        $users->setCollection($filteredUsers);

        return view('admin.dashboard', compact('users', 'grouped'));
    }

    // Menampilkan form untuk membuat pengguna baru (Create)
    public function create()
    {
        // Mendapatkan semua role yang tersedia
        $roles = Role::all();

        // Return view untuk menampilkan form pendaftaran user baru
        return view('admin.create', compact('roles'));
    }

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

        // Ambil role, default ke 'buyer' jika kosong
        $role = $request->filled('role') ? $request->role : 'buyer';

        // Hash password
        $hashedPassword = bcrypt($request->password);
        // Selain buyer, simpan ke tabel users
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPassword,
            'adress' => $request->adress,
            'phone' => $request->phone,
        ]);

        $user->assignRole($role);
        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit pengguna (Edit)
    public function edit($id)
    {
        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Mendapatkan semua role yang tersedia
        $roles = Role::all();

        // Return view untuk mengedit data pengguna
        return view('admin.edit', compact('user', 'roles'));
    }

    // Memperbarui data pengguna di database (Update)
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|exists:roles,name',  // Validasi role harus ada di tabel roles
            'email' => 'required|email|unique:users,email,' . $id, // Pastikan email unik kecuali untuk pengguna yang sedang diedit
            'password' => ['nullable', 'confirmed', Password::defaults()],  // Password hanya boleh diubah jika diisi
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
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

        // Update role
        $user->syncRoles([$request->role]);  // Sinkronkan role baru

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diupdate.');
    }

    // Menghapus pengguna dari database (Delete)
    public function destroy($id)
    {
        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Hapus pengguna dari database
        $user->delete();

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}


