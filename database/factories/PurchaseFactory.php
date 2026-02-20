<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // اختيار مستخدم ودورة عشوائية
        $user = User::inRandomOrder()->where('admin_level', 0)->first()
               ?? User::factory()->create(['admin_level' => 0]);

        $course = Course::inRandomOrder()->first()
                ?? Course::factory()->create();

        return [
            'user_id' => $user->id,
            'course_id' => $course->id,
            'amount' => $course->price,
            'payment_intent_id' => 'stripe_'.$this->faker->uuid(),
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
        ];
    }

    /**
     * Indicate that the purchase is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
        ]);
    }

    /**
     * Indicate that the purchase is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Indicate that the purchase failed.
     */
    public function failed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'failed',
        ]);
    }
}
