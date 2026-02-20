<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // اختيار دورة عشوائية
        $course = Course::inRandomOrder()->first()
               ?? Course::factory()->create();

        return [
            'title' => $this->faker->sentence(5),
            'content' => $this->faker->paragraphs(3, true),
            'course_id' => $course->id,
            'video_url' => $this->faker->randomElement([
                'lessons/videos/lesson1.mp4',
                'lessons/videos/lesson2.mp4',
                'lessons/videos/lesson3.mp4',
                'lessons/videos/lesson4.mp4',
                'lessons/videos/lesson5.mp4',
            ]),
            'order' => $this->faker->numberBetween(1, 20),
            'duration_minutes' => $this->faker->numberBetween(5, 45),
        ];
    }

    /**
     * Indicate that the lesson is short (5-15 minutes).
     */
    public function short(): static
    {
        return $this->state(fn (array $attributes) => [
            'duration_minutes' => $this->faker->numberBetween(5, 15),
        ]);
    }

    /**
     * Indicate that the lesson is medium (15-30 minutes).
     */
    public function medium(): static
    {
        return $this->state(fn (array $attributes) => [
            'duration_minutes' => $this->faker->numberBetween(15, 30),
        ]);
    }

    /**
     * Indicate that the lesson is long (30-60 minutes).
     */
    public function long(): static
    {
        return $this->state(fn (array $attributes) => [
            'duration_minutes' => $this->faker->numberBetween(30, 60),
        ]);
    }
}
