<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_transaction()
    {
        $event = Event::factory()->create();
        $ticket = Ticket::factory()->create(['event_id' => $event->id, 'max_purchase' => 5]);

        $transactionData = [
            'transaction_date' => now(),
            'event_id' => $event->id,
            'ticket_id' => $ticket->id,
            'price' => $ticket->price,
            'quantity' => 3,
            'buyer_name' => 'John Doe',
            'buyer_email' => 'john@example.com',
            'buyer_phone' => '123456789',
        ];

        $response = $this->postJson('/api/transactions', $transactionData);

        $transactionData['total'] = $transactionData['price'] * $transactionData['quantity'];

        $response->assertStatus(201)
            ->assertJsonFragment($transactionData);

        $this->assertDatabaseHas('transactions', $transactionData);
    }

    public function test_cannot_exceed_max_purchase_limit()
    {
        $event = Event::factory()->create();
        $ticket = Ticket::factory()->create(['event_id' => $event->id, 'max_purchase' => 2]);

        $transactionData = [
            'transaction_date' => now(),
            'event_id' => $event->id,
            'ticket_id' => $ticket->id,
            'price' => $ticket->price,
            'quantity' => 3,
            'buyer_name' => 'John Doe',
            'buyer_email' => 'john@example.com',
            'buyer_phone' => '123456789',
        ];

        $response = $this->postJson('/api/transactions', $transactionData);

        $response->assertStatus(400)
            ->assertJsonFragment(['error' => 'Maksimal pembelian tiket terlampaui']);
    }

    public function test_can_get_transaction()
    {
        $transaction = Transaction::factory()->create();

        $response = $this->getJson('/api/transactions/' . $transaction->id);

        $response->assertStatus(200)
            ->assertJsonFragment($transaction->toArray());
    }

    public function test_can_update_transaction()
    {
        $transaction = Transaction::factory()->create();
        $updatedData = [
            'transaction_date' => now(),
            'event_id' => $transaction->event_id,
            'ticket_id' => $transaction->ticket_id,
            'price' => $transaction->price,
            'quantity' => 2,
            'buyer_name' => 'Jane Doe',
            'buyer_email' => 'jane@example.com',
            'buyer_phone' => '987654321',
        ];

        $response = $this->putJson('/api/transactions/' . $transaction->id, $updatedData);

        $updatedData['total'] = $updatedData['price'] * $updatedData['quantity'];

        $response->assertStatus(200)
            ->assertJsonFragment($updatedData);

        $this->assertDatabaseHas('transactions', $updatedData);
    }

    public function test_can_delete_transaction()
    {
        $transaction = Transaction::factory()->create();

        $response = $this->deleteJson('/api/transactions/' . $transaction->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('transactions', ['id' => $transaction->id]);
    }
}
