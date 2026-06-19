<?php

namespace App\Http\Controllers\APi;

use App\Models\Ticket;
use App\Services\TicketService;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticket = DB::select('select * from tickets');
        return response()->json($ticket);
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
        $ticket = Ticket::query()->find($request->id);
        $event = $ticket->event;
        $ticket = $service->update($data, $ticket, $event);
        return response()->json($ticket);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = DB::select('delete from tickets where id = ?', [$id]);
        return response()->json(['message' => 'Delete berhasil', $ticket]);
    }
}
