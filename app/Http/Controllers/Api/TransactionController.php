<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function store(StoreTransactionRequest $request, TransactionService $service)
    {
        $data = $request->validated();
        $transaction = $service->create($data, $data, $request->user());
        return response()->json($transaction);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, TransactionService $service)
    {
        $data = Transaction::query()->find($id);
        $transaction = $service->get($data);
        return response()->json($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, TransactionService $service)
    {
        $data = $request->validated();
        $transaction = Transaction::query()->findOrFail($request->id);
        $transaction = $service->update($data, $transaction);
        return response()->json($transaction);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = DB::select('delete from transactions where id = ?', [$id]);
        return response()->json(['message' => 'Delete berhasil', $transaction]);
    }
}
