@extends('layouts.app')

@section('content')
<div class="container">
    @section('header')
        {{ __('Tambah Transaksi Baru') }}
    @endsection
    <div class="body-box">
        <div class="container-box p-4 pt-1">
            <!-- Menampilkan error validasi -->
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('transactions.store') }}">
                
                @csrf
                <div class="pb-2 mb-3 mt-3 border-bottom">
                    <div class="col-md-4">
                        <label class="mb-1">Penjual</label>
                        <input type="text" class="form-control" id="seller_display" readonly value="{{ $seller->name }}" {{ old('seller_name') , $seller->name }}>
                        <input type="hidden" class="form-control" name="seller_id" id="seller_display"  readonly value="{{ $seller->id }}" {{ old('seller_id') , $seller->id }}>
                    </div>
                </div>

                <div class="pb-2 mb-3 border-bottom">
                    <div class="col-md-4">
                        <label for="customer_id" class="form-label text-dark">Nama Pembeli</label>
                        <select class="form-control" id="customer_id" name="customer_id" required>
                            <option value="">-- Pilih Pembeli --</option>
                            <optgroup label="Customer">
                                @foreach($customers as $customer)
                                    <option id="customer-id" value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                            <optgroup label="Regular">
                                @foreach($regulars as $customer)
                                    <option id="regular-id" value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="justify-items-center">
                    <!-- Daftar Produk -->
                    <!-- Produk dalam bentuk tabel -->
                    <div class="border-bottom">
                        <label class="form-label text-dark">Daftar Produk</label>
                        <table class="table table-bordered table-striped" id="tabel">
                            <thead>
                                <tr>
                                    <th class="w-1/2 text-center">Produk</th>
                                    <th class="w-1/6 text-center">Harga</th>
                                    <th class="w-1/6 text-center">Jumlah</th>
                                    <th class="w-1/4 text-center">Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="products-wrapper">
                                <tr class="product-item">
                                    <td class="w-60">
                                        <select class="form-control product-select" name="products[0][product_id]" required>
                                            <option value="">-- Pilih Produk --</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" 
                                                data-price="{{ $product->price }}"
                                                data-stock="{{ $product->quantity }}" 
                                                data-minimum="{{ $product->minimum_quantity }}">
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="price" readonly>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control quantity-input" name="products[0][quantity]" min="1" required>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control subtotal-input" name="products[0][subtotal]" readonly>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger remove-product">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3 text-start mb-3">
                        <button type="button" id="add-product" class="btn btn-secondary">+ Tambah Produk</button>
                    </div>

                    <div class="d-flex justify-center gap-2 align-items-center pb-1 mb-3 border-bottom">    
                        <div class="mb-3 text-center">
                            <label class="mb-1">Total</label>
                            <input type="text" class="form-control" id="total_price_display" readonly>
                            <input type="hidden" name="total_price" id="total_price">
                        </div>
                    </div>
                    <div id="regular" class="justify-center gap-2 align-items-center pb-1 mb-3 border-bottom border-top">  
                        <!-- Total Harga -->
                        <div class="mb-3 mt-3 text-center">
                            <label class="mb-1">Diskon 5%</label>
                            <input type="text" class="form-control" id="discount" readonly>
                            <!---->
                            <input type="hidden" name="discount" id="discount_save">
                        </div>
                    </div>
                    <div class="mb-3 text-center">
                        <label class="mb-1">Total Harga</label>
                        <input type="text" class="form-control" id="final_price_display" readonly>
                        <input type="hidden" name="final_price" id="final_price">
                    </div>
                    <div class="d-flex justify-center gap-2 align-items-center pb-1 mb-3 border-bottom">
                        <!-- Tanggal dan Jam Transaksi -->
                        <div class="mb-3 text-center">
                            <label for="transaction_date" class="form-label mb-1">Tanggal Transaksi</label>
                            <input type="datetime-local" class="form-control" id="transaction_date" name="transaction_date" readonly required>
                        </div>
                    </div>
                    </div>

                    <div class="d-none d-flex justify-center gap-2 align-items-center pb-1 mb-3 border-bottom">
                        <!-- Tanggal dan Jam Transaksi -->
                        <div class="mb-3 text-center">
                            <label for="is_returned" class="form-label text-dark">Dikembalikan</label>
                            <select class="form-control" id="is_returned" name="is_returned" required>
                                <option id="false" value="false">Tidak</option>
                                <option id="true" value="true">Ya</option>
                            </select>
                        </div>
                    </div>

                <div id="returned" class="justify-items-center">
                    <div class="pb-1 mb-3 border-bottom">  
                        <!-- Tanggal dan Jam Transaksi -->
                        <div class="mb-3 text-center">
                            <label for="payment_fake" class="form-label mb-3 text-dark">Pembayaran</label>
                            <input type="text" class="form-control quantity-input" id="payment_fake" name="payment_fake">
                            <input type="hidden" name="payment" id="payment">
                        </div>
                    </div>

                    <div class="pb-1 mb-3 border-bottom">  
                        <!-- Tanggal dan Jam Transaksi -->
                        <div class="mb-3 text-center">
                            <label for="change_display" class="form-label mb-3 text-dark">Kembalian</label>
                            <input type="text" class="form-control subtotal-input" id="change_display" readonly>
                            <input type="hidden" name="change" id="change">

                            <input type="hidden" name="profit" id="profit">
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@once
    @vite('resources/js/components/create-transaction.js')
@endonce