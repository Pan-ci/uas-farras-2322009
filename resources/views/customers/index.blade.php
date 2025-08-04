@extends('layouts.app')

@section('content')
<div class="container">
    @section('header')
        {{ __('Daftar Pelanggan') }}
    @endsection
    
    <div class="body-box">
        <div class="container-box p-4 overflow-auto">
            @can('create customer')
            <!-- Tombol untuk menambahkan produk baru -->
            <div class="d-grid">
                <a href="{{ route('customers.create') }}" class="btn btn-success">Tambah Pelanggan Baru</a>
            </div>
            @endcan
            <!-- Menampilkan pesan sukses jika ada -->
            @if(session('success'))
                <div class="mt-2 alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
    @foreach($grouped as $role => $users)
    <div class="body-box">
        <div class="container-box p-4 overflow-auto">
            <div class="d-grid">
                <div class="btn btn-info mb-3">Daftar {{ ucfirst($role) }}</div>
            </div>
            <div class="overflow-auto">
                <!-- Menampilkan tabel daftar produk -->
                <table class="table table-light table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Kustomer</th>
                            <th>Email</th>
                            @hasrole('admin')
                            <th>Telepon</th>
                            <th>Alamat</th>
                            @endrole
                            @canany('edit', 'delete')
                            <th>Aksi</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            @hasrole('admin')
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->adress }}</td>
                            @endrole

                            @canany('edit', 'delete')
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <a href="{{ route('customers.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('customers.destroy', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kustomer ini?')">Hapus</button>
                                    </form>
                                </div>
                            </td>
                            @endcanany
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforeach
    <!-- Menampilkan pagination
    $users->links() -->
</div>
@endsection