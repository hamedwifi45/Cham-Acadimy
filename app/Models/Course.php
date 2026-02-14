<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'thumbnail_url',
        'video_url',
        'price',
        'level',
        'author_id',
        'duration_hours',
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
    public function author()
    {
        return $this->belongsTo(Auther::class, 'Author_id');
    }
    public function purchases()
    {
        return $this->belongsToMany(User::class, 'purchases')
                ->withPivot('amount', 'payment_intent_id', 'status')
                    ->withTimestamps();
    }
    public function getTitleAttribute()
    {
        return $this->{'name_' . app()->getLocale()};
    }

    public function completionPercentage(User $user)
    {
        $totalLessons = $this->lessons()->count();
        if ($totalLessons === 0) return 0;
        
        $completed = $user->completedLessonsInCourse($this->id);
        return round(($completed / $totalLessons) * 100);
    }

    
    /**
     * احصل على الوصف حسب اللغة الحالية
     */
    public function getDescriptionAttribute()
    {
        return $this->{'description_' . app()->getLocale()};
    }

}
