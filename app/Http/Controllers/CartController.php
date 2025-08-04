<?php
namespace App\Http\Controllers;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Mengambil semua data pelanggan dan mem-paginate 10 data per halaman
        $users = User::with('roles')->paginate(10);

        // Filter: hanya user yang TIDAK memiliki role 'admin' atau 'seller'
        $filteredUsers = $users->filter(function ($user) {
            return !$user->getRoleNames()->intersect(['admin', 'seller'])->isNotEmpty();
        });

        // Group berdasarkan role (selain admin & seller)
        $grouped = $filteredUsers->groupBy(function ($user) {
            // Ambil semua role kecuali 'admin' dan 'seller'
            return $user->getRoleNames()
                        ->reject(function ($role) {
                            return in_array($role, ['admin', 'seller']);
                        })->first(); // atau ->implode(', ') kalau ada multi-role
        });

        return view('cart.index', compact('grouped'));
    }
    
    public function index_customer()
    {
        $cart = CartItem::with('product')->where('user_id', Auth::id())->get();
        $products = Product::all();
        return view('cart.create', compact('cart', 'products'));
    }

    public function add(Request $request)
    {
        $customer = User::findOrFail(Auth::id());
        if ($customer->cart_locked) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang sedang diproses oleh pegawai.'
            ], 423); // 423 Locked
        }

        $products = Product::findOrFail($request->product_id);
        if ($products->quantity <= $products->minimum_quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Produk habis.'
            ], 400); // 423 Locked
        }

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => 1
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function update(Request $request)
    {
        $customer = User::findOrFail(Auth::id());
        if ($customer->cart_locked) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang sedang diproses oleh pegawai.'
            ], 423); // 423 Locked
        }

        $products = Product::findOrFail($request->product_id);
        if ($products->quantity <= $products->minimum_quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Produk habis.'
            ], 400); // 423 Locked
        }

        $min = $products->quantity - $products->minimum_quantity;
        if ($request->quantity > $min) {
            return response()->json([
                'success' => false,
                'message' => 'Stok tidak cukup.'
            ], 400); // 423 Locked
        }

        CartItem::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->update(['quantity' => $request->quantity]);

        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        $customer = User::findOrFail(Auth::id());
        if ($customer->cart_locked) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang sedang diproses oleh pegawai.'
            ], 423); // 423 Locked
        }

        CartItem::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->delete();

        return response()->json(['success' => true]);
    }

    public function getCart()
    {
        $customer = User::findOrFail(Auth::id());

        /*if ($customer->cart_locked) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang sedang diproses oleh pegawai.'
            ], 423); // 423 Locked
        }*/

        $cart = CartItem::with('product')->where('user_id', Auth::id())->get();
        return response()->json([
            'success' => true,
            'cart' => $cart
        ]);
    }

    // fungsi ini kayaknya belum kepakai deh, ganti konsep mulu guwah
    public function json(Request $request)
    {
        $customerId = $request->query('customer_id');

        if (!$customerId) {
            return response()->json([]);
        }
        
        $customer = User::findOrFail($customerId);
        if ($customer->cart_locked) {
            return redirect()->back()->with('error', 'Keranjang sedang diproses oleh pegawai.');
        }

        $cartItems = CartItem::with('product')
            ->where('customer_id', $customerId)
            ->get();

        return response()->json($cartItems);
    }

    // Menampilkan form untuk mengedit pelanggan (Edit)
    public function process($id)
    {
        // Cari pelanggan berdasarkan ID
        $customer = User::findOrFail($id);
        $seller = User::findOrFail(Auth::id());
        $cartItems = CartItem::with('product')->where('user_id', $id)->get();

        $customerRoles = $customer->getRoleNames();
        // Ubah semua role jadi slug, simpan di array
        $slugCustomerRoles = $customerRoles->map(function ($role) {
            return Str::slug($role);
        });

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang pelanggan ' . $customer->name . ' kosong.');
        }

        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        User::where('id', $id)
            ->update(['cart_locked' => true]);

        // Return view untuk mengedit data pelanggan
        return view('transactions.from-cart', compact('customer', 'seller', 'cartItems', 'slugCustomerRoles', 'total'));
    }

    public function cancel($id)
    {
        $customer = User::findOrFail($id);
        if ($customer->cart_locked) {
            User::where('id', $id)
                ->update(['cart_locked' => false]);
            return redirect()->route('cart.index')
                ->with('info', 'Berhasil membatalkan transaksi.');
        } else if (!$customer->cart_locked) {
            return redirect()->route('cart.index')
                ->with('info', 'Tidak ada transaksi yang sedang berlangsung.');
        }
    }
}

