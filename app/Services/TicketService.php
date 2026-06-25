<?php

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\TicketRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TicketService
{
    protected $repository;

    public function __construct(TicketRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        $ticket = $this->repository->getAll();

        return $ticket;
    }

    public function getId(int $id)
    {
        $ticket = $this->repository->getId($id);
        if (! $ticket) {
            throw ValidationException::withMessages([
                'message' => 'Tiket tidak ditemukan',
            ]);
        }
        $ticket->load('event');

        return $ticket;
    }

    public function store(array $data)
    {
        return $this->repository->post($data);
    }

    public function update(array $data, Ticket $ticket)
    {
        return DB::transaction(function () use ($data, $ticket) {
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
            $ticket = $this->repository->patch($data, $ticket);

            return $ticket;
        });
    }

    public function destroy(int $id)
    {
        $ticket = $this->repository->getId($id);
        if (! $ticket) {
            throw ValidationException::withMessages([
                'message' => 'Tiket tidak ditemukan',
            ]);
        }

        return $this->repository->delete($ticket);
    }
}
