<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockOpname;
use App\Services\StockService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockOpnameController extends Controller
{
    public function __construct(
        protected StockService $stockService
    ) {
    }

    /**
     * Menampilkan daftar stock opname.
     */
    public function index()
    {
        $stockOpnames = StockOpname::with([
            'product',
            'user'
        ])
        ->latest()
        ->get();

        return view('stock-opnames.index', compact('stockOpnames'));
    }

    /**
     * Menampilkan form stock opname.
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('stock-opnames.create', compact('products'));
    }

    /**
     * Menyimpan stock opname.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'physical_stock' => 'required|integer|min:0',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        try {
            $this->stockService->processStockOpname(
                (int) $validated['product_id'],
                Auth::id(),
                (int) $validated['physical_stock'],
                $validated['date'],
                $validated['notes'] ?? null
            );
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal memproses stock opname: ' . $e->getMessage());
        }

        return redirect()
            ->route('stock-opnames.index')
            ->with('success', 'Stock opname berhasil disimpan.');
    }

    /**
     * Menampilkan detail stock opname.
     */
    public function show(StockOpname $stockOpname)
    {
        $stockOpname->load([
            'product',
            'user'
        ]);

        return view(
            'stock-opnames.show',
            compact('stockOpname')
        );
    }
}