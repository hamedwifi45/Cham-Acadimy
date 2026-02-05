<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // كلمة مرور افتراضية
            'admin_level' => 0, // مستخدم عادي
            'profile_photo_path' => $this->faker->randomElement([
                'Tests/profile-photos/user1.jpg',
                'Tests/profile-photos/user2.jpg',
                'Tests/profile-photos/user3.jpg',
                'Tests/profile-photos/user4.jpg',
                'Tests/profile-photos/user5.jpg',
            ]),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the user should be an admin.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'admin_level' => 1,
        ]);
    }
}