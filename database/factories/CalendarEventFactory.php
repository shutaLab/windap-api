<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CalendarEvent>
 */
class CalendarEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->realText(rand(10, 15)),
            'content' => $this->faker->realText(rand(10, 20)),
            'start_date' => now(),
            'end_date' => now(),
            'is_absent' => true
        ];
    }
}
