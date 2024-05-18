<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    {
        return [
            'event_id' => \App\Models\Event::factory(),
            'name' => $this->faker->word,
            'price' => $this->faker->numberBetween(10000, 500000),
            'quota' => $this->faker->numberBetween(50, 200),
            'description' => $this->faker->sentence,
            'max_purchase' => $this->faker->numberBetween(1, 10),
        ];
    }
}
