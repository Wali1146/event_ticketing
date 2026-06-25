<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Validation\ValidationException;

class UserService
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getId(int $id)
    {
        $user = $this->repository->getId($id);
        if (! $user) {
            throw ValidationException::withMessages([
                'message' => 'User tidak ditemukan',
            ]);
        }

        return $user;
    }

    public function store(array $data)
    {
        return $this->repository->post($data);
    }

    public function update(array $data, int $id)
    {
        $user = $this->repository->getId($id);
        if (! $user) {
            return ['message' => 'User tidak ditemukan'];
        }

        return $this->repository->patch($data, $user);
    }

    public function destroy(int $id)
    {
        $user = $this->repository->getId($id);
        if (! $user) {
            throw ValidationException::withMessages([
                'message' => 'Tiket tidak ditemukan',
            ]);
        }

        return $this->repository->delete($user);
    }
}
