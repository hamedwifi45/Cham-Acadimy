<?php

namespace App\Http\Controllers;

use App\Models\Auther;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Post;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Admin extends Controller
{
    /**
     * ===============
     * لوحة التحكم
     * ===============
     */

    /**
     * عرض لوحة التحكم الرئيسية مع الإحصائيات والبيانات الحديثة
     */
    public function index()
    {
        $usercount = User::count();
        $coursecount = Course::count();
        $postcount = Post::count();
        $lessonscount = Lesson::count();
        $UserLatest = User::latest()->take(5)->get();
        $courseLatest = Course::latest()->take(3)->get();
        $PostLatest = Post::latest()->take(3)->get();
        $latestPurchases = Purchase::with(['user', 'course'])->latest()->take(4)->get();

        return view('admin.dashboard', compact('usercount', 'latestPurchases', 'UserLatest', 'courseLatest', 'PostLatest', 'coursecount', 'postcount', 'lessonscount'));
    }

    /**
     * ===============
     * إدارة المستخدمين
     * ===============
     */

    /**
     * عرض جميع المستخدمين مع ترقيم الصفحات
     */
    public function users_admin()
    {
        $users = User::latest()->paginate(10);
        $sreach = '';
        return view('admin.users.show', compact('sreach','users'));
    }

    /**
     * حذف مستخدم (مع التحقق من الصلاحيات)
     */
    public function users_delete(User $user)
    {
        if (auth()->user()->is_admin() > 0) {
            $user->delete();
            return redirect()->back()->with('success', 'تم حذف المستخدم بنجاح');
        }
    }

    /**
     * البحث في المستخدمين حسب الاسم أو البريد الإلكتروني
     */
    public function search_users(Request $query)
    {
        $query = $query->input('query');
        $sreach = $query;
        $users = User::where('name', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->paginate(10);
        return view('admin.users.show', compact('sreach','users'));
    }

    /**
     * ===============
     * إدارة الكتّاب
     * ===============
     */

    /**
     * عرض جميع الكتّاب مع ترقيم الصفحات
     */
    public function index_authers()
    {
        $authers = Auther::latest()->paginate(8);
        return view('admin.authers.show', compact('authers'));
    }

    /**
     * حذف كاتب
     */
    public function delete_authers(Auther $auther)
    {
        $auther->delete();
    }
    public function search_authers(Request $request)
    {
        $authers = Auther::where('name', 'like', '%' . $request->input('query') . '%')
            ->orWhere('bio', 'like', '%' . $request->input('query') . '%')
            ->orWhere('area_work', 'like', '%' . $request->input('query') . '%')
            ->paginate(10);
        return view('admin.authers.show', compact('authers'));
    }
    public function edit_authers(Auther $auther)
    {
        return view('admin.authers.edit', compact('auther'));
    }
    public function update_auther(Request $request, Auther $auther)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string',
            'profile_photo_url' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'area_work' => 'required|string|max:255',
            'email' => 'required|email|unique:authers,email,' . $auther->id,
        ]);

        $data = [
            'name' => $request->name,
            'bio' => $request->bio,
            'area_work' => $request->area_work,
            'email' => $request->email,
        ];

        if ($request->hasFile('profile_photo_url')) {
            if ($auther->profile_photo_url && $auther->profile_photo_url !== 'authers_photo/test.jpg') {
                Storage::disk('public')->delete($auther->profile_photo_url);
            }

            $photoPath = $request->file('profile_photo_url')->store('authers_photo', 'public');
            $data['profile_photo_url'] = $photoPath;
        }

        $auther->update($data);

        return redirect()->route('admin.authers.index')->with('success', 'تم تحديث معلومات الكاتب بنجاح.');
    }

    /**
     * حذف الكاتب
     */
    public function delete_auther(Auther $auther)
    {
        if ($auther->profile_photo_url && $auther->profile_photo_url !== 'authers_photo/test.jpg') {
            Storage::disk('public')->delete($auther->profile_photo_url);
        }

        $auther->delete();

        return redirect()->route('admin.authers.index')->with('success', 'تم حذف الكاتب بنجاح.');
    }

    /**
     * ===============
     * إدارة الدورات
     * ===============
     */

    /**
     * عرض جميع الدورات مع ترقيم الصفحات
     */
    public function index_Course()
    {
        $courses = Course::latest()->paginate(6);
        return view('admin.courses.show', compact('courses'));
    }

    /**
     * عرض صفحة تعديل الدورة
     */
    public function edit_Course(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * حذف دورة مع جميع ملفاتها ودروسها المرتبطة
     */
    public function delete_Course(Course $course)
    {
        if (auth()->user()->is_admin() > 0) {
            // حذف ملفات الدورة
            Storage::disk('public')->delete($course->video_url);
            Storage::disk('public')->delete($course->thumbnail_url);

            // حذف ملفات الدروس المرتبطة
            $cs = [];
            $sc = $course->lessons()->get();
            for ($i = 0; $i < ($course->lessons()->count()); $i++) {
                Storage::disk('public')->delete($sc[$i]->video_url);
            }

            $course->delete();
            return redirect()->back()->with('success', 'تم حذف الدورة بنجاح');
        }
    }

    /**
     * البحث في الدورات حسب العنوان أو الوصف (العربية والإنجليزية)
     */
    public function Searh_Courses(Request $query)
    {
        $query = $query->input('query');
        $courses = Course::where('name_ar', 'like', '%' . $query . '%')
            ->orWhere('name_en', 'like', '%' . $query . '%')
            ->orWhere('description_ar', 'like', '%' . $query . '%')
            ->orWhere('description_en', 'like', '%' . $query . '%')
            ->paginate(6);
        return view('admin.courses.show', compact('courses'));
    }

    /**
     * ===============
     * إدارة الدروس
     * ===============
     */

    /**
     * عرض جميع الدروس مع ترقيم الصفحات
     */
    public function index_Lesson()
    {
        $lessons = Lesson::latest()->paginate(6);
        $search = '';
        return view('admin.lessons.show', compact('search','lessons'));
    }

    /**
     * عرض صفحة تعديل الدرس
     */
    public function edit_Lesson(Lesson $lesson)
    {
        return view('admin.lessons.edit', compact('lesson'));
    }

    /**
     * حذف درس مع ملفه المرفق
     */
    public function delete_Lesson(Lesson $lesson)
    {
        if (auth()->user()->is_admin() > 0) {
            Storage::disk('public')->delete($lesson->video_url);
            $lesson->delete();
            return redirect()->back()->with('success', 'تم حذف الدرس بنجاح');
        }
    }

    /**
     * البحث في الدروس حسب العنوان أو المحتوى
     */
    public function Searh_Lessons(Request $query)
    {
        $query = $query->input('query');
        $search = $query;
        $lessons = Lesson::where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->paginate(6);
        return view('admin.lessons.show', compact('search','lessons'));
    }

    /**
     * ===============
     * إدارة المبيعات
     * ===============
     */

    /**
     * عرض صفحة المبيعات مع الإحصائيات والتفاصيل
     */
    public function index_pruches()
    {
        $totalRevenue = Purchase::where('status', 'completed')->sum('amount');
        $totalPurchases = Purchase::count();
        $completedPurchases = Purchase::where('status', 'completed')->count();
        $failedPurchases = Purchase::where('status', 'failed')->count();
        $search = '';
        $purchases = Purchase::with(['user', 'course'])
            ->latest()
            ->paginate(15);

        return view('admin.puraches.show', compact(
            'purchases',
            'totalRevenue',
            'search',
            'totalPurchases',
            'completedPurchases',
            'failedPurchases'
        ));
    }

    /**
     * عرض صفحة تعديل حالة الشراء
     */
    public function edit_pruches(Purchase $puraches)
    {
        $user = User::findOrFail($puraches->user_id);
        $course = Course::findOrFail($puraches->course_id);
        return view('admin.puraches.edit', compact('puraches', 'user', 'course'));
    }

    /**
     * تحديث حالة الشراء
     */
    public function update_pruches(Request $request, Purchase $puraches)
    {
        $puraches->update(['status' => $request->status]);
        return redirect()->route('admin.puraches.index')->with('success', 'تمت العملية بنجاح');
    }
    public function search_pruches(Request $request)
    {
        $query = $request->input('query', '');
        $status = $request->input('status', 'all');
        $searchBy = $request->input('search_by', 'payment_intent_id');
        $totalRevenue = Purchase::where('status', 'completed')->sum('amount');
        $totalPurchases = Purchase::count();
        $completedPurchases = Purchase::where('status', 'completed')->count();
        $failedPurchases = Purchase::where('status', 'failed')->count();
        $purchases = Purchase::query()
            ->with(['user', 'course']);
        if ($status !== 'all') {
            $purchases->where('status', $status);
        }
        // 
        // ملاحظة لي بعد تخرج اكمل مثل الكود بأسفل على كل صفحات
        // 
        if (!empty($query)) {
            switch ($searchBy) {
                case 'payment_intent_id':
                    $purchases->where('payment_intent_id', 'like', '%' . $query . '%');
                    break;
                case 'user':
                    $purchases->whereHas('user', function ($q) use ($query) {
                        $q->where('name', 'like', '%' . $query . '%')
                            ->orWhere('email', 'like', '%' . $query . '%');
                    });
                    break;
                case 'course':
                    $purchases->whereHas('course', function ($q) use ($query) {
                        $q->where('name_ar', 'like', '%' . $query . '%')
                            ->orWhere('name_en', 'like', '%' . $query . '%');
                    });
                    break;
            }
        }
        $purchases = $purchases->latest()->paginate(15);
        return view('admin.puraches.show', compact(
            'purchases',
            'query',
            'status',
            'searchBy',
            'totalRevenue',
            'totalPurchases',
            'completedPurchases',
            'failedPurchases'
        ));
    }
}
