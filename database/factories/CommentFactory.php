<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::where('admin_level', 0)->inRandomOrder()->first()
               ?? User::factory()->create(['admin_level' => 0]);

        $lesson = Lesson::inRandomOrder()->first()
                ?? Lesson::factory()->create();

        return [
            'user_id' => $user->id,
            'lesson_id' => $lesson->id,
            'parent_id' => null,
            'body' => $this->faker->paragraph(),
        ];
    }

    /**
     * Indicate that the comment is a reply.
     */
    public function reply(): static
    {
        return $this->state(function (array $attributes) {
            $parent = \App\Models\Comment::whereNull('parent_id')
                ->inRandomOrder()
                ->first();

            return [
                'parent_id' => $parent?->id,
            ];
        });
    }
}
