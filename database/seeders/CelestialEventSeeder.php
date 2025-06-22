<?php

namespace Database\Seeders;

use App\Models\CelestialEvent;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CelestialEventSeeder extends Seeder
{
    public function run(): void
    {
        // Create some sample events
        $events = [
            [
                'title' => 'Perseid Meteor Shower',
                'description' => 'One of the most spectacular meteor showers of the year',
                'type' => 'meteor_shower',
                'starts_at' => Carbon::now()->addDays(30)->startOfDay(),
                'ends_at' => Carbon::now()->addDays(30)->addHours(6),
                'is_global' => true
            ],
            [
                'title' => 'Total Lunar Eclipse',
                'description' => 'A rare total eclipse visible from North America',
                'type' => 'eclipse',
                'starts_at' => Carbon::now()->addDays(45)->startOfDay(),
                'ends_at' => Carbon::now()->addDays(45)->addHours(3),
                'visibility_regions' => json_encode(['North America', 'Europe']),
                'is_global' => false
            ],
            [
                'title' => 'ISS Pass',
                'description' => 'International Space Station visible overhead',
                'type' => 'satellite',
                'starts_at' => Carbon::now()->addDays(7)->startOfDay(),
                'ends_at' => Carbon::now()->addDays(7)->addMinutes(15),
                'is_global' => true
            ],
            [
                'title' => 'Jupiter Opposition',
                'description' => 'Jupiter will be at its closest and brightest',
                'type' => 'planet',
                'starts_at' => Carbon::now()->addDays(60)->startOfDay(),
                'ends_at' => Carbon::now()->addDays(60)->addHours(24),
                'is_global' => true
            ],
            [
                'title' => 'Leonid Meteor Shower',
                'description' => 'Annual meteor shower from Comet Tempel-Tuttle',
                'type' => 'meteor_shower',
                'starts_at' => Carbon::now()->addDays(90)->startOfDay(),
                'ends_at' => Carbon::now()->addDays(90)->addHours(6),
                'is_global' => true
            ]
        ];

        // Create events
        foreach ($events as $eventData) {
            $event = CelestialEvent::create($eventData);

            // Subscribe some random users to the event
            $users = User::inRandomOrder()->limit(rand(1, 3))->get();
            foreach ($users as $user) {
                $event->subscriptions()->create(['user_id' => $user->id]);
            }
        }
    }
}
