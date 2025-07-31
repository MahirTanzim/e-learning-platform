<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'description',
        'video_url',
        'duration',
        'order',
        'is_free',
    ];

    protected $casts = [
        'is_free' => 'boolean',
    ];

    public function module()
    {
        return $this->belongsTo(CourseModule::class, 'module_id');
    }

    public function course()
    {
        return $this->hasOneThrough(Course::class, CourseModule::class, 'id', 'id', 'module_id', 'course_id');
    }

    public function userProgress()
    {
        return $this->hasMany(UserVideoProgress::class);
    }

    public function getVideoUrlAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    public function getFormattedDurationAttribute()
    {
        $minutes = floor($this->duration / 60);
        $seconds = $this->duration % 60;
        return sprintf("%02d:%02d", $minutes, $seconds);
    }
}