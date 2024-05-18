<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'transaction_date' => now(),
            'event_id' => \App\Models\Event::factory(),
            'ticket_id' => \App\Models\Ticket::factory(),
            'price' => $this->faker->numberBetween(10000, 500000),
            'quantity' => $this->faker->numberBetween(1, 5),
            'buyer_name' => $this->faker->name,
            'buyer_email' => $this->faker->email,
            'buyer_phone' => $this->faker->phoneNumber,
        ];
    }
}
