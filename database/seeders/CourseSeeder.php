<?php

namespace Database\Seeders;

use App\Models\Auther;
use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // التأكد من وجود مؤلفين
        if (Auther::count() === 0) {
            $this->command->warn('⚠️ لا يوجد مؤلفين! سيتم إنشاء مؤلف تلقائي...');
            $auther = Auther::create([
                'name' => 'مؤلف تجريبي',
                'bio' => 'مؤلف تم إنشاؤه تلقائياً للدورات التجريبية',
                'profile_photo_url' => 'authers_photo/test.jpg',
                'area_work' => 'تطوير الويب',
                'email' => 'test@chamacademy.com',
            ]);
        } else {
            $authers = Auther::all();
        }

        // الدورات الثابتة
        $courses = [
            // دورة 1
            [
                'name_ar' => 'أساسيات البرمجة بلغة Python',
                'name_en' => 'Python Programming Basics',
                'description_ar' => 'تعلم أساسيات البرمجة بلغة Python من الصفر حتى الاحتراف. هذه الدورة مثالية للمبتدئين.',
                'description_en' => 'Learn Python programming from scratch to advanced. Perfect for beginners.',
                'price' => 99.99,
                'duration_hours' => 15.50,
                'level' => 'Beginner',
                'thumbnail_url' => 'Tests/course-thumbnails/python.jpg',
                'video_url' => 'Tests/course-videos/python-intro.mp4',
                'Author_id' => $authers[0]->id ?? 1,
            ],
            // دورة 2
            [
                'name_ar' => 'تطوير تطبيقات الويب باستخدام Laravel',
                'name_en' => 'Web Development with Laravel',
                'description_ar' => 'احترف تطوير تطبيقات الويب باستخدام إطار عمل Laravel القوي. من الأساسيات إلى المشاريع المتقدمة.',
                'description_en' => 'Master web development with Laravel framework. From basics to advanced projects.',
                'price' => 199.99,
                'duration_hours' => 30.00,
                'level' => 'Intermediate',
                'thumbnail_url' => 'Tests/course-thumbnails/laravel.jpg',
                'video_url' => 'Tests/course-videos/laravel-intro.mp4',
                'Author_id' => $authers[0]->id ?? 1,
            ],
            // دورة 3
            [
                'name_ar' => 'الذكاء الاصطناعي وتعلم الآلة',
                'name_en' => 'Artificial Intelligence & Machine Learning',
                'description_ar' => 'استكشف عالم الذكاء الاصطناعي وتعلم الآلة. تعلم كيفية بناء نماذج ذكية وتطبيقات متقدمة.',
                'description_en' => 'Explore AI and Machine Learning. Learn to build smart models and advanced applications.',
                'price' => 299.99,
                'duration_hours' => 40.00,
                'level' => 'Advanced',
                'thumbnail_url' => 'Tests/course-thumbnails/ai.jpg',
                'video_url' => 'Tests/course-videos/ai-intro.mp4',
                'Author_id' => $authers[1]->id ?? 1,
            ],
            // دورة 4
            [
                'name_ar' => 'التسويق الرقمي من الصفر',
                'name_en' => 'Digital Marketing from Scratch',
                'description_ar' => 'تعلم استراتيجيات التسويق الرقمي الحديثة. زيادة المبيعات وبناء العلامة التجارية عبر الإنترنت.',
                'description_en' => 'Learn modern digital marketing strategies. Increase sales and build your brand online.',
                'price' => 149.99,
                'duration_hours' => 25.00,
                'level' => 'Beginner',
                'thumbnail_url' => 'Tests/course-thumbnails/marketing.jpg',
                'video_url' => 'Tests/course-videos/marketing-intro.mp4',
                'Author_id' => $authers[2]->id ?? 1,
            ],
            // دورة 5
            [
                'name_ar' => 'تصميم الجرافيك باحترافية',
                'name_en' => 'Professional Graphic Design',
                'description_ar' => 'احترف أدوات التصميم الجرافيكي مثل Photoshop وIllustrator. إنشاء تصاميم احترافية للشركات والأفراد.',
                'description_en' => 'Master graphic design tools like Photoshop and Illustrator. Create professional designs for businesses and individuals.',
                'price' => 179.99,
                'duration_hours' => 35.00,
                'level' => 'Intermediate',
                'thumbnail_url' => 'Tests/course-thumbnails/design.jpg',
                'video_url' => 'Tests/course-videos/design-intro.mp4',
                'Author_id' => $authers[3]->id ?? 1,
            ],
            // دورة 6
            [
                'name_ar' => 'أمن الشبكات والحماية',
                'name_en' => 'Network Security & Protection',
                'description_ar' => 'تعلم أساسيات أمن الشبكات وحماية البيانات. استراتيجيات الحماية من الهجمات الإلكترونية.',
                'description_en' => 'Learn network security fundamentals and data protection. Protection strategies against cyber attacks.',
                'price' => 249.99,
                'duration_hours' => 28.50,
                'level' => 'Advanced',
                'thumbnail_url' => 'Tests/course-thumbnails/security.jpg',
                'video_url' => 'Tests/course-videos/security-intro.mp4',
                'Author_id' => $authers[4]->id ?? 1,
            ],
            // دورة 7
            [
                'name_ar' => 'تحليل البيانات باستخدام Excel',
                'name_en' => 'Data Analysis with Excel',
                'description_ar' => 'إتقان تحليل البيانات واستخدام دوال Excel المتقدمة. إنشاء تقارير ولوحات تحكم احترافية.',
                'description_en' => 'Master data analysis and advanced Excel functions. Create professional reports and dashboards.',
                'price' => 89.99,
                'duration_hours' => 20.00,
                'level' => 'Beginner',
                'thumbnail_url' => 'Tests/course-thumbnails/excel.jpg',
                'video_url' => 'Tests/course-videos/excel-intro.mp4',
                'Author_id' => $authers[0]->id ?? 1,
            ],
            // دورة 8
            [
                'name_ar' => 'تطوير تطبيقات الهاتف',
                'name_en' => 'Mobile App Development',
                'description_ar' => 'تعلم تطوير تطبيقات الهاتف لنظامي Android وiOS. من الفكرة إلى النشر في المتاجر.',
                'description_en' => 'Learn mobile app development for Android and iOS. From idea to publishing in stores.',
                'price' => 219.99,
                'duration_hours' => 45.00,
                'level' => 'Intermediate',
                'thumbnail_url' => 'Tests/course-thumbnails/mobile.jpg',
                'video_url' => 'Tests/course-videos/mobile-intro.mp4',
                'Author_id' => $authers[0]->id ?? 1,
            ],
            // دورة 9
            [
                'name_ar' => 'إدارة المشاريع الاحترافية',
                'name_en' => 'Professional Project Management',
                'description_ar' => 'احترف إدارة المشاريع باستخدام منهجيات حديثة. تعلم التخطيط والتنفيذ والمتابعة.',
                'description_en' => 'Master project management with modern methodologies. Learn planning, execution, and monitoring.',
                'price' => 159.99,
                'duration_hours' => 22.00,
                'level' => 'Intermediate',
                'thumbnail_url' => 'Tests/course-thumbnails/project.jpg',
                'video_url' => 'Tests/course-videos/project-intro.mp4',
                'Author_id' => $authers[2]->id ?? 1,
            ],
            // دورة 10
            [
                'name_ar' => 'التجارة الإلكترونية والربح من الإنترنت',
                'name_en' => 'E-commerce & Online Business',
                'description_ar' => 'تعلم كيفية بناء متجر إلكتروني ناجح وكيفية الربح من الإنترنت بطرق متعددة.',
                'description_en' => 'Learn how to build a successful online store and make money online through multiple methods.',
                'price' => 129.99,
                'duration_hours' => 18.00,
                'level' => 'Beginner',
                'thumbnail_url' => 'Tests/course-thumbnails/ecommerce.jpg',
                'video_url' => 'Tests/course-videos/ecommerce-intro.mp4',
                'Author_id' => $authers[2]->id ?? 1,
            ],
        ];

        foreach ($courses as $courseData) {
            // تجنب التكرار
            $exists = Course::where('name_ar', $courseData['name_ar'])
                ->orWhere('name_en', $courseData['name_en'])
                ->exists();

            if (! $exists) {
                Course::create($courseData);
            }
        }

        // إنشاء 10 دورات إضافية عشوائية
        Course::factory()->count(10)->create();

        $this->command->info('✅ تم إنشاء '.Course::count().' دورة بنجاح!');
    }
}
