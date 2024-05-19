<?php

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactions = [
            [
                'event_id' => 1,
                'ticket_id' => 1,
                'quantity' => 3,
                'price' => 1000000,
                'total' => 3000000,
                'buyer_name' => 'John Doe',
                'buyer_email' => 'johndoe@example.com',
                'buyer_phone' => '08123456789',
                'transaction_date' => Carbon::parse('2023-12-20 11:30:00'),
            ],
            [
                'event_id' => 1,
                'ticket_id' => 2,
                'quantity' => 2,
                'price' => 1500000,
                'total' => 3000000,
                'buyer_name' => 'Jane Smith',
                'buyer_email' => 'janesmith@example.com',
                'buyer_phone' => '08234567890',
                'transaction_date' => Carbon::parse('2023-12-27 10:36:20'),
            ],
            [
                'event_id' => 2,
                'ticket_id' => 5,
                'quantity' => 2,
                'price' => 1000000,
                'total' => 2000000,
                'buyer_name' => 'Alice Johnson',
                'buyer_email' => 'alicejohnson@example.com',
                'buyer_phone' => '08345678901',
                'transaction_date' => Carbon::parse('2024-01-11 16:23:56'),
            ],
        ];

        foreach ($transactions as $transaction) {
            Transaction::create($transaction);
        }
    }
}
