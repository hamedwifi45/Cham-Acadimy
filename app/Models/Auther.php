<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auther extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bio',
        'profile_photo_url',
        'area_work',
        'email',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'Author_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
