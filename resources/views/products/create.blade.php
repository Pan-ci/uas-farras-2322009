@extends('layouts.app')

@section('content')
<div class="container">
    @section('header')
        {{ __('Tambah Produk Baru') }}
    @endsection

    <div class="body-box">
        <div class="container-box p-4 max-w-xl">
            {{-- Tampilkan pesan error validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div>
                <form method="POST" action="{{ route('products.store') }}">
                    @csrf

                    {{-- Nama Produk --}}
                    <div class="mb-3">
                        <label for="name" class="form-label text-dark">Nama Produk</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="writer" class="form-label text-dark">Nama Penulis</label>
                        <input type="text" class="form-control" id="writer" name="writer" value="{{ old('writer') }}" required>
                    </div>

                    {{-- Harga Produk --}}
                    <div class="mb-3">
                        <label for="price" class="form-label text-dark">Harga Produk</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" step="0.01" required>
                    </div>

                    {{-- Kategori Produk --}}
                    <div class="mb-4">
                        <label for="category_id" class="form-label text-dark">Kategori Produk</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-2 text-center">
                        <a class="btn btn-secondary" href="{{ route('categories-cat.create') }}">+ Tambah Kategori</a>
                    </div>
                    
                    <div class="mb-3">
                        <label for="quantity" class="form-label text-dark">Stok</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}" step="1" required>
                    </div>

                    <div class="mb-3">
                        <label for="minimum_quantity" class="form-label text-dark">Minimum Stok</label>
                        <input type="number" class="form-control" id="minimum_quantity" name="minimum_quantity" value="{{ old('minimum_quantity') }}" step="1" required>
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="mt-2 text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
