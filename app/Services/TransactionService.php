<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\TransactionRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransactionService
{
    protected $repository;

    public function __construct(TransactionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getId(int $id)
    {
        $transaction = $this->repository->getId($id);
        if (! $transaction) {
            throw ValidationException::withMessages([
                'message' => 'Transaksi tidak ditemukan',
            ]);
        }

        return $transaction;
    }

    public function getAllById(int $id)
    {
        $transaction = $this->repository->getAllById($id);
        if (! $transaction) {
            throw ValidationException::withMessages([
                'message' => 'Transaksi tidak ditemukan',
            ]);
        }

        return $transaction;
    }

    public function update(array $data, Transaction $transaction)
    {
        return DB::transaction(function () use ($data, $transaction) {
            $id = $data['ticket_id'] ?? $transaction->ticket_id;
            $ticket = Ticket::query()->lockForUpdate()->find($id);
            if (! $ticket) {
                throw ValidationException::withMessages([
                    'message' => 'Tiket tidak ditemukan',
                ]);
            }
            if (isset($data['qty'])) {
                $qtyOld = $transaction->qty;
                $qtyNew = $data['qty'];
                if ($id == $transaction->ticket_id) {
                    $sisa = $qtyNew - $qtyOld;
                    if ($sisa > $ticket->remaining_quota) {
                        throw ValidationException::withMessages([
                            'message' => 'Permintaan melebihi kuota tersedia',
                            'sisa_kuota' => $ticket->remaining_quota,
                        ]);
                    }
                    $ticket->decrement('remaining_quota', $sisa);
                } else {
                    $quotaOld = Ticket::query()->lockForUpdate()->find($transaction->ticket_id);
                    if ($quotaOld) {
                        $quotaOld->increment('remaining_quota', $qtyOld);
                    }
                    if ($qtyNew > $ticket->remaining_quota) {
                        throw ValidationException::withMessages([
                            'message' => 'Sisa kuota tidak cukup',
                            'sisa_kuota' => $ticket->remaining_quota,
                        ]);
                    }
                    $ticket->decrement('remaining_quota', $qtyNew);
                }
                $data['total_price'] = $qtyNew * $ticket->price;
            }

            return $this->repository->patch($data, $transaction);
        });
    }

    public function store(array $data, User $user)
    {
        return DB::transaction(function () use ($data, $user) {
            $ticket = $this->repository->getTicketId($data['ticket_id']);
            if(!$ticket){
                throw ValidationException::withMessages([
                    'Tiket tidak ditemukan',
                ]);
            }
            if ($ticket->remaining_quota < $data['qty']) {
                throw ValidationException::withMessages([
                    'message' => 'Permintaan mu melebihi kuota tersedia',
                    'sisa_kuota' => $ticket->remaining_quota,
                ]);
            }
            $totalPrice = $data['qty'] * $ticket->price;
            return $this->repository->post($ticket, $data, $user->id, $totalPrice);
        });
    }

    public function destroy(int $id)
    {
        $transaction = $this->repository->getId($id);
        if (! $transaction) {
            throw ValidationException::withMessages([
                'message' => 'Transaksi tidak ditemukan',
            ]);
        }

        return $this->repository->delete($transaction);
    }
}
