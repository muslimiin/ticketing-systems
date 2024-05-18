<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'location' => $this->faker->address,
            'province' => $this->faker->state,
            'category' => $this->faker->word,
            'description' => $this->faker->sentence,
            'information' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl,
            'start_time' => $this->faker->dateTime,
            'end_time' => $this->faker->dateTime,
        ];
    }
}
