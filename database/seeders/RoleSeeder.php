<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Assign roles to users
        $admin = User::where('email', 'test@example.com')->first();
        $admin?->roles()->attach($adminRole);

        // Create 5 more users with user role
        User::factory(5)->create()->each(function ($user) use ($userRole) {
            $user->roles()->attach($userRole);
        });
    }
}
