<?php

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tickets = [
            [
                'event_id' => 1,
                'name' => 'Tribune',
                'price' => 1000000,
                'quota' => 100,
                'description' => null,
                'max_purchase' => 5,
            ],
            [
                'event_id' => 1,
                'name' => 'VIP',
                'price' => 1500000,
                'quota' => 75,
                'description' => null,
                'max_purchase' => 3,
            ],
            [
                'event_id' => 2,
                'name' => 'Bronze',
                'price' => 500000,
                'quota' => 50,
                'description' => 'Tiket Masuk',
                'max_purchase' => null,
            ],
            [
                'event_id' => 2,
                'name' => 'Silver',
                'price' => 750000,
                'quota' => 50,
                'description' => 'Tiket Masuk & Makan Siang',
                'max_purchase' => null,
            ],
            [
                'event_id' => 2,
                'name' => 'Gold',
                'price' => 1000000,
                'quota' => 20,
                'description' => 'Tiket Masuk, Makan Siang dan buku',
                'max_purchase' => 2,
            ],
        ];

        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }
    }
}
