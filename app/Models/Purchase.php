<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
   protected $fillable = [
        'user_id',
        'course_id',
        'amount',
        'payment_id',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    // هذه الدوال اضيفت في مرحلة متقدمة سيتم استخدامها لاحقا بعد تخرج
    /**
     * هل المشتري مكتمل؟
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * هل المشتري معلق؟
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * هل المشتري فاشل؟
     */
    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

}
