<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TicketService
{
    public function get(?Ticket $ticket)
    {
        if (!$ticket) {
            return ['message' => 'Tiket tidak ditemukan'];
        }
        $ticket->load('event');
        return $ticket;
    }

    public function update(array $data, Ticket $ticket, Event $event)
    {
        return DB::transaction(function () use ($data, $ticket, $event) {
            $event = Event::query()->lockForUpdate()->findOrFail($event->id);
            if (isset($data['quota'])) {
                $update = $data['quota'];
                if ($update < $ticket->remaining_quota) {
                    throw ValidationException::withMessages([
                        'message' => 'Batas kuota tidak bisa kurang dari sisa kuota',
                        'sisa_kuota' => $ticket->remaining_quota,
                    ]);
                }
                $data['quota'] = $update;
            }
            if (isset($data['remaining_quota'])) {
                $update = $ticket->remaining_quota + $data['remaining_quota'];
                if ($update > $ticket->quota) {
                    throw ValidationException::withMessages([
                        'message' => 'Sisa kuota tidak bisa melebihi batas kuota',
                        'batas_kuota' => $ticket->quota,
                    ]);
                }
                $data['remaining_quota'] = $update;
            }
            $ticket->update($data);
            return $ticket;
        });
    }
}
