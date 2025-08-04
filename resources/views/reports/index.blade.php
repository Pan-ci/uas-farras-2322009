@extends('layouts.app')

@section('content')
<div>
    @section('header')
        {{ __('Laporan Penjualan Per Hari') }}
    @endsection
    
    <div class="body-box">
        <div class="container-box p-4">
            <!-- Menampilkan pesan sukses jika ada -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="login-form overflow-auto">
                <!-- Tabel transaksi -->
                @foreach($dailySales as $date => $products)
                <table class="table table-light table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Produk</th>
                            <th>Jumlah Terjual</th>
                            <th>Total Penjualan (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalPerHari = 0; @endphp
                        @foreach($products as $productName => $data)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</td>
                                <td>{{ $productName }}</td>
                                <td>{{ $data['quantity'] }}</td>
                                <td>Rp {{ number_format($data['total'], 0, ',', '.') }}</td>
                            </tr>
                            @php $totalPerHari += $data['total']; @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">Total Penjualan Tanggal: {{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</th>
                            <th>Rp {{ number_format($totalPerHari, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
