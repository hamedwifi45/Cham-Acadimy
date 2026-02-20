<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * قائمة الفيديوهات المتاحة في مجلد Tests/course-videos/
     */
    private array $availableVideos = [
        'python-intro.mp4',
        'laravel-intro.mp4',
        'ai-intro.mp4',
        'marketing-intro.mp4',
        'design-intro.mp4',
        'security-intro.mp4',
        'excel-intro.mp4',
        'mobile-intro.mp4',
        'project-intro.mp4',
        'ecommerce-intro.mp4',
        'intro1.mp4',
        'intro2.mp4',
        'intro3.mp4',
        'intro4.mp4',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // التأكد من وجود دورات
        if (Course::count() === 0) {
            $this->command->warn('⚠️ لا يوجد دورات! سيتم إنشاء دورات...');
            $this->call(CourseSeeder::class);
        }

        $courses = Course::all();

        if ($courses->count() === 0) {
            $this->command->error('❌ لا يمكن إنشاء دروس بدون دورات!');

            return;
        }

        // ==================== دروس دورة Python ====================
        $pythonLessons = [
            [
                'title' => 'مقدمة في لغة Python',
                'content' => 'في هذا الدرس، سنستعرض مقدمة شاملة عن لغة Python ولماذا تعتبر من أفضل لغات البرمجة للمبتدئين. سنتعرف على تاريخ اللغة ومجالات استخدامها المختلفة.',
                'course_id' => $courses[0]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 1,
                'duration_minutes' => 12,
            ],
            [
                'title' => 'تثبيت Python وإعداد البيئة',
                'content' => 'سنتعلم في هذا الدرس كيفية تثبيت Python على مختلف أنظمة التشغيل (Windows, macOS, Linux) وكيفية إعداد بيئة التطوير باستخدام VS Code.',
                'course_id' => $courses[0]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 2,
                'duration_minutes' => 15,
            ],
            [
                'title' => 'المتغيرات والأنواع البيانات',
                'content' => 'فهم المتغيرات والأنواع المختلفة للبيانات في Python (أرقام، نصوص، قوائم، قواميس). سنتعلم كيفية إعلان المتغيرات واستخدامها.',
                'course_id' => $courses[0]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 3,
                'duration_minutes' => 18,
            ],
            [
                'title' => 'العمليات والمعاملات',
                'content' => 'تعلم العمليات الحسابية والمنطقية في Python. سنتعرف على المعاملات المختلفة وكيفية استخدامها في البرمجة.',
                'course_id' => $courses[0]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 4,
                'duration_minutes' => 14,
            ],
            [
                'title' => 'الهياكل الشرطية (If-Else)',
                'content' => 'فهم كيفية اتخاذ القرارات في الكود باستخدام الهياكل الشرطية. سنتعلم استخدام if، elif، وelse.',
                'course_id' => $courses[0]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 5,
                'duration_minutes' => 16,
            ],
            [
                'title' => 'الحلقات التكرارية (Loops)',
                'content' => 'تعلم استخدام الحلقات التكرارية for وwhile في Python. سنتعرف على كيفية تكرار الكود لتنفيذ مهام متعددة.',
                'course_id' => $courses[0]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 6,
                'duration_minutes' => 20,
            ],
            [
                'title' => 'الدوال (Functions)',
                'content' => 'فهم كيفية إنشاء واستخدام الدوال في Python. سنتعلم كيفية تنظيم الكود وإعادة استخدامه.',
                'course_id' => $courses[0]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 7,
                'duration_minutes' => 22,
            ],
            [
                'title' => 'القوائم والمصفوفات',
                'content' => 'تعلم العمل مع القوائم والمصفوفات في Python. سنتعرف على العمليات المختلفة التي يمكن تنفيذها على القوائم.',
                'course_id' => $courses[0]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 8,
                'duration_minutes' => 19,
            ],
            [
                'title' => 'المشاريع العملية',
                'content' => 'تطبيق عملي على كل ما تعلمناه في الدورة. سنبني معاً مشروع صغير يجمع جميع المفاهيم التي درسناها.',
                'course_id' => $courses[0]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 9,
                'duration_minutes' => 25,
            ],
        ];

        // ==================== دروس دورة Laravel ====================
        $laravelLessons = [
            [
                'title' => 'مقدمة في إطار عمل Laravel',
                'content' => 'مقدمة شاملة عن Laravel وأهميته في تطوير تطبيقات الويب. سنتعرف على مميزات الإطار وأسباب شعبيته.',
                'course_id' => $courses[1]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 1,
                'duration_minutes' => 14,
            ],
            [
                'title' => 'تثبيت Laravel وإعداد المشروع',
                'content' => 'تعلم كيفية تثبيت Laravel وإنشاء مشروع جديد. سنتعرف على متطلبات التثبيت وأفضل الممارسات.',
                'course_id' => $courses[1]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 2,
                'duration_minutes' => 18,
            ],
            [
                'title' => 'Routing وMiddleware',
                'content' => 'فهم نظام Routing في Laravel وكيفية إنشاء routes مختلفة. سنتعلم أيضاً استخدام Middleware لحماية المسارات.',
                'course_id' => $courses[1]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 3,
                'duration_minutes' => 22,
            ],
            [
                'title' => 'Controllers والطرق المختلفة',
                'content' => 'تعلم إنشاء واستخدام Controllers في Laravel. سنتعرف على أنواع الـ Controllers المختلفة وأفضل الممارسات.',
                'course_id' => $courses[1]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 4,
                'duration_minutes' => 20,
            ],
            [
                'title' => 'Blade Templates',
                'content' => 'فهم نظام القوالب Blade في Laravel. سنتعلم كيفية إنشاء قوالب ديناميكية وإعادة استخدامها.',
                'course_id' => $courses[1]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 5,
                'duration_minutes' => 25,
            ],
            [
                'title' => 'قاعدة البيانات والـ Eloquent ORM',
                'content' => 'تعلم العمل مع قواعد البيانات في Laravel باستخدام Eloquent ORM. سنتعرف على migrations، models، وrelationships.',
                'course_id' => $courses[1]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 6,
                'duration_minutes' => 30,
            ],
            [
                'title' => 'الـ Forms والـ Validation',
                'content' => 'فهم كيفية إنشاء ومعالجة النماذج في Laravel. سنتعلم استخدام الـ validation للتحقق من صحة البيانات.',
                'course_id' => $courses[1]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 7,
                'duration_minutes' => 24,
            ],
            [
                'title' => 'الـ Authentication والـ Authorization',
                'content' => 'تعلم كيفية إضافة نظام تسجيل الدخول والصلاحيات في تطبيقات Laravel. سنتعرف على الـ guards والـ policies.',
                'course_id' => $courses[1]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 8,
                'duration_minutes' => 28,
            ],
            [
                'title' => 'API Development',
                'content' => 'بناء واجهات برمجة التطبيقات (API) باستخدام Laravel. سنتعلم إنشاء RESTful APIs وتوثيقها.',
                'course_id' => $courses[1]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 9,
                'duration_minutes' => 32,
            ],
            [
                'title' => 'المشاريع العملية',
                'content' => 'تطبيق عملي على كل ما تعلمناه. سنبني معاً تطبيق ويب كامل باستخدام Laravel.',
                'course_id' => $courses[1]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 10,
                'duration_minutes' => 40,
            ],
        ];

        // ==================== دروس دورة الذكاء الاصطناعي ====================
        $aiLessons = [
            [
                'title' => 'مقدمة في الذكاء الاصطناعي',
                'content' => 'مقدمة شاملة عن الذكاء الاصطناعي وتاريخه. سنتعرف على التطبيقات المختلفة والمستقبل المتوقع.',
                'course_id' => $courses[2]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 1,
                'duration_minutes' => 18,
            ],
            [
                'title' => 'أساسيات تعلم الآلة',
                'content' => 'فهم المفاهيم الأساسية لتعلم الآلة وأنواعه المختلفة (مشرف، غير مشرف، تعزيزي).',
                'course_id' => $courses[2]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 2,
                'duration_minutes' => 25,
            ],
            [
                'title' => 'معالجة البيانات',
                'content' => 'تعلم كيفية جمع ومعالجة البيانات للتعلم الآلي. سنتعرف على تقنيات التنظيف والتحويل.',
                'course_id' => $courses[2]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 3,
                'duration_minutes' => 28,
            ],
            [
                'title' => 'الخوارزميات الأساسية',
                'content' => 'دراسة الخوارزميات الأساسية في تعلم الآلة مثل الانحدار، التصنيف، والتجميع.',
                'course_id' => $courses[2]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 4,
                'duration_minutes' => 35,
            ],
            [
                'title' => 'التقييم والتحسين',
                'content' => 'تعلم كيفية تقييم نماذج التعلم الآلي وتحسين أدائها. سنتعرف على المقاييس المختلفة.',
                'course_id' => $courses[2]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 5,
                'duration_minutes' => 30,
            ],
            [
                'title' => 'الشبكات العصبية',
                'content' => 'مقدمة عن الشبكات العصبية وتعلم العميق. سنتعرف على بنية الشبكات وأنواعها.',
                'course_id' => $courses[2]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 6,
                'duration_minutes' => 40,
            ],
            [
                'title' => 'معالجة اللغة الطبيعية',
                'content' => 'تعلم أساسيات معالجة اللغة الطبيعية وتطبيقاتها. سنتعرف على تقنيات تحليل النصوص.',
                'course_id' => $courses[2]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 7,
                'duration_minutes' => 32,
            ],
            [
                'title' => 'رؤية الحاسوب',
                'content' => 'فهم أساسيات رؤية الحاسوب والتعرف على الصور. سنتعرف على التطبيقات المختلفة.',
                'course_id' => $courses[2]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 8,
                'duration_minutes' => 38,
            ],
        ];

        // ==================== دروس دورة التسويق الرقمي ====================
        $marketingLessons = [
            [
                'title' => 'مقدمة في التسويق الرقمي',
                'content' => 'فهم مفهوم التسويق الرقمي وأهميته في العصر الحديث. سنتعرف على القنوات المختلفة.',
                'course_id' => $courses[3]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 1,
                'duration_minutes' => 15,
            ],
            [
                'title' => 'استراتيجيات التسويق',
                'content' => 'تعلم إنشاء استراتيجيات تسويق رقمي فعالة. سنتعرف على تحديد الأهداف والجمهور.',
                'course_id' => $courses[3]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 2,
                'duration_minutes' => 20,
            ],
            [
                'title' => 'تحسين محركات البحث (SEO)',
                'content' => 'فهم أساسيات تحسين محركات البحث وكيفية تحسين ظهور موقعك في نتائج البحث.',
                'course_id' => $courses[3]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 3,
                'duration_minutes' => 25,
            ],
            [
                'title' => 'التسويق عبر وسائل التواصل',
                'content' => 'تعلم استراتيجيات التسويق عبر منصات التواصل الاجتماعي المختلفة.',
                'course_id' => $courses[3]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 4,
                'duration_minutes' => 22,
            ],
            [
                'title' => 'التسويق بالمحتوى',
                'content' => 'فهم أهمية المحتوى في التسويق الرقمي وكيفية إنشاء محتوى فعال.',
                'course_id' => $courses[3]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 5,
                'duration_minutes' => 24,
            ],
            [
                'title' => 'الإعلانات المدفوعة',
                'content' => 'تعلم كيفية إنشاء وإدارة حملات إعلانية مدفوعة على مختلف المنصات.',
                'course_id' => $courses[3]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 6,
                'duration_minutes' => 28,
            ],
            [
                'title' => 'تحليل البيانات',
                'content' => 'فهم كيفية تحليل بيانات التسويق الرقمي واتخاذ قرارات مستندة للبيانات.',
                'course_id' => $courses[3]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 7,
                'duration_minutes' => 26,
            ],
            [
                'title' => 'المشاريع العملية',
                'content' => 'تطبيق عملي على إنشاء خطة تسويق رقمي كاملة.',
                'course_id' => $courses[3]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 8,
                'duration_minutes' => 30,
            ],
        ];

        // ==================== دروس دورة التصميم الجرافيكي ====================
        $designLessons = [
            [
                'title' => 'مقدمة في التصميم الجرافيكي',
                'content' => 'فهم مفاهيم التصميم الجرافيكي وأهميته في العصر الرقمي.',
                'course_id' => $courses[4]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 1,
                'duration_minutes' => 16,
            ],
            [
                'title' => 'مبادئ التصميم',
                'content' => 'تعلم المبادئ الأساسية للتصميم مثل التوازن، التباين، والمحاذاة.',
                'course_id' => $courses[4]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 2,
                'duration_minutes' => 22,
            ],
            [
                'title' => 'نظرية الألوان',
                'content' => 'فهم نظرية الألوان وكيفية اختيار الألوان المناسبة للتصاميم.',
                'course_id' => $courses[4]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 3,
                'duration_minutes' => 20,
            ],
            [
                'title' => 'الخطوط والطباعة',
                'content' => 'تعلم أساسيات اختيار الخطوط واستخدامها في التصاميم.',
                'course_id' => $courses[4]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 4,
                'duration_minutes' => 18,
            ],
            [
                'title' => 'أدوات التصميم',
                'content' => 'مقدمة عن أدوات التصميم المختلفة مثل Photoshop وIllustrator.',
                'course_id' => $courses[4]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 5,
                'duration_minutes' => 25,
            ],
            [
                'title' => 'تصميم الشعارات',
                'content' => 'تعلم كيفية تصميم شعارات احترافية للشركات والعلامات التجارية.',
                'course_id' => $courses[4]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 6,
                'duration_minutes' => 28,
            ],
            [
                'title' => 'تصميم المطبوعات',
                'content' => 'فهم أساسيات تصميم المطبوعات مثل الكتيبات والملصقات.',
                'course_id' => $courses[4]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 7,
                'duration_minutes' => 24,
            ],
            [
                'title' => 'تصميم الويب',
                'content' => 'تعلم أساسيات تصميم واجهات المواقع والتطبيقات.',
                'course_id' => $courses[4]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 8,
                'duration_minutes' => 26,
            ],
            [
                'title' => 'المشاريع العملية',
                'content' => 'تطبيق عملي على إنشاء تصاميم مختلفة.',
                'course_id' => $courses[4]->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => 9,
                'duration_minutes' => 35,
            ],
        ];

        // دمج جميع الدروس
        $allLessons = array_merge(
            $pythonLessons,
            $laravelLessons,
            $aiLessons,
            $marketingLessons,
            $designLessons
        );

        // إنشاء الدروس
        foreach ($allLessons as $lessonData) {
            // تجنب التكرار
            $exists = Lesson::where('title', $lessonData['title'])
                ->where('course_id', $lessonData['course_id'])
                ->exists();

            if (! $exists) {
                Lesson::create($lessonData);
            }
        }

        // إنشاء 20 درساً إضافياً عشوائياً
        $this->createRandomLessons(20);

        // إحصائيات
        $total = Lesson::count();
        $byCourse = [];
        foreach ($courses as $course) {
            $byCourse[$course->name_ar] = Lesson::where('course_id', $course->id)->count();
        }

        $this->command->info("✅ تم إنشاء {$total} درس بنجاح!");
        $this->command->info('📊 توزيع الدروس على الدورات:');
        foreach ($byCourse as $courseName => $count) {
            $this->command->info("   - {$courseName}: {$count} درس");
        }
        $this->command->info('🎬 جميع الدروس تستخدم فيديوهات عشوائية من: Tests/course-videos/');
    }

    /**
     * الحصول على فيديو عشوائي من القائمة
     */
    private function getRandomVideo(): string
    {
        $randomVideo = $this->availableVideos[array_rand($this->availableVideos)];

        return "Tests/course-videos/{$randomVideo}"; // ✅ المسار الموحد
    }

    /**
     * إنشاء دروس عشوائية إضافية
     */
    private function createRandomLessons(int $count): void
    {
        $courses = Course::all();

        for ($i = 0; $i < $count; $i++) {
            Lesson::create([
                'title' => 'درس تجريبي '.($i + 1),
                'content' => 'محتوى درس تجريبي رقم '.($i + 1),
                'course_id' => $courses->random()->id,
                'video_url' => $this->getRandomVideo(), // ✅ فيديو عشوائي
                'order' => rand(1, 20),
                'duration_minutes' => rand(5, 45),
            ]);
        }

        $this->command->info("✅ تم إنشاء {$count} درس تجريبي إضافي.");
    }
}
