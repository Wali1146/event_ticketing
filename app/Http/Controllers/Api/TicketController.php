<?php

namespace App\Http\Controllers\APi;

use App\Services\TicketService;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

class TicketController extends Controller
{
    protected $service;

    public function __construct(TicketService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticket = $this->service->getAll();

        return response()->json([
            'message' => 'Data tiket berhasil diambil',
            'data' => TicketResource::collection($ticket),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $data = $request->validated();
        $ticket = $this->service->store($data);

        return response()->json([
            'message' => 'Tiket berhasil dibuat',
            'data' => new TicketResource($ticket),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $ticket = $this->service->getId($id);

        return response()->json([
            'message' => 'Data tiket berhasil diambil',
            'data' => new TicketResource($ticket),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, $id)
    {
        $data = $request->validated();
        $ticket = $this->service->update($data, $id);

        return response()->json([
            'message' => 'Tiket berhasil diupdate',
            'data' => new TicketResource($ticket),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $ticket = $this->service->destroy($id);

        return response()->json([
            'message' => 'Tiket berhasil dihapus',
            'data' => $ticket,
        ], 200);
    }
}
