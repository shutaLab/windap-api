<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WindNote>
 */
class WindNoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->realText(rand(15, 20)),
            'content' => $this->faker->realText(rand(20, 30)),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
