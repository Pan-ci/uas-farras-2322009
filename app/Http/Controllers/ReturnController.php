<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Returns;
use App\Models\ReturnItem;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

class ReturnController extends Controller
{
    /*discount, profit, final_price, total_price
    product_price, subtotal,
    hidden all, tampil di index admin,
    ubah chart profit_masuk - profit_return? nama yang aneh*/
    public function create_re(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
        ]);

        return view('returns.create');
    }

    public function store(Request $request)
    {
        // Konversi 'is_returned' dari string ke boolean sebelum validasi
        $request->merge([
            'total_price' => str_replace('.', '', $request->total_price),
            'final_price' => str_replace('.', '', $request->final_price),
        ]);

        /*bisa gunakan variabel ini jika ingin lebih rapi,
        dan hanya ingin bekerja dengan data valid,
        tapi yang penting fungsi validate sudah didefinikan,
        maka tetap dijalankan*/
        $validated = $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.subtotal' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'final_price' => 'required|numeric|min:0',
            'payment' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'change' => 'required|numeric|min:0',
            'profit' => 'required|numeric|min:0',
        ]);

        $transaction = Transaction::with('products')->find($request->transaction_id);
        $customerId = $transaction->customer_id;

        foreach ($request->products as $index => $productInput) {
            $productId = $productInput['product_id'];
            $returnQty = $productInput['quantity'];

            // Ambil data pembelian dari transaksi sebelumnya
            $purchased = $transaction->products->firstWhere('id', $productId);
            if (!$purchased) {
                return back()->withErrors(["products.$index.product_id" => "Produk ini tidak dibeli dalam transaksi ini."]);
            }

            // Hitung total retur sebelumnya
            $totalReturned = ReturnItem::whereHas('returns', function ($q) use ($transaction) {
                $q->where('transaction_id', $transaction->id);
            })->where('product_id', $productId)->sum('quantity');

            $maxQty = $purchased->pivot->quantity - $totalReturned;
            if ($returnQty > $maxQty) {
                return back()->withErrors([
                    "products.$index.quantity" => "Maksimal retur untuk produk '{$purchased->name}' adalah $maxQty unit."
                ]);
            }
        }

        DB::beginTransaction();

        try {
            $employee = User::findOrFail(auth()->id());
            $customer = User::findOrFail($transaction->customer_id);
            $return = Returns::create([
                'transaction_id' => $transaction->id,
                'employee_id' => auth()->id(),
                'employee_name' => $employee->name,
                'employee_email' => $employee->email,
                'customer_id' => $transaction->customer_id,
                'customer_name' => $customer->name,
                'customer_email' => $customer->email,
                'returned_at' => now(),
            ]);

            foreach ($request->products as $product) {
                $productName = Product::findOrFail($product['product_id']);
                ReturnItem::create([
                    'return_id' => $return->id,
                    'product_id' => $product['product_id'],
                    'product_name' => $productName->name,
                    'quantity' => $product['quantity'],
                ]);

                // Tambah kembali stok barang
                $prod = Product::find($product['product_id']);
                $prod->quantity += $product['quantity'];
                $prod->save();
            }

            DB::commit();

            return redirect()->route('transactions.index')->with('success', 'Retur berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menyimpan data retur.'])->withInput();
        }
    }
}
