@extends('layouts.app')

@section('content')
<div class="container">
    @section('header')
        {{ __('Edit Transaksi') }}
    @endsection
    <div class="body-box">
        <div class="container-box p-4 pt-1">
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('transactions.update', $transaction->id) }}">
                @csrf
                @method('PUT')

                <div class="pb-2 mb-1 border-bottom">
                    <div class="col-md-4">
                        <label for="seller_id" class="form-label">Nama Penjual</label>
                        <select class="form-control" id="seller_id" name="seller_id" required>
                            <option value="">-- Pilih Penjual --</option>
                            @foreach($sellers as $seller)
                                <option value="{{ $seller->id }}" {{ (old('seller_id', $transaction->seller_id) == $seller->id) ? 'selected' : '' }}>
                                    {{ $seller->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="pb-2 mb-3 border-bottom">
                    <div class="col-md-4">
                        <label for="customer_id" class="form-label">Nama Pembeli</label>
                        <select class="form-control" id="customer_id" name="customer_id" required>
                            <option value="">-- Pilih Pembeli --</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ (old('customer_id', $transaction->customer_id) == $customer->id) ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="align-items-center justify-items-center">
                    <div class="border-bottom">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="w-1/2">Produk</th>
                                    <th class="w-1/6">Jumlah</th>
                                    <th class="w-1/4">Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="products-wrapper">
                                @foreach($transaction->products as $index => $product)
                                    <tr class="product-item">
                                        <td>
                                            <select class="form-control product-select" name="products[{{ $index }}][product_id]" required>
                                                <option value="">-- Pilih Produk --</option>
                                                @foreach($products as $prod)
                                                    <option value="{{ $prod->id }}"
                                                        data-price="{{ $prod->price }}"
                                                        {{ $product->id == $prod->id ? 'selected' : '' }}>
                                                        {{ $prod->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control quantity-input" name="products[{{ $index }}][quantity]"
                                                value="{{ old("products.$index.quantity", $product->pivot->quantity) }}" min="1" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control subtotal-input" name="products[{{ $index }}][subtotal]"
                                                value="{{ number_format($product->pivot->subtotal, 0, ',', '.') }}" readonly>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger remove-product">Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-center gap-5 align-items-center pb-1 mb-3 border-bottom">
                        <div class="mt-md-2">
                            <button type="button" id="add-product" class="btn btn-secondary">+ Tambah Produk</button>
                        </div>    

                        <div class="mb-3">
                            <label class="mb-1">Total Harga</label>
                            <input type="text" class="form-control" id="total_price_display"
                                   value="{{ number_format($transaction->total_price, 0, ',', '.') }}" readonly>
                            <input type="hidden" name="total_price" id="total_price" value="{{ $transaction->total_price }}">
                        </div>

                        <div class="mb-3">
                            <label for="transaction_date" class="form-label mb-1">Tanggal Transaksi</label>
                            <input type="date" class="form-control" id="transaction_date" name="transaction_date"
                                   required value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d')) }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let productIndex = {{ $transaction->products->count() }};

    function formatRupiah(angka) {
        return angka.toLocaleString('id-ID');
    }

    function updateSubtotals() {
        let total = 0;
        document.querySelectorAll('.product-item').forEach(function (item) {
            const select = item.querySelector('.product-select');
            const quantity = parseInt(item.querySelector('.quantity-input').value) || 0;
            const price = parseFloat(select.options[select.selectedIndex]?.getAttribute('data-price')) || 0;
            const subtotal = price * quantity;
            
            item.querySelector('.subtotal-input').value = formatRupiah(subtotal);
            total += subtotal;
        });
        document.getElementById('total_price_display').value = formatRupiah(total);
        document.getElementById('total_price').value = total.toFixed(2);
    }

    document.getElementById('add-product').addEventListener('click', function () {
        const wrapper = document.getElementById('products-wrapper');
        const newRow = document.querySelector('.product-item').cloneNode(true);

        newRow.querySelector('.product-select').selectedIndex = 0;
        newRow.querySelector('.quantity-input').value = 1;
        newRow.querySelector('.subtotal-input').value = '';

        newRow.querySelector('.product-select').setAttribute('name', `products[${productIndex}][product_id]`);
        newRow.querySelector('.quantity-input').setAttribute('name', `products[${productIndex}][quantity]`);
        newRow.querySelector('.subtotal-input').setAttribute('name', `products[${productIndex}][subtotal]`);

        wrapper.appendChild(newRow);
        productIndex++;
    });

    document.getElementById('products-wrapper').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-product') && document.querySelectorAll('.product-item').length > 1) {
            e.target.closest('.product-item').remove();
            updateSubtotals();
        }
    });

    document.getElementById('products-wrapper').addEventListener('change', function (e) {
        if (e.target.classList.contains('product-select') || e.target.classList.contains('quantity-input')) {
            updateSubtotals();
        }
    });

    updateSubtotals();
});
</script>
@endsection
