<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchase;
use App\Models\User;
use App\Models\Course;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // التأكد من وجود بيانات
        if (User::count() === 0) {
            $this->command->warn('⚠️ لا يوجد مستخدمين! سيتم إنشاء مستخدمين...');
            $this->call(UserSeeder::class);
        }

        if (Course::count() === 0) {
            $this->command->warn('⚠️ لا يوجد دورات! سيتم إنشاء دورات...');
            $this->call(CourseSeeder::class);
        }

        // المستخدمون العاديون فقط (ليس الأدمن)
        $users = User::where('admin_level', 0)->get();
        $courses = Course::all();

        if ($users->count() === 0 || $courses->count() === 0) {
            $this->command->error('❌ لا يمكن إنشاء مشتريات بدون مستخدمين ودورات!');
            return;
        }

        // ==================== المشتريات المكتملة ====================
        $completedPurchases = [
            // المستخدم 1 - أحمد
            [
                'user_id' => $users[0]->id,
                'course_id' => $courses[0]->id, // Python
                'amount' => $courses[0]->price,
                'payment_id' => 'stripe_' . uniqid(),
                'status' => 'completed',
            ],
            [
                'user_id' => $users[0]->id,
                'course_id' => $courses[3]->id, // Digital Marketing
                'amount' => $courses[3]->price,
                'payment_id' => 'stripe_' . uniqid(),
                'status' => 'completed',
            ],
            // المستخدم 2 - سارة
            [
                'user_id' => $users[1]->id,
                'course_id' => $courses[1]->id, // Laravel
                'amount' => $courses[1]->price,
                'payment_id' => 'stripe_' . uniqid(),
                'status' => 'completed',
            ],
            [
                'user_id' => $users[1]->id,
                'course_id' => $courses[6]->id, // Excel
                'amount' => $courses[6]->price,
                'payment_id' => 'stripe_' . uniqid(),
                'status' => 'completed',
            ],
            // المستخدم 3 - محمد
            [
                'user_id' => $users[2]->id,
                'course_id' => $courses[2]->id, // AI
                'amount' => $courses[2]->price,
                'payment_id' => 'stripe_' . uniqid(),
                'status' => 'completed',
            ],
            [
                'user_id' => $users[2]->id,
                'course_id' => $courses[4]->id, // Design
                'amount' => $courses[4]->price,
                'payment_id' => 'stripe_' . uniqid(),
                'status' => 'completed',
            ],
            // المستخدم 4 - فاطمة
            [
                'user_id' => $users[3]->id,
                'course_id' => $courses[5]->id, // Security
                'amount' => $courses[5]->price,
                'payment_id' => 'stripe_' . uniqid(),
                'status' => 'completed',
            ],
            [
                'user_id' => $users[3]->id,
                'course_id' => $courses[9]->id, // E-commerce
                'amount' => $courses[9]->price,
                'payment_id' => 'stripe_' . uniqid(),
                'status' => 'completed',
            ],
        ];

        // ==================== المشتريات المعلقة ====================
        $pendingPurchases = [
            [
                'user_id' => $users[0]->id,
                'course_id' => $courses[7]->id, // Mobile App
                'amount' => $courses[7]->price,
                'payment_id' => 'stripe_' . uniqid(),
                'status' => 'pending',
            ],
            [
                'user_id' => $users[1]->id,
                'course_id' => $courses[8]->id, // Project Management
                'amount' => $courses[8]->price,
                'payment_id' => 'stripe_' . uniqid(),
                'status' => 'pending',
            ],
        ];

        // ==================== المشتريات الفاشلة ====================
        $failedPurchases = [
            [
                'user_id' => $users[2]->id,
                'course_id' => $courses[3]->id, // Digital Marketing
                'amount' => $courses[3]->price,
                'payment_id' => 'stripe_' . uniqid(),
                'status' => 'failed',
            ],
        ];

        $allPurchases = array_merge($completedPurchases, $pendingPurchases, $failedPurchases);

        foreach ($allPurchases as $purchaseData) {
            $exists = Purchase::where('user_id', $purchaseData['user_id'])
                             ->where('course_id', $purchaseData['course_id'])
                             ->exists();
            
            if (!$exists) {
                Purchase::create($purchaseData);
            }
        }

        Purchase::factory()->count(15)->create();

        $total = Purchase::count();
        $completed = Purchase::where('status', 'completed')->count();
        $pending = Purchase::where('status', 'pending')->count();
        $failed = Purchase::where('status', 'failed')->count();

        $this->command->info("✅ تم إنشاء {$total} مشتريات بنجاح!");
        $this->command->info("   - مكتملة: {$completed}");
        $this->command->info("   - معلقة: {$pending}");
        $this->command->info("   - فاشلة: {$failed}");
    }
}