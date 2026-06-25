<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository
{
    public function getAll()
    {
        return Transaction::all();
    }

    public function getId(int $id): ?Transaction
    {
        return Transaction::query()->find($id);
    }

    public function post(array $data): Transaction
    {
        return Transaction::query()->create($data);
    }

    public function patch(array $data, Transaction $transaction): Transaction
    {
        $transaction->update($data);
        return $transaction;
    }

    public function delete(Transaction $transaction)
    {
        return $transaction->delete();
    }
}
