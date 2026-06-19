<?php

namespace App\Services;

use App\Models\Event;

class EventService
{
    public function get(?Event $event)
    {
        if (!$event) {
            return ['message' => 'Acara tidak ditemukan',];
        }
        return $event;
    }
}
