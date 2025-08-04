<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // Ambil produk yang stoknya sudah mencapai minimum
        $alertProducts = Product::whereColumn('quantity', '<=', 'minimum_quantity')->get();
        $data = DB::table('transaction_history')
                ->select(
                    DB::raw('DATE_FORMAT(updated_at, "%M %Y") as month'), // Format bulan dan tahun
                    DB::raw('SUM(profit) as total_profit') // Jumlah total per bulan
                )
                ->groupBy('month')
                ->orderBy('month', 'asc')
                ->get();
        $labels = [];
        $totals = [];

        foreach ($data as $item) {
            $labels[] = $item->month;
            $totals[] = (float) $item->total_profit; // pastikan nilainya numerik
        }

        return view('dashboard', compact('alertProducts', 'data', 'labels', 'totals'));
    }
}
