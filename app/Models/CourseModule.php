<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'order',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'module_id')->orderBy('order');
    }

    public function getTotalDurationAttribute()
    {
        return $this->videos()->sum('duration');
    }

    public function getTotalVideosAttribute()
    {
        return $this->videos()->count();
    }
}