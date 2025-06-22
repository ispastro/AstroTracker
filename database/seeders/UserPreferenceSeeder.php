<?php

namespace Database\Seeders;

use App\Models\UserPreference;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserPreferenceSeeder extends Seeder
{
    public function run(): void
    {
        // Create preferences for all users
        User::all()->each(function ($user) {
            UserPreference::create([
                'user_id' => $user->id,
                'interested_event_types' => json_encode([
                    'meteor_shower',
                    'eclipse',
                    'planet',
                    'satellite'
                ]),
                'preferred_location' => 'Your Location',
                'latitude' => 0,
                'longitude' => 0,
                'receive_email_notifications' => true
            ]);
        });
    }
}
