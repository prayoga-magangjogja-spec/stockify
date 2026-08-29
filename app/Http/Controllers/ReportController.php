<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function stock()
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil Data Produk
        |--------------------------------------------------------------------------
        */

        $products = Product::with([
            'category',
            'supplier'
        ])
        ->orderBy('name')
        ->get();


        /*
        |--------------------------------------------------------------------------
        | Statistik Stok
        |--------------------------------------------------------------------------
        */

        $totalProducts = $products->count();

        $totalStock = $products->sum('stock');


        /*
        |--------------------------------------------------------------------------
        | Produk dengan Stok Menipis
        |--------------------------------------------------------------------------
        */

        $lowStockProducts = $products->filter(function ($product) {

            return $product->stock <= $product->minimum_stock;

        });


        /*
        |--------------------------------------------------------------------------
        | Kirim Data ke View
        |--------------------------------------------------------------------------
        */

        return view(
            'reports.stock',
            compact(
                'products',
                'totalProducts',
                'totalStock',
                'lowStockProducts'
            )
        );
    }


    public function transactions(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Query Transaksi
        |--------------------------------------------------------------------------
        */

        $query = StockTransaction::with([
            'product',
            'user'
        ]);


        /*
        |--------------------------------------------------------------------------
        | Filter Tipe Transaksi
        |--------------------------------------------------------------------------
        */

        if ($request->filled('type')) {

            $query->where(
                'type',
                $request->type
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Filter Tanggal Mulai
        |--------------------------------------------------------------------------
        */

        if ($request->filled('start_date')) {

            $query->whereDate(
                'date',
                '>=',
                $request->start_date
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Filter Tanggal Akhir
        |--------------------------------------------------------------------------
        */

        if ($request->filled('end_date')) {

            $query->whereDate(
                'date',
                '<=',
                $request->end_date
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Ambil Data Transaksi
        |--------------------------------------------------------------------------
        */

        $transactions = $query
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Total Seluruh Transaksi
        |--------------------------------------------------------------------------
        */

        $totalTransactions = $transactions->count();


        /*
        |--------------------------------------------------------------------------
        | Total Barang Masuk
        |--------------------------------------------------------------------------
        |
        | Hanya transaksi Masuk dengan status Diterima
        | yang dihitung.
        |
        */

        $totalIn = $transactions
            ->where('type', 'Masuk')
            ->where('status', 'Diterima')
            ->sum('quantity');


        /*
        |--------------------------------------------------------------------------
        | Total Barang Keluar
        |--------------------------------------------------------------------------
        |
        | Hanya transaksi Keluar dengan status Dikeluarkan
        | yang dihitung.
        |
        */

        $totalOut = $transactions
            ->where('type', 'Keluar')
            ->where('status', 'Dikeluarkan')
            ->sum('quantity');


        /*
        |--------------------------------------------------------------------------
        | Kirim Data ke View
        |--------------------------------------------------------------------------
        */

        return view(
            'reports.transactions',
            compact(
                'transactions',
                'totalTransactions',
                'totalIn',
                'totalOut'
            )
        );
    }
}