<?php

namespace App\Http\Controllers;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;

class TransactionHistoryController extends Controller
{
    //
    public function index()
    {
        // Ambil semua transaksi beserta penjual dan produk
        $transactionHistory = TransactionHistory::with(['transaction', 'transactionHistoryProduct'])->paginate(10);

        return view('transactions-history.index', compact('transactionHistory'));
    }
}
