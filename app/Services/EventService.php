<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Validation\ValidationException;

class EventService
{
    public function get(?Event $event)
    {
        if (!$event) {
            return ['message' => 'Acara tidak ditemukan',];
        }
        return $event;
    }

    public function store(array $data)
    {
        if ($data['remaining_quota'] > $data['quota']) {
            throw ValidationException::withMessages([
                'message' => 'Sisa kuota tidak bisa melebihi batas kuota',
                'batas_kuota' => $data['quota'],
            ]);
        }
        $event = Event::create($data);
        return $event;
    }

    public function update(?Event $event, array $data)
    {
        if (!$event) {
            return ['message' => 'Acara tidak ditemukan',];
        }
        $event->update($data);
        return $event;
    }

    public function delete(?Event $event)
    {
        if (!$event) {
            return ['message' => 'Acara tidak ditemukan',];
        }
        $event->delete($event);
        return ['message' => 'Acara berhasil dihapus',];
    }
}
