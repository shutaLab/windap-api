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
        $firstNumber = $this->faker->numberBetween(1, 99);
        $secondNumber = $this->faker->numberBetween(1, 99);
        return [
            'name' => $this->faker->realText(rand(10, 20)),
            'grade' => $this->faker->randomElement(['1', '2', '3', '4']),
            'sail_no' => "{$firstNumber}-{$secondNumber}",
            'introduction' => $this->faker->realText(rand(10, 20))
        ];
    }
}
