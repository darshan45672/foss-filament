<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'location' => $this->faker->address(),
            'event_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'description' => $this->faker->paragraph(),
            'registration_open' => $this->faker->boolean(70), // 70% chance of being true
        ];
    }
}
