<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AutherSeeder::class,
            CourseSeeder::class,
            LessonSeeder::class,
            PurchaseSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            CommentPostSeeder::class,
        ]);

    }
}
