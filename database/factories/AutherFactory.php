<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auther>
 */
class AutherFactory extends Factory
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
            'bio' => $this->faker->paragraph(),
            'profile_photo_url' => $this->faker->randomElement([
                'Tests/authers_photo/auther1.jpg',
                'Tests/authers_photo/auther2.jpg',
                'Tests/authers_photo/auther3.jpg',
                'Tests/authers_photo/auther4.jpg',
                'Tests/authers_photo/auther5.jpg',
            ]),
            'area_work' => $this->faker->randomElement([
                'تطوير الويب',
                'الذكاء الاصطناعي',
                'التسويق الرقمي',
                'التصميم الجرافيكي',
                'إدارة المشاريع',
                'البرمجة',
                'الأمن السيبراني',
            ]),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }

    /**
     * Indicate that the auther is a web developer.
     */
    public function webDeveloper(): static
    {
        return $this->state(fn (array $attributes) => [
            'area_work' => 'تطوير الويب',
        ]);
    }

    /**
     * Indicate that the auther is an AI expert.
     */
    public function aiExpert(): static
    {
        return $this->state(fn (array $attributes) => [
            'area_work' => 'الذكاء الاصطناعي',
        ]);
    }
}
