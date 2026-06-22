<?php

namespace App\Http\Controllers\API;

use App\Models\Transaction;
use App\Services\TransactionService;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use Illuminate\Support\Facades\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexAdmin()
    {
        $transaction = Transaction::all();
        return TransactionResource::collection($transaction);
    }

    /**
     * menampilkan semua transaksi berdasarkan satu user
     */
    public function indexUser(Request $request)
    {
        $id = $request->user()->id;
        $transaction = Transaction::query()->where('user_id', $id)->get();
        return TransactionResource::collection($transaction);
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
        if (is_array($transaction) && isset($transaction['message'])) {
            return response()->json($transaction);
        }
        return new TransactionResource($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, TransactionService $service)
    {
        $data = $request->validated();
        $id = Transaction::query()->findOrFail($request->id);
        $transaction = $service->update($data, $id);
        return response()->json($transaction);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, TransactionService $service)
    {
        $data = Transaction::query()->find($id);
        $transaction = $service->delete($data);
        return response()->json($transaction);
    }
}
