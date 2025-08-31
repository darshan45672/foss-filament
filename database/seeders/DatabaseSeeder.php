<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\EventRegisteration;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


        Event::factory()->create([
            'name' => 'Sample Event',
            'location' => 'Sample Location',
            'event_date' => now()->addDays(7),
            'description' => 'This is a sample event.',
            'registration_open' => true,
        ]);

        EventRegisteration::factory()->create([
            'event_id' => Event::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'status' => 'pending',
        ]);

    }
}
