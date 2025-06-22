<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Run the seeders in order
        $this->call([
            RoleSeeder::class,
            UserPreferenceSeeder::class,
            CelestialEventSeeder::class
        ]);
    }
}
