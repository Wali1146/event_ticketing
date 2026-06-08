<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'event_id' => 1,
                'price' => 50000,
                'quota' => 100,
                'remaining_quota' => 100,
            ],
            [
                'event_id' => 2,
                'price' => 10000,
                'quota' => 100,
                'remaining_quota' => 100,
            ],
        ];
        foreach($data as $ticket){
            Ticket::factory()->create($ticket);
        }
    }
}
