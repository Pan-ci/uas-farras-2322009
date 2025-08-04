@extends('layouts.app')

@section('content')
<div class="container">
    @section('header')
        {{ __('Daftar Transaksi') }}
    @endsection
    
    <div class="body-box">
        <div class="container-box p-4">
            @can('create transaction')
                <!-- Tombol untuk menambahkan transaksi baru -->
                <div class="d-grid">
                    <a href="{{ route('transactions.create') }}" class="btn btn-success mb-3">Tambah Transaksi Baru</a>
                </div>
            @endcan

            <!-- Menampilkan pesan sukses jika ada -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="login-form overflow-auto">
                <!-- Tabel transaksi -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Nama Penjual</th>
                            <th>Nama Pembeli</th>
                            <th>Produk Dibeli</th>
                            <th>Total Harga</th>
                            <th>Tanggal Transaksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            <td>#{{ $transaction->id }}</td>
                            <td>{{ $transaction->seller->name }}</td>
                            <td>{{ $transaction->customer_name }}</td>
                            <td>
                                <ul class="mb-0">
                                    @foreach($transaction->products as $product)
                                        <li>{{ $product->name }} (x{{ $product->pivot->quantity }}) - Rp {{ number_format($product->pivot->subtotal, 0, ',', '.') }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d-m-Y') }}</td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    @canany(['delete'])

                                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    @endcanany

                                    <a href="{{ route('transactions.receipt', $transaction->id) }}" class="btn btn-info btn-sm">Cetak Struk</a>
                                </div>
                            </td>
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
