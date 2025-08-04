<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Belanja</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    <h3>Struk Belanja</h3>
    <p>
       <strong>ID Transaksi:</strong> #{{ $transaction->id }}<br>
       <strong>Penjual:</strong> {{ $transaction->seller->name }}<br>
       <strong>Pembeli:</strong> {{ $transaction->customer_name }}<br>
       <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d-m-Y') }}

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($transaction->products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>Rp {{ number_format($product->pivot->subtotal, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Total</th>
                <th>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</th>
            </tr>
            <tr>
                <th colspan="2">Diskon</th>
                <th>Rp {{ number_format($transaction->discount, 0, ',', '.') }}</th>
            </tr>
            <tr>
                <th colspan="2">Total Harga</th>
                <th>Rp {{ number_format($transaction->final_price, 0, ',', '.') }}</th>
            </tr>
            <tr>
                <th colspan="2">Pembayaran</th>
                <th>Rp {{ number_format($transaction->payment, 0, ',', '.') }}</th>
            </tr>
            <tr>
                <th colspan="2">Kembalian</th>
                <th>Rp {{ number_format($transaction->change, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
