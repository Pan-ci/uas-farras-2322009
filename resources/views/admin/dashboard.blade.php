@extends('layouts.app')

@section('content')
<div class="container">
    @section('header')
        {{ __('Daftar User') }}
    @endsection
    <div class="body-box">
        <div class="container-box p-4 overflow-auto">
            <!-- Tombol untuk menambahkan produk baru -->
            <div class="d-grid">
                <a href="{{ route('users.create') }}" class="btn btn-success">Tambah User Baru</a>
            </div>

            <!-- Menampilkan pesan sukses jika ada -->
            @if(session('success'))
                <div class="alert alert-success mt-2">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>

    @foreach($grouped as $role => $users)
    <div class="body-box">
        <div class="container-box p-4 overflow-auto">
            <div class="d-grid">
                <a class="btn btn-info mb-3">Daftar {{ ucfirst($role) }}</a>
            </div>
            <div class="overflow-auto">
                <!-- Menampilkan tabel daftar produk -->
                <table class="table-light table table-bordered table-striped dark:bg-white">
                    <thead class="bg-gradient">
                        <tr>
                            <th>Nama user</th>
                            <th>Email</th>
                            <th>Role</th>
                            @hasrole('admin')
                            <th>Telepon</th>
                            <th>Alamat</th>
                            @endrole
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <!-- Menggunakan Spatie untuk menampilkan role -->
                            <td>{{ $user->getRoleNames()->implode(', ') }}</td>  <!-- Menampilkan semua role jika lebih dari satu -->
                            @hasrole('admin')
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->adress }}</td>
                            @endrole
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforeach
    <!-- Menampilkan pagination
     $users->links()  -->
</div>
@endsection