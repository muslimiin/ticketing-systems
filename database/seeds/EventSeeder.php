<?php

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = [
            [
                'name' => 'Event A',
                'location' => 'Lokasi A',
                'province' => 'Jakarta',
                'category' => 'Konser',
                'description' => 'Deskripsi',
                'information' => 'Informasi',
                'image' => 'event_a.jpg',
                'start_time' => Carbon::parse('2024-01-01 12:00:00'),
                'end_time' => Carbon::parse('2024-01-01 15:00:00'),
            ],
            [
                'name' => 'Event B',
                'location' => 'Lokasi B',
                'province' => 'Banten',
                'category' => 'Seminar',
                'description' => 'Deskripsi',
                'information' => 'Informasi',
                'image' => 'event_b.jpg',
                'start_time' => Carbon::parse('2024-02-01 15:45:00'),
                'end_time' => Carbon::parse('2024-02-01 19:30:00'),
            ],
            [
                'name' => 'Event B',
                'location' => 'Lokasi B',
                'province' => 'Banten',
                'category' => 'Seminar',
                'description' => 'Deskripsi',
                'information' => 'Informasi',
                'image' => 'event_b.jpg',
                'start_time' => Carbon::parse('2024-02-02 08:00:00'),
                'end_time' => Carbon::parse('2024-02-02 11:30:00'),
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
