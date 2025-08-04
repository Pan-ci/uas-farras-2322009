@extends('layouts.app')

@section('content')
<div class="container">
    @section('header')
        {{ __('Daftar Kategori') }}
    @endsection
    <div class="body-box">
        <div class="container-box p-4">
            @can('create category')
            <!-- Tombol untuk menambahkan produk baru -->
            <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">Tambah Kategori Baru</a>
            @endcan

            <!-- Menampilkan pesan sukses jika ada -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-auto">
                <!-- Menampilkan tabel daftar produk -->
                <table class="table table-light table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            @canany('edit', 'delete')
                            <th>Aksi</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>

                            @canany('edit', 'delete')
                            <td>
                                <div class="flex gap-2">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
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
    <!-- Menampilkan pagination -->
    {{ $categories->links() }}
</div>
@endsection