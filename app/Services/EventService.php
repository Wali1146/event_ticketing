<?php

namespace App\Services;

use App\Repositories\EventRepository;
use Illuminate\Validation\ValidationException;

class EventService
{
    protected $repository;

    public function __construct(EventRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getId(int $id)
    {
        $event = $this->repository->getId($id);
        if (! $event) {
            throw ValidationException::withMessages([
                'message' => 'Acara tidak ditemukan',
            ]);
        }

        return $event;
    }

    public function store(array $data)
    {
        return $this->repository->post($data);
    }

    public function update(array $data, int $id)
    {
        $event = $this->repository->getId($id);
        if (! $event) {
            throw ValidationException::withMessages([
                'message' => 'Acara tidak ditemukan',
            ]);
        }

        return $this->repository->patch($data, $event);
    }

    public function destroy(int $id)
    {
        $event = $this->repository->getId($id);
        if (! $event) {
            throw ValidationException::withMessages([
                'message' => 'Acara tidak ditemukan',
            ]);
        }

        return $this->repository->delete($event);
    }
}
