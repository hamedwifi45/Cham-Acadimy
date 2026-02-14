<?php

namespace App\Livewire\Admin;

use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateLesson extends Component
{
    use WithFileUploads;
    public $course_id;
    public $title;
    public $content;
    public $video_url;
    public $duration_minutes = 0;
    public $order;



    protected $listeners = ['videoDurationDetected' => 'setVideoDuration'];

    public function setVideoDuration($minutes)
    {
        if ($minutes < 2) {
            $this->duration_minutes = $minutes; 
        } else {
            $this->duration_minutes = (int) $minutes - 1.5;
        }
    }

    public function rules()
    {
        return [
            'course_id' => 'required|exists:courses,id',
            'video_url' => 'required|file|mimes:mp4,mov|max:512000', // 500MB
            'order' => 'required|integer|min:1',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'video_url.max' => 'يجب أن يكون الفيديو أقل من 500MB',
            'video_duration_minutes.required' => 'يجب تحميل فيديو صالح لمعرفة مدته',
        ];
    }

    public function store()
    {
        $this->validate();
        
        $videoPath = $this->video_url->store('lessons/videos', 'private');
        
        $lesson = Lesson::create([
            'course_id' => $this->course_id,
            'video_url' => $videoPath,
            'order' => $this->order,
            'title' => $this->title,
            'content' => $this->content,
            'duration_minutes' => $this->duration_minutes,
        ]);

        $course = Course::findOrFail($this->course_id);
        $totalMinutes = $course->lessons()->sum('duration_minutes');
        $course->update([
            'duration_hours' => round($totalMinutes / 60, 1) 
        ]);

        return redirect()->route('admin.lessons.create')->with('success' , __("Add New Lesson success"));
    }
    public function render()
    {
        $courses = Course::all();
        return view('livewire.admin.create-lesson' , compact('courses'));
    }
}
