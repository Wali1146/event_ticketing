<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransactionService
{
    public function get(?Transaction $transaction)
    {
        if (!$transaction) {
            return ['message' => 'Transaksi tidak ditemukan',];
        }
        $transaction->load('ticket');
        return $transaction;
    }

    public function update(array $data, Transaction $transaction)
    {
        return DB::transaction(function () use ($data, $transaction) {
            $id = $data['ticket_id'] ?? $transaction->ticket_id;
            $ticket = Ticket::query()->lockForUpdate()->find($id);
            if (!$ticket) {
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
            $transaction->update($data);
            return $transaction;
        });
    }

    public function create(array $data, Ticket $ticket, User $user)
    {
        return DB::transaction(function () use ($data, $ticket, $user) {
            $ticket = Ticket::query()->lockForUpdate()->findOrFile($data['event_id']);
            if ($ticket->remaining_quota < $data['qty']) {
                throw ValidationException::withMessages([
                    'message' => 'Permintaan mu melebihi kuota tersedia',
                    'sisa_kuota' => $ticket->remaining_quota,
                ]);
            }
            $totalPrice = $data['qty'] * $ticket->price;
            $transaction = Transaction::create([
                'user_id' => $user->id,
                'ticket_id' => $ticket->id,
                'qty' => $data['qty'],
                'total_price' => $totalPrice,
            ]);
            $ticket->decrement('remaining_quota', $data['qty']);
            return $transaction;
        });
    }

    public function delete(?Transaction $transaction)
    {
        if (!$transaction) {
            return ['message' => 'Transaksi tidak ditemukan',];
        }
        $transaction->delete($transaction);
        return ['message' => 'Transaksi berhasil dihapus',];
    }
}
