<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => \App\Models\Event::factory(),
            'price' => fake()->numberBetween(10, 100) * 1000,
            'quota' => fake()->numberBetween(1, 10) * 10,
            'remaining_quota' => fake()->numberBetween(1, 10) * 10,
        ];
    }
}
