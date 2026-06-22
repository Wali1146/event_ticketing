<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function get(?User $user)
    {
        if (!$user) {
            return ['message' => 'User tidak ditemukan',];
        }
        return $user;
    }

    public function update(?User $user, array $data)
    {
        if (!$user) {
            return ['message' => 'User tidak ditemukan',];
        }
        $user->update($data);
        return $user;
    }

    public function delete(?User $user)
    {
        if (!$user) {
            return ['message' => 'User tidak ditemukan',];
        }
        $user->delete($user);
        return ['message' => 'User berhasil dihapus',];
    }
}
