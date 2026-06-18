<?php

namespace App\Services;

class EventService
{
    public function get($event)
    {
        if (!$event) {
            return ['message' => 'Acara tidak ditemukan',];
        }
        return $event;
    }
}
