@extends('layouts.app')

@section('content')
<div class="container">
    @section('header')
        {{ __('Tambah Kategori Baru') }}
    @endsection

    <div class="body-box">
        <div class="container-box p-4 pt-1">
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

            <!-- Form untuk menambahkan produk baru -->
            <form method="POST" action="{{ route('categories-ed.store') }}">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label text-dark">Nama Kategori</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    <input type="hidden" name="product_id" value="{{ request('product_id') }}">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection