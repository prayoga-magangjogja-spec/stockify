<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockOpname;
use App\Models\StockTransaction;
use App\Models\User;
use App\Repositories\StockTransactionRepository;
use Illuminate\Support\Facades\DB;

class StockService
{
    public function __construct(
        protected StockTransactionRepository $transactionRepository
    ) {
    }

    /**
     * Membuat produk baru beserta transaksi stok awal jika ada.
     */
    public function createProductWithInitialStock(array $data, int $userId): Product
    {
        return DB::transaction(function () use ($data, $userId) {
            $initialStock = (int) ($data['stock'] ?? 0);
            unset($data['stock']);
            $data['stock'] = 0;

            $product = Product::create($data);

            if ($initialStock > 0) {
                $user = User::findOrFail($userId);
                $this->createTransaction(
                    $product,
                    $user,
                    'Masuk',
                    $initialStock,
                    'Diterima',
                    '[STOK AWAL] Stok awal produk baru'
                );
            }

            return $product;
        });
    }

    /**
     * Memproses Stock Opname secara atomic beserta transaksi penyesuaian stok.
     */
    public function processStockOpname(
        int $productId,
        int $userId,
        int $physicalStock,
        string $date,
        ?string $notes = null
    ): StockOpname {
        if ($physicalStock < 0) {
            throw new \InvalidArgumentException(
                'Stok fisik tidak boleh kurang dari 0.'
            );
        }

        return DB::transaction(function () use (
            $productId,
            $userId,
            $physicalStock,
            $date,
            $notes
        ) {
            $product = Product::where('id', $productId)
                ->lockForUpdate()
                ->firstOrFail();

            $user = User::findOrFail($userId);

            $systemStock = (int) $product->stock;
            $difference = $physicalStock - $systemStock;

            $stockOpname = StockOpname::create([
                'product_id' => $product->id,
                'user_id' => $user->id,
                'system_stock' => $systemStock,
                'physical_stock' => $physicalStock,
                'difference' => $difference,
                'date' => $date,
                'notes' => $notes,
            ]);

            if ($difference !== 0) {
                if ($difference > 0) {
                    $type = 'Masuk';
                    $status = 'Diterima';
                    $qty = $difference;
                    $tagNotes = '[STOCK OPNAME] Penyesuaian kelebihan: +' . $difference;
                } else {
                    $type = 'Keluar';
                    $status = 'Dikeluarkan';
                    $qty = abs($difference);
                    $tagNotes = '[STOCK OPNAME] Penyesuaian kekurangan: ' . $difference;
                }

                $fullNotes = $notes ? $tagNotes . ' - ' . $notes : $tagNotes;

                $this->createTransaction(
                    $product,
                    $user,
                    $type,
                    $qty,
                    $status,
                    $fullNotes
                );
            }

            return $stockOpname;
        });
    }

