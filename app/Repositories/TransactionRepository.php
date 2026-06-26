<?php

namespace App\Repositories;

use App\Models\Ticket;
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

    public function getAllById(int $id)
    {
        return Transaction::query()->where('user_id', $id)->get();
    }

    public function getTicketId(int $id): ?Ticket
    {
        return Ticket::query()->lockForUpdate()->find($id);
    }

    public function post(Ticket $ticket, array $data, int $user, int $totalPrice): Transaction
    {
        $ticket->decrement('remaining_quota', $data['qty']);
        return Transaction::create([
            'user_id' => $user,
            'ticket_id' => $ticket->id,
            'qty' => $data['qty'],
            'total_price' => $totalPrice,
        ]);
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
