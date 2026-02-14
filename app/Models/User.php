<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Billable;
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function Courses()
    {
        return $this->belongsToMany(Course::class, 'purchases')
                ->withPivot('amount', 'payment_intent_id', 'status')
                    ->withTimestamps();
    }
    public function has_course($courseId)
    {
        return $this->Courses()->where('course_id', $courseId)->where('status', 'completed')->exists();
    }
    
    public function has_any_course()
    {
        return $this->Courses()->where('user_id', auth()->id())->where('status', 'completed')->exists();
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function is_admin()
    {
        return $this->admin_level  ;
    }
    public function completedLessonsInCourse($courseId)
    {
        return $this->belongsToMany(Lesson::class, 'lesson_user')
            ->where('completed', true)
            ->where('course_id', $courseId)->count();
    }
    public function isCompletedLessonsInCourse($courseId , $lessonId)
    {
        return $this->belongsToMany(Lesson::class, 'lesson_user')
            ->where('completed', true)
            ->where('course_id', $courseId)
            ->where('lesson_id', $lessonId)->where('completed' ,1)->exists();
    }
}
