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

            <form method="POST" action="{{ route('transaction.store-from-cart') }}">
                
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
                        <label class="mb-1">Pembeli</label>
                        <input type="text" id="customer-role" class="form-control" data-role="{{ $slugCustomerRoles[0] ?? '' }}"
                        readonly value="{{ old('customer_name', $customer->name) }}">
                        <input type="hidden" class="form-control" name="customer_id" id="customer_id" value="{{ $customer->id }}" {{ old('customer_id') , $customer->id }}>
                    </div>
                </div>

                <div class="justify-items-center">
                    <!-- Daftar Produk -->
                    <!-- Produk dalam bentuk tabel -->
                    <div class="pb-2 mb-3 border-bottom">
                        <label class="form-label text-dark">Keranjang Pembeli</label>
                        <div class="overflow-auto">
                            <table border="1" cellpadding="5" cellspacing="0" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="w-1/2 text-center">Produk</th>
                                        <th class="w-1/6 text-center">Harga</th>
                                        <th class="w-1/6 text-center">Jumlah</th>
                                        <th class="w-1/4 text-center">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="customer-cart-list">
                                    @foreach($cartItems as $cartItem)
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" value="{{ $cartItem->product->name }}" readonly>
                                            <input type="hidden" name="product_id" value="{{ $cartItem->product->id }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" value="{{ number_format($cartItem->product->price, 0, ',', '.') }}" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="quantity" value="{{ $cartItem->quantity }}" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" readonly 
                                                value="{{ number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') }}">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="justify-center gap-2 align-items-center pb-1 mb-3 border-bottom border-top">
                        <div class="d-flex justify-center gap-2 align-items-center pb-1 mb-3 border-bottom">    
                            <div class="mb-3 text-center">
                                <label class="mb-1">Total</label>
                                <input type="text" class="form-control" id="total_price_display" value="{{ number_format($total, 0, ',', '.') }}" readonly>
                                <input type="hidden" name="total_price" id="total_price" value="{{ $total }}">
                            </div>
                        </div>
                        <!-- Total Harga -->
                        <div class="mb-3 mt-3 text-center">
                            <label class="mb-1">Diskon 5% (khusus regular)</label>
                            <input type="text" class="form-control" id="discount" readonly 
                            value="@if($slugCustomerRoles[0] === 'regular'){{ number_format($total * 0.05, 0, ',', '.') }} @else 0 @endif">
                            <input type="hidden" name="discount" id="discount_save" value="@if($slugCustomerRoles[0] === 'regular'){{ $total * 0.05 }} @else 0 @endif">
                        </div>
                        <div class="mb-3 text-center">
                            <label class="mb-1">Total Harga</label>
                            <input type="text" class="form-control" id="final_price_display" readonly 
                                value="{{ number_format($total - ($slugCustomerRoles[0] === 'regular' ? ($total * 0.05) : 0), 0, ',', '.') }}">
                            <input type="hidden" name="final_price" id="final_price" 
                                value="{{ $total - ($slugCustomerRoles[0] === 'regular' ? ($total * 0.05) : 0) }}">
                        </div>
                    </div>
                    <div class="d-flex justify-center gap-2 align-items-center pb-1 mb-3 border-bottom">
                        <!-- Tanggal dan Jam Transaksi -->
                        <div class="mb-3 text-center">
                            <label for="transaction_date" class="form-label mb-1">Tanggal Transaksi</label>
                            <input type="datetime-local" class="form-control" id="transaction_date" name="transaction_date" readonly required>
                        </div>
                    </div>
                    </div>

                <div class="justify-items-center">
                    <div class="pb-1 mb-3 border-bottom">  
                        <!-- Tanggal dan Jam Transaksi -->
                        <div class="mb-3 text-center">
                            <label for="payment" class="form-label mb-3 text-dark">Pembayaran</label>
                            <input type="text" class="form-control quantity-input" id="payment_fake">
                            <input type="hidden" name="payment" id="payment">
                        </div>
                    </div>

                    <div class="pb-1 mb-3 border-bottom">  
                        <!-- Tanggal dan Jam Transaksi -->
                        <div class="mb-3 text-center">
                            <label for="change" class="form-label mb-3 text-dark">Kembalian</label>
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
    @vite('resources/js/components/create-transaction-cart.js')
@endonce