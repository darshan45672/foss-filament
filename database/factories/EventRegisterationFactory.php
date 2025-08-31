<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventRegisteration>
 */
class EventRegisterationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => EventFactory::new()->create()->id,
            'user_id' => UserFactory::new()->create()->id,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