    /**
     * Membuat transaksi stok (Concurrency-safe dengan pessimistic locking).
     *
     * Aturan:
     * - Masuk + Diterima     => stok bertambah
     * - Keluar + Dikeluarkan => stok berkurang
     * - Pending              => stok belum berubah
     * - Ditolak              => stok tidak berubah
     */
    public function createTransaction(
        Product $product,
        User $user,
        string $type,
        int $quantity,
        string $status,
        ?string $notes = null
    ): StockTransaction {
        return DB::transaction(function () use (
            $product,
            $user,
            $type,
            $quantity,
            $status,
            $notes
        ) {
            /*
            |--------------------------------------------------------------------------
            | Pessimistic Locking pada Produk
            |--------------------------------------------------------------------------
            */
            $lockedProduct = Product::where('id', $product->id)
                ->lockForUpdate()
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | Validasi Quantity
            |--------------------------------------------------------------------------
            */
            if ($quantity <= 0) {
                throw new \InvalidArgumentException(
                    'Quantity harus lebih dari 0.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Validasi Type
            |--------------------------------------------------------------------------
            */
            if (!in_array($type, ['Masuk', 'Keluar'])) {
                throw new \InvalidArgumentException(
                    'Tipe transaksi tidak valid.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Validasi Status
            |--------------------------------------------------------------------------
            */
            if (!in_array($status, [
                'Pending',
                'Diterima',
                'Ditolak',
                'Dikeluarkan'
            ])) {
                throw new \InvalidArgumentException(
                    'Status transaksi tidak valid.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Validasi Kesesuaian Type & Status
            |--------------------------------------------------------------------------
            */
            if ($type === 'Masuk' && !in_array($status, ['Pending', 'Diterima', 'Ditolak'])) {
                throw new \InvalidArgumentException(
                    'Transaksi bertipe Masuk hanya boleh berstatus Pending, Diterima, atau Ditolak.'
                );
            }

            if ($type === 'Keluar' && !in_array($status, ['Pending', 'Dikeluarkan', 'Ditolak'])) {
                throw new \InvalidArgumentException(
                    'Transaksi bertipe Keluar hanya boleh berstatus Pending, Dikeluarkan, atau Ditolak.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Cek Stok untuk Barang Keluar
            |--------------------------------------------------------------------------
            */
            if (
                $type === 'Keluar' &&
                $status === 'Dikeluarkan' &&
                $lockedProduct->stock < $quantity
            ) {
                throw new \InvalidArgumentException(
                    "Stok tidak mencukupi untuk transaksi keluar. Stok saat ini: {$lockedProduct->stock}"
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Simpan Transaksi
            |--------------------------------------------------------------------------
            */
            $transaction = $this->transactionRepository->create([
                'product_id' => $lockedProduct->id,
                'user_id' => $user->id,
                'type' => $type,
                'quantity' => $quantity,
                'date' => now(),
                'status' => $status,
                'notes' => $notes,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Update Stok Melalui StockService
            |--------------------------------------------------------------------------
            */
            if ($type === 'Masuk' && $status === 'Diterima') {
                $lockedProduct->increment('stock', $quantity);
            }

            if ($type === 'Keluar' && $status === 'Dikeluarkan') {
                $lockedProduct->decrement('stock', $quantity);
            }

            return $transaction;
        });
    }

    /**
     * Memperbarui status transaksi stok yang berstatus Pending (Approval Workflow).
     */
    public function updateTransactionStatus(
        StockTransaction $transaction,
        string $newStatus,
        User $user
    ): StockTransaction {
        return DB::transaction(function () use ($transaction, $newStatus, $user) {
            /*
            |--------------------------------------------------------------------------
            | Re-fetch & Lock Transaksi
            |--------------------------------------------------------------------------
            */
            $lockedTransaction = StockTransaction::where('id', $transaction->id)
                ->lockForUpdate()
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | Validasi 1: Imutabilitas Status Final (Hanya Pending yang boleh diproses)
            |--------------------------------------------------------------------------
            */
            if ($lockedTransaction->status !== 'Pending') {
                throw new \InvalidArgumentException(
                    "Status transaksi sudah final ({$lockedTransaction->status}) dan tidak dapat diubah lagi."
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Validasi 2: Kesesuaian Tipe Transaksi & Status Baru
            |--------------------------------------------------------------------------
            */
            if ($lockedTransaction->type === 'Masuk' && !in_array($newStatus, ['Diterima', 'Ditolak'])) {
                throw new \InvalidArgumentException(
                    "Transaksi bertipe Masuk hanya dapat diubah menjadi Diterima atau Ditolak."
                );
            }

            if ($lockedTransaction->type === 'Keluar' && !in_array($newStatus, ['Dikeluarkan', 'Ditolak'])) {
                throw new \InvalidArgumentException(
                    "Transaksi bertipe Keluar hanya dapat diubah menjadi Dikeluarkan atau Ditolak."
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Lock Produk Terkait
            |--------------------------------------------------------------------------
            */
            $lockedProduct = Product::where('id', $lockedTransaction->product_id)
                ->lockForUpdate()
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | Validasi 3: Cek Stok untuk Pengeluaran Barang
            |--------------------------------------------------------------------------
            */
            if (
                $lockedTransaction->type === 'Keluar' &&
                $newStatus === 'Dikeluarkan' &&
                $lockedProduct->stock < $lockedTransaction->quantity
            ) {
                throw new \InvalidArgumentException(
                    "Stok tidak mencukupi untuk menyetujui transaksi keluar. Stok saat ini: {$lockedProduct->stock}"
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Update Status Transaksi
            |--------------------------------------------------------------------------
            */
            $lockedTransaction->status = $newStatus;
            $lockedTransaction->save();

            /*
            |--------------------------------------------------------------------------
            | Mutasi Stok Produk Sesuai Status Baru
            |--------------------------------------------------------------------------
            */
            if ($lockedTransaction->type === 'Masuk' && $newStatus === 'Diterima') {
                $lockedProduct->increment('stock', $lockedTransaction->quantity);
            }

            if ($lockedTransaction->type === 'Keluar' && $newStatus === 'Dikeluarkan') {
                $lockedProduct->decrement('stock', $lockedTransaction->quantity);
            }

            return $lockedTransaction;
        });
    }
}