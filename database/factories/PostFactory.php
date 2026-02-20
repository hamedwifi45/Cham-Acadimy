<?php

namespace Database\Factories;

use App\Models\Auther;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // اختيار مؤلف عشوائي
        $auther = Auther::inRandomOrder()->first()
               ?? Auther::factory()->create();

        return [
            'title' => $this->faker->sentence(6),
            'body' => $this->faker->paragraphs(5, true),
            'auther_id' => $auther->id,
        ];
    }

    /**
     * Indicate that the post is about programming.
     */
    public function programming(): static
    {
        return $this->state(fn (array $attributes) => [
            'title' => $this->faker->randomElement([
                'أساسيات البرمجة للمبتدئين',
                'نصائح لتحسين كودك البرمجي',
                'أفضل لغات البرمجة لعام 2026',
                'كيف تصبح مبرمج محترف؟',
            ]),
        ]);
    }

    /**
     * Indicate that the post is about marketing.
     */
    public function marketing(): static
    {
        return $this->state(fn (array $attributes) => [
            'title' => $this->faker->randomElement([
                'استراتيجيات التسويق الرقمي الحديثة',
                'كيف تزيد مبيعاتك عبر الإنترنت؟',
                'أسرار النجاح في التسويق بالمحتوى',
                'أدوات التسويق التي يجب أن تعرفها',
            ]),
        ]);
    }

    /**
     * Indicate that the post is about design.
     */
    public function design(): static
    {
        return $this->state(fn (array $attributes) => [
            'title' => $this->faker->randomElement([
                'مبادئ التصميم الجرافيكي',
                'كيف تختار الألوان المناسبة لتصاميمك؟',
                'أفضل برامج التصميم للمبتدئين',
                'نصائح لتصميم شعار احترافي',
            ]),
        ]);
    }
}
