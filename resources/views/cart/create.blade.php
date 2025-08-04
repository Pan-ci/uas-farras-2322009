@extends('layouts.app')

@section('content')
<div class="container">
    @section('header')
        {{ __('Keranjang') }}
    @endsection
    <div class="body-box">
        <div class="container-box p-4 overflow-auto">
        <!-- Menampilkan pesan sukses jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @foreach(auth()->user()->unreadNotifications as $notification)
            <div class="alert alert-success">
                {{ $notification->data['message'] }}
                {{ $notification->created_at->diffForHumans() }}
            </div>
        @endforeach
        <!-- auth()->user()->unreadNotifications->markAsRead(); -->
            <div id="alert-box" class="alert d-none" role="alert"></div>
            <div class="d-grid">
                <div class="btn btn-success mb-3">Keranjang</div>
            </div>
            <div class="overflow-auto">
                <!-- Menampilkan tabel daftar produk -->
                <table border="1" cellpadding="5" cellspacing="0" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="cart-list"></tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="body-box">
        <div class="container-box p-4 overflow-auto">
            <div class="d-grid">
                <a class="btn btn-success mb-3">Produk</a>
            </div>
            <div class="overflow-auto">
                <!-- Menampilkan tabel daftar produk -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th class="lg:w-1/6">Penulis</th>
                            <th class="lg:w-1/6">Harga</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Tambah Ke Keranjang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->writer }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->quantity - $product->minimum_quantity }}</td>
                            <th>
                                <button class="add-cart btn btn-secondary btn-sm" data-id="{{ $product->id }}">
                                    Tambah
                                </button>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@once
    @vite('resources/js/components/create-cart.js')
@endonce
