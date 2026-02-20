<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'auther_id',
    ];

    public function auther()
    {
        return $this->belongsTo(Auther::class);
    }

    public function comments()
    {
        return $this->hasMany(CommentPost::class);
    }
}
