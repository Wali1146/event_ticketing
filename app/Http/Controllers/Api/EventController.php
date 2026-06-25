<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Services\EventService;
use Illuminate\Support\Facades\Request;

class EventController extends Controller
{
    protected $service;

    public function __construct(EventService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = $this->service->getAll();

        return response()->json([
            'message' => 'Data acara berhasil diambil',
            'data' => EventResource::collection($events),
        ], 200);
    }

    public function indexUser(Request $request)
    {
        $id = $request->user()->id;
        $event = $this->service->getId($id);

        return response()->json([
            'message' => 'Data acara berhasil diambil',
            'data' => EventResource::collection($event),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $data = $request->validated();
        $event = $this->service->store($data);

        return response()->json([
            'message' => 'Acara berhasil dibuat',
            'data' => new EventResource($event),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $event = $this->service->getId($id);

        return response()->json([
            'message' => 'Data acara berhasil diambil',
            'data' => new EventResource($event),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, $id)
    {
        $data = $request->validated();
        $event = $this->service->update($data, $id);

        return response()->json([
            'message' => 'Acara berhasil diupdate',
            'data' => new EventResource($event),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $event = $this->service->destroy($id);

        return response()->json([
            'message' => 'Acara berhasil dihapus',
            'data' => $event,
        ], 200);
    }
}
