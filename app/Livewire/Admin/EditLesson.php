<?php

namespace App\Livewire\Admin;

use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditLesson extends Component
{
    use WithFileUploads;

    public $lesson;
    public $course_id;
    public $title;
    public $content;
    public $order;
    public $duration_minutes;
    public $video_url;

    public $current_video; // ← مهم جدًا

    protected $listeners = ['videoDurationDetected' => 'setVideoDuration'];

    public function setVideoDuration($minutes)
    {
        $this->duration_minutes = (int) $minutes;
    }

    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
        $this->course_id = $lesson->course_id;
        $this->title = $lesson->title;
        $this->content = $lesson->content;
        $this->order = $lesson->order;
        $this->duration_minutes = $lesson->duration_minutes;
        $this->current_video = $lesson->video_url;
    }

    public function rules()
    {
        return [
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'order' => 'required|integer|min:1',
            'duration_minutes' => 'required|integer|min:1',
            'video_url' => 'nullable|file|mimes:mp4,mov|max:512000', // 500MB
        ];
    }

    public function messages()
    {
        return [
            'video_url.mimes' => 'صيغة الفيديو غير مدعومة. استخدم MP4 أو MOV.',
            'video_url.max' => 'يجب أن يكون الفيديو أقل من 500 ميجابايت.',
        ];
    }

    public function store()
    {
        if (!auth()->check() || !auth()->user()->is_admin()) {
            abort(403);
        }

        $this->validate();

        $data = [
            'course_id' => $this->course_id,
            'title' => $this->title,
            'content' => $this->content,
            'order' => $this->order,
            'duration_minutes' => $this->duration_minutes,
        ];

        // معالجة الفيديو فقط إذا تم تحميله
        if ($this->video_url) {
            if ($this->current_video && Storage::disk('public')->exists($this->current_video)) {
                Storage::disk('public')->delete($this->current_video);
            }
            $data['video_url'] = $this->video_url->store('lessons/videos', 'public');
        }

        $this->lesson->update($data);

        // تحديث مدة الدورة
        $course = Course::findOrFail($this->course_id);
        $totalMinutes = $course->lessons()->sum('duration_minutes');
        $course->update(['duration_hours' => round($totalMinutes / 60, 1)]);

        return redirect()->route('admin.lessons.index')
            ->with('success', 'تم تحديث الدرس بنجاح.');
    }

    public function render()
    {
        $courses = Course::all();
        return view('livewire.admin.edit-lesson', compact('courses'));
    }
}