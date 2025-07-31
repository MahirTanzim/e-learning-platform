<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVideoProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'video_id',
        'watched_duration',
        'is_completed',
        'last_watched_at',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'last_watched_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function getProgressPercentageAttribute()
    {
        if ($this->video->duration == 0) return 0;
        return min(100, ($this->watched_duration / $this->video->duration) * 100);
    }
}