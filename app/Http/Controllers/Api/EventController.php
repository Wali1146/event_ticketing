<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\UpdateEventRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Controllers\Controller;
use App\Models\Event;
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
        return response()->json($event);
    }

    public function indexUser(Request $request){
        $id = $request->user()->id;
        $event = DB::select('select * from events where user_id = ?', [$id]);
        return response()->json($event);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        $data = $request->validated();
        $event = Event::create($data);
        return response()->json($event);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = DB::select('select * from events where id = ?', [$id]);
        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $data = $request->validated();
        $event->update($data);
        return response()->json($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = DB::select('delete from events where id = ?', [$id]);
        return response()->json($event);
    }
}
