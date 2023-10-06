<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word,
            'police_number' => fake()->unique()->regexify('[A-Z]{1,2} [0-9]{1,4} [A-Z]{1,2}'), // Format plat Indonesia
            'status' => fake()->randomElement(['active', 'maintenance', 'booked', 'in_use', 'inactive']),
            'next_service' => fake()->dateTimeBetween('+1 month', '+1 year')
        ];
    }
}
