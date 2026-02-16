<?php

namespace Database\Factories;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= bcrypt('hunter2'),
            'remember_token' => Str::random(10),
            'role' => UserRole::User,
            'url' => null,
            'bio' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be confirmed.
     */
    public function confirmed(): static
    {
        return $this->state(fn (array $attributes) => [
            'confirmed_at' => now(),
        ]);
    }

    /**
     * Indicate that the user is a god mode user.
     */
    public function god(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => UserRole::God,
        ]);
    }
}
