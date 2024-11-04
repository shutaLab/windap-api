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
        $start = $this->faker->dateTimeBetween('now', '+30 days')->format('Y-m-d');
        $end = $this->faker->dateTimeBetween($start, '+30 days')->format('Y-m-d');
        return [
            'title' => $this->faker->realText(rand(10, 15)),
            'content' => $this->faker->realText(rand(10, 20)),
            'start' => $start,
            'end' => $end,
            'is_absent' => $this->faker->boolean(50)
        ];
    }
}
