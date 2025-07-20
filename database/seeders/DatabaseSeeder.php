<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
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
            'name' => env('SEED_USER_NAME', 'Test User'),
            'email' => env('SEED_USER_EMAIL', 'test@example.com'),
            'password' => env('SEED_USER_PASSWORD', 'hunter2'),
            'role' => UserRole::Staff,
        ]);
    }
}
