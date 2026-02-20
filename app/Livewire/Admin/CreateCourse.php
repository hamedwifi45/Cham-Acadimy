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
        'beginner' => 'beginner',
        'intermediate' => 'intermediate',
        'advanced' => 'advanced',
    ];

    // طريقة جديدة للتحقق
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

    public function store()
    {
        if (auth()->check() && auth()->user()->is_admin() > 0) {
            $this->validate();

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

            return redirect()->route('admin.courses.index')->with('success', __('Course created successfully'));
        } else {
            abort(403, __('Access denied'));
        }
    }

    public function render()
    {
        $authors = Auther::all();

        return view('livewire.admin.create-course', compact('authors'));
    }
}
