<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_ticket()
    {
        $event = Event::factory()->create();

        $ticketData = [
            'event_id' => $event->id,
            'name' => 'VIP',
            'price' => 1500000,
            'quota' => 75,
            'description' => 'VIP Ticket',
            'max_purchase' => 3,
        ];

        $response = $this->postJson('/api/tickets', $ticketData);

        $response->assertStatus(201)
            ->assertJsonFragment($ticketData);

        $this->assertDatabaseHas('tickets', $ticketData);
    }

    public function test_can_get_ticket()
    {
        $ticket = Ticket::factory()->create();

        $response = $this->getJson('/api/tickets/' . $ticket->id);

        $response->assertStatus(200)
            ->assertJsonFragment($ticket->toArray());
    }

    public function test_can_update_ticket()
    {
        $ticket = Ticket::factory()->create();
        $updatedData = [
            'name' => 'Updated Ticket',
            'price' => 2000000,
            'quota' => 100,
            'description' => 'Updated Description',
            'max_purchase' => 5,
        ];

        $response = $this->putJson('/api/tickets/' . $ticket->id, $updatedData);

        $response->assertStatus(200)
            ->assertJsonFragment($updatedData);

        $this->assertDatabaseHas('tickets', $updatedData);
    }

    public function test_can_delete_ticket()
    {
        $ticket = Ticket::factory()->create();

        $response = $this->deleteJson('/api/tickets/' . $ticket->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('tickets', ['id' => $ticket->id]);
    }
}
