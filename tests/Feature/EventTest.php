<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_event()
    {
        $eventData = [
            'name' => 'Event C',
            'location' => 'Location C',
            'province' => 'Province C',
            'category' => 'Category C',
            'description' => 'Description C',
            'information' => 'Information C',
            'image' => 'image_c.jpg',
            'start_time' => '2024-05-01 10:00:00',
            'end_time' => '2024-05-01 15:00:00',
        ];

        $response = $this->postJson('/api/events', $eventData);

        $response->assertStatus(201)
            ->assertJsonFragment($eventData);

        $this->assertDatabaseHas('events', $eventData);
    }

    public function test_can_get_event()
    {
        $event = Event::factory()->create();

        $response = $this->getJson('/api/events/' . $event->id);

        $response->assertStatus(200)
            ->assertJsonFragment($event->toArray());
    }

    public function test_can_update_event()
    {
        $event = Event::factory()->create();
        $updatedData = [
            'name' => 'Updated Event',
            'location' => 'Updated Location',
            'province' => 'Updated Province',
            'category' => 'Updated Category',
            'description' => 'Updated Description',
            'information' => 'Updated Information',
            'image' => 'updated_image.jpg',
            'start_time' => '2024-06-01 10:00:00',
            'end_time' => '2024-06-01 15:00:00',
        ];

        $response = $this->putJson('/api/events/' . $event->id, $updatedData);

        $response->assertStatus(200)
            ->assertJsonFragment($updatedData);

        $this->assertDatabaseHas('events', $updatedData);
    }

    public function test_can_delete_event()
    {
        $event = Event::factory()->create();

        $response = $this->deleteJson('/api/events/' . $event->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    }
}
