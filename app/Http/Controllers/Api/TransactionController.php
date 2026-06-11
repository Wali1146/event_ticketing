<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexAdmin()
    {
        $transaction = DB::select('select * from transactions');
        return response()->json($transaction);
    }

    /**
     * menampilkan semua transaksi berdasarkan satu user
     */
    public function indexUser(Request $request)
    {
        $id = $request->user()->id;
        $transaction = DB::select('select * from transactions where user_id = ?', [$id]);
        return response()->json($transaction);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $data = $request->validated();
        $ticket = Ticket::query()->where('id', $request->ticket_id)->first();
        if (!$ticket) {
            return response()->json(['message' => 'Tiket tidak ditemukan',]);
        }
        if ($ticket->remaining_quota < $request->qty) {
            return response()->json([
                'message' => 'Permintaan melebihi kuota yg disediakan',
                'sisa_tiket' => $ticket->remaining_quota,
            ]);
        }
        $transaction = Transaction::create($data);
        $ticket->update(['remaining_quota' => $ticket->remaining_quota - $request->qty]);
        return response()->json($transaction);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = DB::select('select * from transactions where id = ?', [$id]);
        return response()->json($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $data = $request->validated();
        $transaction->update($data);
        return response()->json($transaction);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = DB::select('delete from transactions where id = ?', [$id]);
        return response()->json($transaction);
    }
}
