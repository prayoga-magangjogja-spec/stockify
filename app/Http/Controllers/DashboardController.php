<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | STATISTIK UTAMA
        |--------------------------------------------------------------------------
        */

        $totalProducts = Product::count();

        $totalStock = Product::sum('stock');


        /*
        |--------------------------------------------------------------------------
        | STOCK IN
        |--------------------------------------------------------------------------
        */

        $totalStockIn = StockTransaction::where('type', 'Masuk')
            ->where('status', 'Diterima')
            ->sum('quantity');


        /*
        |--------------------------------------------------------------------------
        | STOCK OUT
        |--------------------------------------------------------------------------
        */

        $totalStockOut = StockTransaction::where('type', 'Keluar')
            ->where('status', 'Dikeluarkan')
            ->sum('quantity');


        /*
        |--------------------------------------------------------------------------
        | PRODUK STOK MENIPIS
        |--------------------------------------------------------------------------
        */

        $lowStockProducts = Product::whereColumn(
            'stock',
            '<=',
            'minimum_stock'
        )
        ->orderBy('stock', 'asc')
        ->get();


        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI TERBARU
        |--------------------------------------------------------------------------
        */

        $recentTransactions = StockTransaction::with([
            'product',
            'user'
        ])
        ->latest()
        ->take(5)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | DATA KOMPOSISI STOK
        |--------------------------------------------------------------------------
        */

        $stockComposition = Product::select(
            'name',
            'stock'
        )
        ->orderByDesc('stock')
        ->get();


        /*
        |--------------------------------------------------------------------------
        | DATA GRAFIK 30 HARI
        |--------------------------------------------------------------------------
        |
        | Dibuat per tanggal supaya tidak terkena error MySQL
        | ONLY_FULL_GROUP_BY.
        |
        */

        $startDate = Carbon::today()->subDays(29);
        $endDate = Carbon::today();


        $stockInByDate = StockTransaction::where('type', 'Masuk')
            ->where('status', 'Diterima')
            ->whereBetween('date', [
                $startDate->copy()->startOfDay(),
                $endDate->copy()->endOfDay()
            ])
            ->selectRaw('DATE(date) as transaction_date')
            ->selectRaw('SUM(quantity) as total')
            ->groupByRaw('DATE(date)')
            ->pluck('total', 'transaction_date');


        $stockOutByDate = StockTransaction::where('type', 'Keluar')
            ->where('status', 'Dikeluarkan')
            ->whereBetween('date', [
                $startDate->copy()->startOfDay(),
                $endDate->copy()->endOfDay()
            ])
            ->selectRaw('DATE(date) as transaction_date')
            ->selectRaw('SUM(quantity) as total')
            ->groupByRaw('DATE(date)')
            ->pluck('total', 'transaction_date');


        /*
        |--------------------------------------------------------------------------
        | LABEL & DATA GRAFIK
        |--------------------------------------------------------------------------
        */

        $chartLabels = [];
        $chartStockIn = [];
        $chartStockOut = [];


        for ($i = 0; $i < 30; $i++) {

            $date = $startDate->copy()->addDays($i);

            $dateKey = $date->format('Y-m-d');

            $chartLabels[] = $date->format('d M');

            $chartStockIn[] = (int) ($stockInByDate[$dateKey] ?? 0);

            $chartStockOut[] = (int) ($stockOutByDate[$dateKey] ?? 0);
        }


        /*
        |--------------------------------------------------------------------------
        | KIRIM KE VIEW
        |--------------------------------------------------------------------------
        */

        return view('dashboard', compact(
            'totalProducts',
            'totalStock',
            'totalStockIn',
            'totalStockOut',
            'lowStockProducts',
            'recentTransactions',
            'stockComposition',
            'chartLabels',
            'chartStockIn',
            'chartStockOut'
        ));
    }
}