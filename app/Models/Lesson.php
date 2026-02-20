<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'course_id',
        'video_url',
        'order',
        'duration_minutes',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function has_course()
    {
        return $this->course()->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('completed');
    }

    public function is_watched(User $user)
    {
        return $this->users()->where('user_id', $user->id)->wherePivot('completed', true)->exists();
    }

    public function markAsWatchedBy(User $user)
    {
        $this->users()->syncWithoutDetaching([$user->id => ['completed' => true]]);
    }
}
