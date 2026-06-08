<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'role' => 'user',
            ],
            [
                'name' => 'Test Admin',
                'email' => 'admin@example.com',
                'role' => 'admin',
            ]
        ];
        foreach($data as $user){
            User::factory()->create($user);
        }
    }
}
