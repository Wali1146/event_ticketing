<?php

namespace App\Repositories;

use App\Models\Event;

class EventRepository
{
    public function getAll()
    {
        return Event::all();
    }

    public function getId(int $id): ?Event
    {
        return Event::query()->find($id);
    }

    public function post(array $data): Event
    {
        return Event::query()->create($data);
    }

    public function patch(array $data, Event $event): Event
    {
        $event->update($data);
        return $event;
    }

    public function delete(Event $event)
    {
        return $event->delete();
    }
}
