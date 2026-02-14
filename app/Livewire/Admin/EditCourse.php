<?php

namespace App\Livewire\Admin;

use App\Models\Auther;
use Illuminate\Validation\Rule;
use App\Models\Course;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditCourse extends Component
{
    use WithFileUploads;

    public $thumbnail_url;
    public $video_url;
    public $id;
    public $price;
    public $level;
    public $author_id;
    public $name_ar;
    public $name_en;
    public $description_ar;
    public $description_en;
    public $current_thumbnail;
    public $current_video;

    public function mount($course){
        $this->id = $course->id;
        $this->name_ar = $course->name_ar;
        $this->name_en = $course->name_en;
        $this->current_thumbnail = $course->thumbnail_url;
        $this->current_video = $course->video_url;
        $this->price = $course->price;
        $this->author_id = $course->author_id;
        $this->level = $course->level;
        $this->description_en = $course->description_en;
        $this->description_ar = $course->description_ar;
    }
    
    public $levels = [
        'beginner' => 'beginner',
        'intermediate' => 'intermediate',
        'advanced' => 'advanced',
    ];

    public function rules()
    {
        return [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'thumbnail_url' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
            'video_url' => 'nullable|file|max:102400|mimes:mp4,mov', // 100MB
            'price' => 'required|numeric|min:0',
            'level' => ['required', Rule::in(array_keys($this->levels))],
            'author_id' => 'required|exists:users,id',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'thumbnail_url.required' => __('Cover image is required'),
            'thumbnail_url.image' => __('Must be an image'),
            'thumbnail_url.max' => __('Image must be less than 2MB'),
            'thumbnail_url.mimes' => __('Invalid image format (must be JPG, JPEG, PNG)'),
            'video_url.required' => __('Promotional video is required'),
            'video_url.file' => __('Must be a video file'),
            'video_url.max' => __('Video must be less than 100MB'),
            'video_url.mimes' => __('Invalid video format (must be MP4 or MOV)'),
            'price.required' => __('Price is required'),
            'price.numeric' => __('Price must be a number'),
            'author_id.exists' => __('Author does not exist'),
        ];
    }

    public function store(){
        if(auth()->check() && auth()->user()->is_admin()){
            $this->validate();
            
            $data = [
                'name_ar' => $this->name_ar,
                'name_en' => $this->name_en,
                'price' => $this->price,
                'level' => $this->level,
                'author_id' => $this->author_id,
                'description_ar' => $this->description_ar,
                'description_en' => $this->description_en,
                'duration_hours' => 0,
            ];

            // معالجة صورة الغلاف
            if($this->thumbnail_url) {
                // حذف الصورة القديمة إذا كانت موجودة
                if($this->current_thumbnail && Storage::disk('public')->exists($this->current_thumbnail)) {
                    Storage::disk('public')->delete($this->current_thumbnail);
                }
                
                $thumbnailPath = $this->thumbnail_url->store('courses/covers', 'public');
                $data['thumbnail_url'] = $thumbnailPath;
            }

            // معالجة الفيديو
            if($this->video_url) {
                // التحقق من صيغة الفيديو
                $allowedExtensions = ['mp4', 'mov'];
                $extension = $this->video_url->getClientOriginalExtension();
                
                if(!in_array(strtolower($extension), $allowedExtensions)) {
                    session()->flash('error', __('Unsupported video format. Please upload MP4 or MOV video'));
                    return;
                }

                // حذف الفيديو القديم إذا كان موجوداً
                if($this->current_video && Storage::disk('public')->exists($this->current_video)) {
                    Storage::disk('public')->delete($this->current_video);
                }
                
                $videoPath = $this->video_url->store('courses/videos', 'public');
                $data['video_url'] = $videoPath;
            }

            Course::where('id', $this->id)->update($data);
            
            return redirect()->route('admin.courses.index')->with('success', __('Course updated successfully'));
        } else {
            abort(403, __('Access denied'));
        }
    }

    public function render()
    {
        $authors = Auther::all();
        return view('livewire.admin.edit-course', compact('authors'));
    }
}