<?php

namespace Database\Seeders;

use App\Models\Auther;
use Illuminate\Database\Seeder;

class AutherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authers = [
            [
                'name' => 'د. أحمد علي',
                'bio' => 'خبير في تطوير الويب ومؤسس أكاديمية شام. لديه أكثر من 10 سنوات من الخبرة في مجال البرمجة.',
                'profile_photo_url' => 'Tests/authers_photo/auther1.jpg',
                'area_work' => 'تطوير الويب',
                'email' => 'ahmed@chamacademy.com',
            ],
            [
                'name' => 'د. سارة محمد',
                'bio' => 'متخصصة في الذكاء الاصطناعي وتعلم الآلة. حاصلة على الدكتوراه في علوم الحاسب.',
                'profile_photo_url' => 'Tests/authers_photo/auther2.jpg',
                'area_work' => 'الذكاء الاصطناعي',
                'email' => 'sara@chamacademy.com',
            ],
            [
                'name' => 'م. خالد حسن',
                'bio' => 'خبير في التسويق الرقمي وإدارة المشاريع. عمل مع شركات عالمية في مجال التسويق.',
                'profile_photo_url' => 'Tests/authers_photo/auther3.jpg',
                'area_work' => 'التسويق الرقمي',
                'email' => 'khaled@chamacademy.com',
            ],
            [
                'name' => 'م. فاطمة الزهراء',
                'bio' => 'مصممة جرافيك محترفة ومدربة معتمدة في برامج التصميم الإبداعي.',
                'profile_photo_url' => 'Tests/authers_photo/auther4.jpg',
                'area_work' => 'التصميم الجرافيكي',
                'email' => 'fatima@chamacademy.com',
            ],
            [
                'name' => 'د. محمد عبدالله',
                'bio' => 'خبير في الأمن السيبراني وحماية البيانات. له باع طويل في مجال الحماية الإلكترونية.',
                'profile_photo_url' => 'Tests/authers_photo/auther5.jpg',
                'area_work' => 'الأمن السيبراني',
                'email' => 'mohammed@chamacademy.com',
            ],
        ];

        foreach ($authers as $autherData) {
            if (! Auther::where('email', $autherData['email'])->exists()) {
                Auther::create($autherData);
            }
        }

        Auther::factory()->count(5)->create();
    }
}
