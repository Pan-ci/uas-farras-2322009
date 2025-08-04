@extends('layouts.app')

@section('content')
<div class="container">
    @section('header')
        {{ __('Daftar Produk') }}
    @endsection
    <!-- Tombol untuk menambahkan produk baru -->
    @canany('create')
    <div class="body-box">
        <div class="container-box p-4 overflow-auto">
            <div class="d-grid">
                <a href="{{ route('products.create') }}" class="btn btn-success">Tambah Produk Baru</a>
            </div>
        </div>
    </div>
    @endcanany
    <!-- Menampilkan pesan sukses jika ada -->
    @if(session('success'))
    <div class="body-box">
        <div class="container-box p-4 overflow-auto alert alert-success mt-2">
            {{ session('success') }}
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="body-box">
        <div class="container-box p-4 overflow-auto alert alert-warning mt-2">
            {{ session('error') }}
        </div>
    </div>
    @endif
    @foreach ($productsGrouped as $categoryName => $products)
    <div class="body-box">
        <div class="container-box p-4 overflow-auto">
            <div class="d-grid">
                <a class="btn btn-success mb-3">{{ $categoryName }}</a>
            </div>
            <div class="overflow-auto">
                <!-- Menampilkan tabel daftar produk -->
                <table class="table table-light table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th class="lg:w-1/6">Penulis</th>
                            <th class="lg:w-1/6">Harga</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Min Stok</th>
                            @canany('edit', 'delete')
                            <th class="lg:w-1/5">Aksi</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->writer }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->minimum_quantity }}</td>
                            @canany('edit', 'delete')
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
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
        </div>
    </div>
    <!-- Menampilkan pagination 
     $products->links()-->
</div>
@endsection