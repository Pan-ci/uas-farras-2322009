<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan daftar produk (Read)
    public function index()
    {
        // Mengambil semua produk dari database dan mem-paginate 10 data per halaman
        $products = Product::with('category')->paginate(10);
        // Mengelompokkan produk berdasarkan nama kategori
        $productsGrouped = $products->getCollection()->groupBy(function($product) {
            return $product->category->name;
        });

        // Return view dengan data produk
        return view('products.index', compact(['products', 'productsGrouped']));
    }

    // Menampilkan form untuk membuat produk baru (Create)
    public function create()
    {
        // Mengambil semua kategori untuk ditampilkan pada form select
        $categories = Category::all();

        // Return view untuk menampilkan form
        return view('products.create', compact('categories'));
    }

    // Menyimpan data produk baru ke database (Store)
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'writer' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'minimum_quantity' => 'required|integer|min:0',
        ]);

        // Ambil nama kategori berdasarkan category_id
        $category = Category::find($request->category_id);

        // Simpan produk dengan category_name
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'category_name' => $category->name,  // Simpan nama kategori
            'writer' => $request->writer,
            'quantity' => $request->quantity,
            'minimum_quantity' => $request->minimum_quantity,
        ]);

        // Menyimpan produk baru ke database
        // Product::create($request->all());

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit produk yang ada (Edit)
    public function edit($id)
    {
        // Cari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Ambil semua kategori untuk form select
        $categories = Category::all();

        // Return view dengan data produk yang akan di-edit
        return view('products.edit', compact('product', 'categories'));
    }

    // Memperbarui data produk di database (Update)
    public function update(Request $request, $id)
    {
        // Validasi data dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'writer' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'minimum_quantity' => 'required|integer|min:0',
        ]);

        // Cari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Ambil nama kategori berdasarkan category_id
        $category = Category::find($request->category_id);

        // Update data produk dan simpan kategori baru
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->category_name = $category->name;  // Perbarui nama kategori
        $product->writer = $request->writer;
        $product->quantity = $request->quantity;
        $product->minimum_quantity = $request->minimum_quantity;
        $product->save();  // Simpan perubahan

        // Update produk di database
        // $product->update($request->all());

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate.');
    }

    // Menghapus produk dari database (Delete)
    public function destroy($id)
    {
        // Cari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Hapus produk dari database
        $product->delete();

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
