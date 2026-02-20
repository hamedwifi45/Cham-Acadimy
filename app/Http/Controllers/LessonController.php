<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->check() && auth()->user()->is_admin()) {
            return view('admin.lessons.create');
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        if (auth()->check()) {
            if (auth()->user()->is_admin() or auth()->user()->has_course($lesson->course_id)) {
                $course = $lesson->course;
                $lessons = $course->lessons()->orderBy('order', 'asc')->get();

                $lessonIds = $lessons->pluck('id')->all();
                $currentIndex = array_search($lesson->id, $lessonIds);

                $previousLesson = $currentIndex > 0 ? $lessons[$currentIndex - 1] : null;
                $nextLesson = $currentIndex !== false && $currentIndex < $lessons->count() - 1
                    ? $lessons[$currentIndex + 1]
                    : null;

                return view('lessons.show', compact('lesson', 'course', 'previousLesson', 'nextLesson'));
            } else {
                return redirect()->back()->with('Erorree', __('Buy The Course First'));
            }
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        //
    }
}
