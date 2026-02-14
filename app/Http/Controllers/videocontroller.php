<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Purchase;
use Illuminate\Http\Request;

class videocontroller extends Controller
{
    public function stream($LessonId)
    {
        $lesson = Lesson::findOrFail($LessonId);
        $course = $lesson->course;
        if (!auth()->check()) {
            abort(401, __('You must be logged in to access this lesson.'));
        }
        if (auth()->user()->is_admin()) {
            $videoPath = storage_path('app/private/' . $lesson->video_url);
            if (!file_exists($videoPath)) {
                abort(404, __('The video does not exist.'));
            }
            $headers = [
                'Content-Type' => 'video/mp4',
                'Content-Disposition' => 'inline; filename="' . basename($videoPath) . '"',
                'X-Content-Type-Options' => 'nosniff',
                'X-Frame-Options' => 'DENY',
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
            ];
            return response()->file($videoPath, $headers);
        }

        $purchase = Purchase::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->where('status', 'completed')
            ->first();

        if (!$purchase) {
            abort(403, __('You do not have permission to access this lesson.'));
        }
        $videoPath = storage_path('app/private/' . $lesson->video_url);
        
        if (!file_exists($videoPath)) {
            abort(404, __('The video does not exist.'));
        }
        $headers = [
            'Content-Type' => 'video/mp4',
            'Content-Disposition' => 'inline; filename="' . basename($videoPath) . '"',
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'DENY',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
        ];
        return response()->file($videoPath, $headers);
    }

}
