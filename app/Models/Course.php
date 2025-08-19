<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail',
        'price',
        'teacher_id',
        'category_id',
        'level',
        'status',
        'duration',
        'prerequisites',
        'learning_outcomes',
        'requirements',
        'certificate_available',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'certificate_available' => 'boolean',
    ];

    // Relationships
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function modules()
    {
        return $this->hasMany(CourseModule::class)->orderBy('order');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'student_id')
                    ->withPivot(['enrolled_at', 'completed_at', 'progress'])
                    ->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function videos()
    {
        // videos.module_id -> course_modules.id, course_modules.course_id -> courses.id
        return $this->hasManyThrough(
            Video::class,        // Related
            CourseModule::class, // Through
            'course_id',         // Foreign key on course_modules referencing courses
            'module_id',         // Foreign key on videos referencing course_modules
            'id',                // Local key on courses
            'id'                 // Local key on course_modules
        );
    }

    // Helper methods
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : asset('images/default-course.png');
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function getTotalStudentsAttribute()
    {
        return $this->enrollments()->count();
    }

    public function getTotalVideosAttribute()
    {
        return $this->videos()->count();
    }

    public function isPublished()
    {
        return $this->status === 'published';
    }

    public function isDraft()
    {
        return $this->status === 'draft';
    }

    public function isArchived()
    {
        return $this->status === 'archived';
    }
}