<?php

namespace App\Repositories;

use App\Models\StockTransaction;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class StockTransactionRepository
{
    public function create(array $data): StockTransaction
    {
        return StockTransaction::create($data);
    }

    public function findById(int $id): ?StockTransaction
    {
        return StockTransaction::with([
            'product',
            'user',
        ])->find($id);
    }

    public function getAll(int $perPage = 10): LengthAwarePaginator
    {
        return StockTransaction::with([
            'product',
            'user',
        ])
            ->latest()
            ->paginate($perPage);
    }
}