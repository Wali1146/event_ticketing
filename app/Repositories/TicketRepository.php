<?php

namespace App\Repositories;

use App\Models\Ticket;

class TicketRepository
{
    public function getAll()
    {
        return Ticket::all();
    }

    public function getId(int $id): ?Ticket
    {
        return Ticket::find($id);
    }

    public function post(array $data): Ticket
    {
        return Ticket::query()->create($data);
    }

    public function patch(array $data, Ticket $ticket): Ticket
    {
        $ticket->update($data);
        return $ticket;
    }

    public function delete(Ticket $ticket)
    {
        return $ticket->delete();
    }
}
