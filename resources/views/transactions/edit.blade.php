@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Produk</h1>

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

    <!-- Form untuk mengedit produk -->
        <!-- Form untuk mengedit transaksi -->
    <form method="POST" action="{{ route('transactions.update', $transaction->id) }}">
        @csrf
        @method('PUT')

        <!-- Pilih Kustomer -->
        <div class="mb-3">
            <label for="customer_id" class="form-label">Nama Kustomer</label>
            <select class="form-control" id="customer_id" name="customer_id" required>
                <option value="">-- Pilih Kustomer --</option>
                @foreach($customers as $customer)
                    <option 
                        value="{{ $customer->id }}" 
                        {{ old('customer_id', $transaction->customer_id) == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Produk -->
        <div class="mb-3">
            <label for="product_id" class="form-label">Produk Dibeli</label>
            <select class="form-control" id="product_id" name="product_id" required>
                <option value="">-- Pilih Produk --</option>
                @foreach($products as $product)
                    <option 
                        value="{{ $product->id }}" 
                        data-price="{{ $product->price }}" 
                        {{ old('product_id', $transaction->product_id) == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Harga Tampil -->
        <div class="mb-3">
            <label for="price" class="form-label">Harga Produk</label>
            <input 
                type="text" 
                class="form-control" 
                id="price" 
                value="{{ old('price', optional($transaction->product)->price) }}" 
                readonly>
        </div>

        <!-- Harga Tersembunyi -->
        <input 
            type="hidden" 
            name="total_price" 
            id="total_price" 
            value="{{ old('total_price', $transaction->total_price) }}">

        <!-- Tanggal Transaksi -->
        <div class="mb-3">
            <label for="transaction_date" class="form-label">Tanggal Transaksi</label>
            <input 
                type="date" 
                class="form-control" 
                id="transaction_date" 
                name="transaction_date" 
                value="{{ old('transaction_date', \Carbon\Carbon::parse($transaction->transaction_date)->format('Y-m-d')) }}" 
                required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const productSelect = document.getElementById('product_id');
        const priceInput = document.getElementById('price');
        const hiddenPrice = document.getElementById('total_price');

        function updatePrice() {
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const price = selectedOption.getAttribute('data-price') || '';
            priceInput.value = price;
            hiddenPrice.value = price;
        }

        // Update harga saat pertama kali halaman dibuka (untuk old value)
        updatePrice();

        // Update harga saat produk dipilih
        productSelect.addEventListener('change', updatePrice);
    });
    </script>
</div>
@endsection