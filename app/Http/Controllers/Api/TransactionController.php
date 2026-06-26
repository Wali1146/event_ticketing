<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\User;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $service;

    public function __construct(TransactionService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function indexAdmin()
    {
        $transaction = $this->service->getAll();

        return response()->json([
            'message' => 'Data transaksi berhasil diambil',
            'data' => TransactionResource::collection($transaction),
        ], 200);
    }

    /**
     * menampilkan semua transaksi berdasarkan satu user
     */
    public function indexUser(Request $request)
    {
        $id = $request->user()->id;
        $transaction = $this->service->getAllById($id);

        return response()->json([
            'message' => 'Data transaksi berhasil diambil',
            'data' => TransactionResource::collection($transaction),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $user = $request->user();
        $data = $request->validated();
        $transaction = $this->service->store($data, $user);
        return response()->json([
            'message'=>'Transaksi berhasil dibuat',
            'data'=> new TransactionResource($transaction),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $transaction = $this->service->getId($id);

        return response()->json([
            'message' => 'Data transaksi berhasil diambil',
            'data' => new TransactionResource($transaction),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, $id)
    {
        $data = $request->validated();
        $transaction = $this->service->update($data, $id);

        return response()->json([
            'message' => 'Transaksi berhasil diupdate',
            'data' => new TransactionResource($transaction),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = $this->service->destroy($id);

        return response()->json([
            'message' => 'Transaksi berhasil di hapus',
            'data' => $transaction,
        ], 200);
    }
}
