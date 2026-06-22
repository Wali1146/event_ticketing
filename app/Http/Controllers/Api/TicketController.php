<?php

namespace App\Http\Controllers\APi;

use App\Models\Ticket;
use App\Services\TicketService;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticket = Ticket::all();
        return TicketResource::collection($ticket);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $data = $request->validated();
        $ticket = Ticket::create($data);
        return response()->json($ticket);
    }

    /**
     * Display the specified resource.
     */
    public function show($id, TicketService $service)
    {
        $data = Ticket::query()->find($id);
        $ticket = $service->get($data);
        if (is_array($ticket) && isset($ticket['message'])) {
            return response()->json($ticket);
        }
        return new TicketResource($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, TicketService $service)
    {
        $data = $request->validated();
        $id = Ticket::query()->findOrFail($request->id);
        $event = $id->event;
        $ticket = $service->update($data, $id, $event);
        return response()->json($ticket);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, TicketService $service)
    {
        $data = Ticket::query()->find($id);
        $ticket = $service->delete($data);
        return response()->json($ticket);
    }
}
