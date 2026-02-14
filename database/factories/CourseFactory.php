<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Auther;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // اختيار مؤلف عشوائي
        $auther = Auther::inRandomOrder()->first() ?? Auther::factory()->create();

        return [
            'name_ar' => $this->faker->sentence(4),
            'name_en' => $this->faker->sentence(3),
            'description_ar' => $this->faker->paragraph(),
            'description_en' => $this->faker->paragraph(),
            'price' => $this->faker->randomElement([49.99, 99.99, 149.99, 199.99, 299.99, 499.99]),
            'duration_hours' => $this->faker->randomFloat(2, 2, 50),
            'level' => $this->faker->randomElement(['Beginner', 'Intermediate', 'Advanced']),
            'thumbnail_url' => $this->faker->randomElement([
                'Tests/course-thumbnails/thumb1.jpg',
                'Tests/course-thumbnails/thumb2.jpg',
                'Tests/course-thumbnails/thumb3.jpg',
                'Tests/course-thumbnails/thumb4.jpg',
                'Tests/course-thumbnails/thumb5.jpg',
                'Tests/course-thumbnails/thumb6.jpg',
                'Tests/course-thumbnails/thumb7.jpg',
                'Tests/course-thumbnails/thumb8.jpg',
            ]),
            'video_url' => $this->faker->randomElement([
                'Tests/course-videos/intro1.mp4',
                'Tests/course-videos/intro2.mp4',
                'Tests/course-videos/intro3.mp4',
                'Tests/course-videos/intro4.mp4',
            ]),
            'Author_id' => $auther->id,
        ];
    }

    /**
     * Indicate that the course is for beginners.
     */
    public function beginner(): static
    {
        return $this->state(fn (array $attributes) => [
            'level' => 'Beginner',
            'price' => $this->faker->randomElement([49.99, 79.99, 99.99]),
        ]);
    }

    /**
     * Indicate that the course is for intermediate level.
     */
    public function intermediate(): static
    {
        return $this->state(fn (array $attributes) => [
            'level' => 'Intermediate',
            'price' => $this->faker->randomElement([149.99, 199.99, 249.99]),
        ]);
    }

    /**
     * Indicate that the course is for advanced level.
     */
    public function advanced(): static
    {
        return $this->state(fn (array $attributes) => [
            'level' => 'Advanced',
            'price' => $this->faker->randomElement([299.99, 399.99, 499.99]),
        ]);
    }

    /**
     * Indicate that the course is free.
     */
    public function free(): static
    {
        return $this->state(fn (array $attributes) => [
            'price' => 0.00,
        ]);
    }
}