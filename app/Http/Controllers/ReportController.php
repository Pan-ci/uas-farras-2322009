<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Transaction;

class ReportController extends Controller
{
    //
    public function index()
    {
        $transactions = Transaction::with('products')->get();

        $dailySales = [];

        foreach ($transactions as $transaction) {
            $date = Carbon::parse($transaction->transaction_date)->format('Y-m-d');

            foreach ($transaction->products as $product) {
                $productName = $product->pivot->product_name ?? $product->name;
                $quantity = $product->pivot->quantity;
                $subtotal = $product->pivot->subtotal;

                if (!isset($dailySales[$date])) {
                    $dailySales[$date] = [];
                }

                if (!isset($dailySales[$date][$productName])) {
                    $dailySales[$date][$productName] = [
                        'quantity' => 0,
                        'total' => 0,
                    ];
                }

                $dailySales[$date][$productName]['quantity'] += $quantity;
                $dailySales[$date][$productName]['total'] += $subtotal;
            }
        }

        return view('reports.index', compact('dailySales'));
    }
}
