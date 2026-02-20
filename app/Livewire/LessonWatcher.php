<?php

namespace App\Livewire;

use App\Models\Lesson;
use Livewire\Component;

class LessonWatcher extends Component
{
    public Lesson $lesson;

    public $duration;

    public $watched = false;

    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
        $this->watched = $this->isLessonCompleted();
        $this->duration = $this->lesson->duration_minutes * 60;
    }

    public function isLessonCompleted()
    {
        $user = auth()->user();

        return $user->isCompletedLessonsInCourse($this->lesson->course_id, $this->lesson->id);
    }

    public function markAsWatchedBy()
    {
        if (! auth()->check()) {
            abort(403, __('You do not have access to this Course.'));
        } else {
            if (auth()->user()->is_admin() || auth()->user()->has_course($this->lesson->course_id)) {
                $this->lesson->users()->syncWithoutDetaching([auth()->user()->id => ['completed' => true]]);
                $this->watched = true;
            }
        }

    }

    public function render()
    {
        return view('livewire.lesson-watcher');
    }
}
