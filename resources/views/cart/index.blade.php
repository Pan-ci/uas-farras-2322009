@extends('layouts.app')

@section('content')
<div class="container">
    @section('header')
        {{ __('Daftar Cart Pelanggan') }}
    @endsection
    <!-- Menampilkan pesan sukses jika ada -->
    @if(session('success'))
    <div class="body-box">
        <div class="container-box px-3 overflow-auto alert alert-success">
            {{ session('success') }}
        </div>
    </div>
    @endif
    <!-- Menampilkan pesan eror jika ada -->
    @if (session('error'))
    <div class="body-box">
        <div class="container-box px-3 overflow-auto alert alert-danger">
            {{ session('error') }}
        </div>
    </div>
    @endif
    @if(session('info'))
    <div class="body-box">
        <div class="container-box overflow-auto alert alert-info">
            {{ session('info') }}
        </div>
    </div>
    @endif
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <a href="{{ route('cart.process', $user->id) }}" class="btn btn-warning">Proses</a>
                                    <a href="{{ route('cart.cancel', $user->id) }}" class="btn btn-danger">Cancel</a>
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
    $users->links() -->
</div>
@endsection