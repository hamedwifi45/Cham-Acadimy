<?php

namespace App\Livewire\Admin;

use App\Models\Auther;
use App\Models\Course;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateCourse extends Component
{
    use WithFileUploads;

    public $thumbnail_url;
    public $video_url;
    public $price;
    public $level;
    public $author_id;
    public $name_ar;
    public $name_en;
    public $description_ar;
    public $description_en;

    public $levels = [
    'مبتدئ' => 'مبتدئ',
    'متوسط' => 'متوسط',
    'متقدم' => 'متقدم',
    ];

    // طريقة جديدة لتحقق
    public function rules()
    {
        return [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'thumbnail_url' => 'required|image|max:2048|mimes:jpg,jpeg,png',
            'video_url' => 'required|file|max:102400|mimes:mp4,mov', // 100MB
            'price' => 'required|numeric|min:0',
            'level' => ['required', Rule::in(array_keys($this->levels))],
            'author_id' => 'required|exists:users,id',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
        ];
    }
// رسائل التحقق المخصصة
    public function messages()
    {
        return [
            'thumbnail_url.required' => 'صورة الغلاف مطلوبة',
            'thumbnail_url.image' => 'يجب أن تكون صورة',
            'thumbnail_url.max' => 'يجب أن تكون الصورة أقل من 2MB',
            'video_url.required' => 'مقطع الفيديو الدعائي مطلوب',
            'video_url.file' => 'يجب أن يكون ملف فيديو',
            'video_url.max' => 'يجب أن يكون الفيديو أقل من 100MB',
            'price.required' => 'السعر مطلوب',
            'price.numeric' => 'السعر يجب أن يكون رقمًا',
            'author_id.exists' => 'الكاتب غير موجود',
        ];
    }

    public function store(){
        if(auth()->check() && auth()->user()->is_admin() > 0){
        // الان فقط اكتب هذا
        $this->validate();
        // من هنا ابدأ بحفظ البيانات في قاعدة البيانات
        $video_url = $this->video_url->store('courses/videos', 'public');
        $thumbnail_url = $this->thumbnail_url->store('courses/covers', 'public');

        Course::create([
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'thumbnail_url' => $thumbnail_url,
            'video_url' => $video_url,
            'price' => $this->price,
            'level' => $this->level,
            'author_id' => $this->author_id,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'duration_hours' => 0,
        ]);
        return redirect()->route('admin.courses.index')->with('success', 'تم اضافة الدورة بنجاح');
        }
        else{
            abort(403,'غير مسموح للهاكر بدخول');
        }
    }





    public function render()
    {
         $authors = Auther::all();
        return view('livewire.admin.create-course' , compact('authors'));
    }   
}
