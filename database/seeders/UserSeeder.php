<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the users table.
     */
    public function run(): void
    {
        User::factory()->god()->confirmed()->create([
            'name' => env('DB_SEEDER_NAME', 'Test User'),
            'email' => env('DB_SEEDER_EMAIL', 'test@example.com'),
            'password' => env('DB_SEEDER_PASSWORD', 'hunter2'),
        ]);

        User::factory(10)->confirmed()->create();
    }
}
