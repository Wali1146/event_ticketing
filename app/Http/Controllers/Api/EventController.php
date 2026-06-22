<?php

namespace App\Http\Controllers\API;

use App\Models\Event;
use App\Services\EventService;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event = DB::select('select * from events');
        return EventResource::collection($event);
    }

    public function indexUser(Request $request)
    {
        $id = $request->user()->id;
        $event = DB::select('select * from events where user_id = ?', [$id]);
        return response()->json($event);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request, EventService $service)
    {
        $data = $request->validated();
        $event = $service->store($data);
        return response()->json($event);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, EventService $service)
    {
        $data = Event::query()->find($id);
        $event = $service->get($data);
        if (is_array($event) && isset($event['message'])) {
            return response()->json($event);
        }
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, EventService $service)
    {
        $data = $request->validated();
        $id = Event::query()->findOrFail($request->id);
        $event = $service->update($id, $data);
        return response()->json($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, EventService $service)
    {
        $data = Event::query()->find($id);
        $event = $service->delete($data);
        return response()->json($event);
    }
}
