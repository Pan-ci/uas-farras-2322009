@extends('layouts.app')

@section('content')
<div>
    @section('header')
        {{ __('Daftar Transaksi') }}
    @endsection
    
    <div class="body-box">
        <div class="container-box p-4">

            <div class="login-form overflow-auto">
                <!-- Tabel transaksi -->
                <table class="table table-light table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Nama Penjual</th>
                            <th>Nama Pembeli</th>
                            <th class="produk-dibeli-col">Produk Dibeli</th>
                            <th class="total-harga-col">Total</th>
                            <th class="total-harga-col">Diskon</th>
                            <th class="total-harga-col">Total Harga</th>
                            <th class="total-harga-col">Pembayaran</th>
                            <th class="total-harga-col">Kembalian</th>
                            <th class="tanggal-col">Tanggal Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            <td>#{{ $transaction->id }}</td>
                            <td>{{ $transaction->seller->name }}</td>
                            <td>{{ $transaction->customer_name }}</td>
                            <td class="produk-dibeli-col">
                                <div class="mb-0">
                                    @foreach($transaction->products as $product)
                                        <div>
                                            {{ $product->pivot->product_name ?? $product->name }} 
                                            (x{{ $product->pivot->quantity }}) - 
                                            Rp {{ number_format($product->pivot->subtotal, 0, ',', '.') }}
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="total-harga-col">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                            <td class="total-harga-col">Rp {{ number_format($transaction->discount, 0, ',', '.') }}</td>
                            <td class="total-harga-col">Rp {{ number_format($transaction->final_price, 0, ',', '.') }}</td>
                            <td class="total-harga-col">Rp {{ number_format($transaction->payment, 0, ',', '.') }}</td>
                            <td class="total-harga-col">Rp {{ number_format($transaction->change, 0, ',', '.') }}</td>
                            <td class="tanggal-col">{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d-m-Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Pagination -->
    <div class="mt-3">
        {{ $transactions->links() }}
    </div>
</div>
@endsection
