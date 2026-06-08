<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1,
                'ticket_id' => 1,
                'qty' => 1,
                'total_price' => 50000,
            ],
            [
                'user_id' => 1,
                'ticket_id' => 2,
                'qty' => 3,
                'total_price' => 30000,
            ],
        ];
        foreach($data as $transaction){
            Transaction::factory()->create($transaction);
        }
    }
}
