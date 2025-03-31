<?php

namespace Database\Seeders;

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
            'name' => env('DATABASE_SEEDER_NAME', 'Test User'),
            'email' => env('DATABASE_SEEDER_EMAIL', 'test@example.com'),
            'confirmed_at' => now(),
        ]);
    }
}
