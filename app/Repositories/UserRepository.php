<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getAll()
    {
        return User::all();
    }

    public function getId(int $id): ?User
    {
        return User::query()->find($id);
    }

    public function getAllByRole(){
        return User::query();
    }

    public function post(array $data): User
    {
        return User::query()->create($data);
    }

    public function patch(array $data, User $user): User
    {
        $user->update($data);
        return $user;
    }

    public function delete(User $user)
    {
        return $user->delete();
    }
}
