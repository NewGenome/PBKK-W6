<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the user is an ITS student with a realistic student ID email.
     *
     * Format: 50XXYY1ZZZ@student.its.ac.id
     *   XX  = department code (01-40)
     *   YY  = enrollment year (2 digits)
     *   ZZZ = registration number (001-250)
     */
    public function itsStudent(): static
    {
        return $this->state(fn (array $attributes) => [
            'email' => $this->generateUniqueItsEmail(),
        ]);
    }

    /**
     * Build a unique ITS student email, retrying on collision.
     *
     * Uniqueness is enforced on the full email string, not the registration
     * number alone, because two students in different departments or years
     * can legitimately share the same ZZZ value.
     */
    protected function generateUniqueItsEmail(): string
    {
        do {
            $department = str_pad((string) fake()->numberBetween(1, 40), 2, '0', STR_PAD_LEFT);
            $year = fake()->randomElement(['22', '23', '24', '25']);
            $regNumber = str_pad((string) fake()->numberBetween(1, 250), 3, '0', STR_PAD_LEFT);

            $email = "50{$department}{$year}1{$regNumber}@student.its.ac.id";
        } while (User::where('email', $email)->exists());

        return $email;
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
