<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\TransactionHistory;
use App\Models\TransactionHistoryProduct;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Notifications\TransactionCompleted;

class TransactionController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
    {
        // Ambil semua transaksi beserta penjual dan produk
        $transactions = Transaction::with(['seller', 'customer', 'products'])->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function index_customer()
    {
        $transactions = Transaction::forCustomer(Auth::id())
            ->with(['seller', 'products', 'customer'])
            ->paginate(10);

        return view('transactions.index-customer', compact('transactions'));
    }

    // Menampilkan form tambah transaksi
    public function create()
    {
        $seller = User::findOrFail(Auth::id()); // Ambil user yang berperan sebagai penjual
        $products = Product::all();
        $customers = User::role('buyer')->get();
        $regulars = User::role('regular')->get();
        /*$customers = User::whereHas('roles', function($query) {
            $query->whereIn('name', ['buyer', 'customer']);
        })->get();*/

        return view('transactions.create', compact('seller', 'products', 'customers', 'regulars'));
    }

    public function create_from_cart()
    {
        $sellers = User::role('seller')->get(); // Ambil user yang berperan sebagai penjual
        $products = Product::all();
        $customers = User::role('buyer')->get();
        $regulars = User::role('regular')->get();
        $customerId = $customers->id;
        $regularId = $regulars->id;
        $cart = CartItem::with('product')
        ->where('user_id', [$customerId, $regularId])
        ->get();

        if ($cart->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        return view('transactions.from-cart', compact('sellers', 'products', 'customers', 'regulars', 'cart'));
    }

    public function store(Request $request)
    {
        // != alternatifnya <>. !=== tidak ada, adanya !== untuk nilai dan tipe data
        $validated = $request->validate([
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        foreach ($request->products as $index => $productInput) {
            $product = Product::find($productInput['product_id']);

            if ($productInput['quantity'] > $product->quantity) {
                return back()->withErrors([
                    "products.$index.quantity" => "Stok untuk produk '{$product->name}' tidak mencukupi. Stok: {$product->quantity}"
                ])->withInput();
            }

            if ($product->quantity <= $product->minimum_quantity) {
                return back()->withErrors([
                    "products.$index.quantity" => "Stok untuk produk '{$product->name}' telah mencapai batas minimum stok."
                ])->withInput();
            }
        }
        // Bersihkan format angka dari titik (.) agar jadi angka murni
        $products = collect($request->products)->map(function ($product) {
            $product['subtotal'] = str_replace('.', '', $product['subtotal']);
            return $product;
        });

        // Konversi 'is_returned' dari string ke boolean sebelum validasi
        $request->merge([
            'total_price' => str_replace('.', '', $request->total_price),
            'final_price' => str_replace('.', '', $request->final_price),
            // 'is_returned' => filter_var($request->input('is_returned'), FILTER_VALIDATE_BOOLEAN),
        ]);

        // Validasi input
        $request->validate([
            'seller_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:users,id',
            'transaction_date' => 'required|date',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.subtotal' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'final_price' => 'required|numeric|min:0',
            'payment' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'change' => 'required|numeric|min:0',
            // 'is_returned' => 'required|boolean',
            'profit' => 'required|numeric|min:0',
        ]);

        $request->merge([
            'products' => $products,
        ]);

        // Ambil seller dan customer
        $seller = User::find($request->seller_id);
        $customer = User::find($request->customer_id);
        
        // Hitung total harga
        $total = collect($request->products)->sum('subtotal') - $request->discount;
        $diskon = $request->discount;
        // Simpan transaksi utama
        $transaction = Transaction::create([
            'discount' => $diskon,
            'seller_id' => $seller->id,
            'seller_name' => $seller->name,
            'seller_email' => $seller->email,
            'customer_id' => $customer->id,
            'customer_name' => $customer->name,
            'customer_email' => $customer->email,
            'transaction_date' => $request->transaction_date,
            'total_price' => $total,
            'final_price' => $request->final_price,
            'payment' => $request->payment,
            'change' => $request->change,
            // 'is_returned' => $request->is_returned,
            'profit' => $request->profit,
        ]);

        // Simpan detail produk
        foreach ($request->products as $product) {
            $productData = Product::find($product['product_id']); // Ambil data produk berdasarkan ID
            
            $transaction->products()->attach($product['product_id'], [
                'quantity' => $product['quantity'],
                'subtotal' => $product['subtotal'],
                'product_name' => $productData->name,
                'product_price' => $productData->price,
            ]);

            // Kurangi stok
            $productData->quantity -= $product['quantity'];
            $productData->save();
        }

        // --- Setelah transaksi utama dan detail disimpan, buat snapshot ---
        DB::beginTransaction();

        try {
            // Salin data transaksi utama ke tabel histori
            $history = TransactionHistory::create([
                'transaction_id' => $transaction->id,
                'seller_id' => $transaction->seller_id,
                'seller_name' => $transaction->seller_name,
                'seller_email' => $transaction->seller_email,
                'customer_id' => $transaction->customer_id,
                'customer_name' => $transaction->customer_name,
                'customer_email' => $transaction->customer_email,
                'transaction_date' => $transaction->transaction_date,
                'discount' => $transaction->discount,
                'total_price' => $transaction->total_price,
                'final_price' => $transaction->final_price,
                'payment' => $transaction->payment,
                'change' => $transaction->change,
                // 'is_returned' => $request->is_returned,
                'profit' => $request->profit,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Salin detail produk ke tabel histori produk
            foreach ($request->products as $product) {
                $productData = Product::find($product['product_id']);

                TransactionHistoryProduct::create([
                    'transaction_history_id' => $history->id,
                    'product_id' => $product['product_id'],
                    'product_name' => $productData->name,
                    'product_price' => $productData->price,
                    'quantity' => $product['quantity'],
                    'subtotal' => $product['subtotal'],
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // handle error, misalnya rollback transaksi utama juga
            return back()->withErrors(['error' => 'Gagal menyimpan histori transaksi.'])->withInput();
        }

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function storeFromCart(Request $request)
    {
        $request->merge([
            'discount' => str_replace('.', '', $request->discount),
            'total_price' => str_replace('.', '', $request->total_price),
            'final_price' => str_replace('.', '', $request->final_price),
            'payment' => str_replace('.', '', $request->payment),
            'change' => str_replace('.', '', $request->change),
            'profit' => str_replace('.', '', $request->profit),
        ]);

        $request->validate([
            'seller_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:users,id',
            'transaction_date' => 'required|date',
            'discount' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'final_price' => 'required|numeric|min:0',
            'payment' => 'required|numeric|min:0',
            'change' => 'required|numeric|min:0',
            'profit' => 'required|numeric|min:0',
        ]);

        // Ambil data pengguna
        $seller = User::findOrFail($request->seller_id);
        $customer = User::findOrFail($request->customer_id);

        // Ambil cart item dari session / query (asumsinya lewat controller atau eager load)
        $cartItems = CartItem::with('product')->where('user_id', $customer->id)->get();

        if ($cartItems->isEmpty()) {
            return back()->withErrors(['cart' => 'Keranjang kosong.'])->withInput();
        }

        // Validasi stok
        foreach ($cartItems as $item) {
            $product = $item->product;

            if ($item->quantity > $product->quantity) {
                return back()->withErrors(["stok" => "Stok produk '{$product->name}' tidak mencukupi."])->withInput();
            }

            if ($product->quantity <= $product->minimum_quantity) {
                return back()->withErrors(["stok" => "Stok produk '{$product->name}' telah mencapai batas minimum."])->withInput();
            }
        }

        // Simpan transaksi utama
        $transaction = Transaction::create([
            'seller_id' => $seller->id,
            'seller_name' => $seller->name,
            'seller_email' => $seller->email,
            'customer_id' => $customer->id,
            'customer_name' => $customer->name,
            'customer_email' => $customer->email,
            'transaction_date' => $request->transaction_date,
            'discount' => $request->discount,
            'total_price' => $request->total_price,
            'final_price' => $request->final_price,
            'payment' => $request->payment,
            'change' => $request->change,
            // 'is_returned' => false, // transaksi keranjang tidak memiliki pengembalian
            'profit' => $request->profit,
        ]);

        // Simpan produk ke detail transaksi
        foreach ($cartItems as $item) {
            $product = $item->product;

            $transaction->products()->attach($product->id, [
                'quantity' => $item->quantity,
                'subtotal' => $product->price * $item->quantity,
                'product_name' => $product->name,
                'product_price' => $product->price,
            ]);

            // Kurangi stok
            $product->decrement('quantity', $item->quantity);
        }
        
        // Simpan ke histori
        DB::beginTransaction();
        try {
            $history = TransactionHistory::create([
                'transaction_id' => $transaction->id,
                'seller_id' => $transaction->seller_id,
                'seller_name' => $transaction->seller_name,
                'seller_email' => $transaction->seller_email,
                'customer_id' => $transaction->customer_id,
                'customer_name' => $transaction->customer_name,
                'customer_email' => $transaction->customer_email,
                'transaction_date' => $transaction->transaction_date,
                'discount' => $transaction->discount,
                'total_price' => $transaction->total_price,
                'final_price' => $transaction->final_price,
                'payment' => $transaction->payment,
                'change' => $transaction->change,
                // 'is_returned' => false,
                'profit' => $transaction->profit,
            ]);

            foreach ($cartItems as $item) {
                $product = $item->product;

                TransactionHistoryProduct::create([
                    'transaction_history_id' => $history->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_price' => $product->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $product->price * $item->quantity,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menyimpan histori transaksi.\n'])->withInput();
        }

        // Bersihkan keranjang setelah transaksi berhasil
        CartItem::where('user_id', $customer->id)->delete();
        User::where('id', $customer->id)
            ->update(['cart_locked' => false]);
        User::findOrFail($customer->id)
            ->notify(new TransactionCompleted());

        return redirect()->route('transactions.index')->with('success', 'Transaksi dari keranjang berhasil disimpan.');
    }

    /*/ Menghapus transaksi
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
    */

    // Generate PDF struk
    public function printReceipt($id)
    {
        $transaction = Transaction::with(['seller', 'products'])->findOrFail($id);

        $pdf = PDF::loadView('transactions.receipt', compact('transaction'));

        return $pdf->stream('struk-transaksi-' . $transaction->id . '.pdf');
    }
}
