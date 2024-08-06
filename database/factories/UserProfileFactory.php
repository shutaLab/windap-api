<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->realText(rand(10, 20)),
            'grade' => $this->faker->numberBetween(1, 4),
            'sail_no' => '31-50',
            'introduction' => $this->faker->realText(rand(10, 20))
        ];
    }
}
