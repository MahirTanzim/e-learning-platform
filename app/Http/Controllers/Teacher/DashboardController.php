<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\BlogPost;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Basic statistics
        $totalCourses = $user->courses()->count();
        $totalStudents = $user->courses()->withCount('enrollments')->get()->sum('enrollments_count');
        $totalRevenue = $user->courses()->with('enrollments')->get()->sum(function($course) {
            return $course->enrollments->count() * $course->price;
        });
        $totalBlogPosts = $user->blogPosts()->count();
        
        // Recent enrollments
        $recentEnrollments = Enrollment::whereHas('course', function($query) use ($user) {
            $query->where('teacher_id', $user->id);
        })
        ->with(['student', 'course'])
        ->latest('enrolled_at')
        ->limit(10)
        ->get();
        
        // Top performing courses
        $topCourses = $user->courses()
                          ->withCount('enrollments')
                          ->withSum('enrollments', 'course_id')
                          ->orderBy('enrollments_count', 'desc')
                          ->limit(5)
                          ->get()
                          ->map(function($course) {
                              $course->total_revenue = $course->enrollments_count * $course->price;
                              return $course;
                          });
        
        // My courses
        $myCourses = $user->courses()
                         ->with(['category', 'enrollments'])
                         ->latest()
                         ->limit(6)
                         ->get();
        
        // Recent blog posts
        $recentBlogPosts = $user->blogPosts()
                               ->latest()
                               ->limit(5)
                               ->get();

        return view('teacher.dashboard', compact(
            'totalCourses',
            'totalStudents', 
            'totalRevenue',
            'totalBlogPosts',
            'recentEnrollments',
            'topCourses',
            'myCourses',
            'recentBlogPosts'
        ));
    }
}