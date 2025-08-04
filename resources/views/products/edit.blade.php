@extends('layouts.app')

@section('content')
<div class="container">
    @section('header')
        {{ __('Edit Produk') }}
    @endsection
    <div class="body-box">
        <div class="container-box p-4 max-w-xl">
            <!-- Menampilkan error validasi jika ada -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Menampilkan pesan sukses jika ada -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form untuk mengedit produk -->
            <form method="POST" action="{{ route('products.update', $product->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label text-dark">Nama Produk</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="writer" class="form-label text-dark">Nama Penulis</label>
                    <input type="text" class="form-control" id="writer" name="writer" value="{{ $product->writer }}" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label text-dark">Harga Produk</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label text-dark">Kategori Produk</label>
                    <select class="form-control" id="category_id" name="category_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-2 text-center">
                    <a class="btn btn-secondary" href="{{ route('categories-ed.create', ['product_id' => $product->id]) }}">+ Tambah Kategori</a>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label text-dark">Stok</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}" step="1" required>
                </div>

                <div class="mb-3">
                    <label for="minimum_quantity" class="form-label text-dark">Minimum Stok</label>
                    <input type="number" class="form-control" id="minimum_quantity" name="minimum_quantity" value="{{ $product->minimum_quantity }}" step="1" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection