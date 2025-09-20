<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
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
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'address' => [
                'street' => $this->faker->streetAddress(),
                'city' => $this->faker->city(),
                'country' => $this->faker->country(),
                'zip' => $this->faker->postcode(),
            ],
            'chat_history_ai' => [],
            'balance' => $this->faker->numberBetween(0, 100000),
            'role' => $this->faker->randomElement(['admin', 'customer']),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Creates a default admin user.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'), // clave conocida
            'role' => 'admin',
        ]);
    }
}
