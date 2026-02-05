<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommentPost>
 */
class CommentPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // اختيار مستخدم ومقالة عشوائية
        $user = User::inRandomOrder()->where('admin_level', 0)->first() 
               ?? User::factory()->create(['admin_level' => 0]);
        
        $post = Post::inRandomOrder()->first() 
              ?? Post::factory()->create();

        return [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'comment' => $this->faker->paragraph(),
        ];
    }

    /**
     * Indicate that the comment is positive.
     */
    public function positive(): static
    {
        return $this->state(fn (array $attributes) => [
            'comment' => $this->faker->randomElement([
                'مقالة رائعة ومفيدة جداً. شكراً للمؤلف!',
                'استفدت كثيراً من هذه المعلومات. شكراً جزيلاً!',
                'محتوى قيم وممتاز. أتمنى المزيد من المقالات مثل هذه.',
                'شرح مفصل وممتاز. شكراً على المجهود!',
                'معلومات جديدة ومفيدة. شكراً للمشاركة!',
            ]),
        ]);
    }

    /**
     * Indicate that the comment is a question.
     */
    public function question(): static
    {
        return $this->state(fn (array $attributes) => [
            'comment' => $this->faker->randomElement([
                'شكراً على المقالة المفيدة. لدي سؤال بخصوص...',
                'مقالة ممتازة! هل يمكن توضيح هذه النقطة أكثر؟',
                'هل يمكنك مشاركة المزيد من المصادر حول هذا الموضوع؟',
                'ما هو رأيك في...؟',
                'هل جربت هذه الطريقة في مشاريع حقيقية؟',
            ]),
        ]);
    }

    /**
     * Indicate that the comment is appreciative.
     */
    public function appreciative(): static
    {
        return $this->state(fn (array $attributes) => [
            'comment' => $this->faker->randomElement([
                'أحسنت! مقالة رائعة ومفيدة.',
                'شكراً على هذا المحتوى القيم.',
                'ممتاز! استفدت كثيراً من هذه المعلومات.',
                'مقالة ممتازة ومفيدة جداً.',
                'أحببت هذا المقال كثيراً. شكراً!',
            ]),
        ]);
    }
} 