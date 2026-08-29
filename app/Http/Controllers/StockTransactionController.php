<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Repositories\StockTransactionRepository;
use App\Services\StockService;
use Illuminate\Http\Request;

class StockTransactionController extends Controller
{
    public function __construct(
        protected StockService $stockService,
        protected StockTransactionRepository $transactionRepository
    ) {
    }

    public function index()
    {
        $transactions = $this->transactionRepository->getAll();

        return view('stock-transactions.index', compact('transactions'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        $users = User::orderBy('name')->get();

        return view(
            'stock-transactions.create',
            compact('products', 'users')
        );
    }

    public function show(int $id)
    {
        $transaction = $this->transactionRepository->findById($id);

        if (!$transaction) {
            abort(404);
        }

        return view(
            'stock-transactions.show',
            compact('transaction')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:Masuk,Keluar',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:Pending,Diterima,Ditolak,Dikeluarkan',
            'notes' => 'nullable|string',
        ]);

        if (!auth()->check()) {
            return redirect()
                ->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $product = Product::findOrFail($validated['product_id']);
        $user = auth()->user();

        try {
            $this->stockService->createTransaction(
                $product,
                $user,
                $validated['type'],
                $validated['quantity'],
                $validated['status'],
                $validated['notes'] ?? null
            );
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }

        return redirect()
            ->route('stock-transactions.index')
            ->with(
                'success',
                'Transaksi stok berhasil dibuat.'
            );
    }

    /**
     * Memproses persetujuan (approval) status transaksi stok.
     */
    public function updateStatus(Request $request, int $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Diterima,Dikeluarkan,Ditolak',
        ]);

        $transaction = $this->transactionRepository->findById($id);

        if (!$transaction) {
            abort(404);
        }

        try {
            $this->stockService->updateTransactionStatus(
                $transaction,
                $validated['status'],
                auth()->user()
            );
        } catch (\Throwable $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()
            ->route('stock-transactions.show', $transaction->id)
            ->with('success', 'Status transaksi berhasil diperbarui.');
    }
}