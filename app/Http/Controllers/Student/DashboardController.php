<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $enrolledCourses = $user->enrolledCourses()
                               ->with(['teacher', 'category'])
                               ->latest('pivot_enrolled_at')
                               ->limit(6)
                               ->get();

        $completedCourses = $user->enrollments()
                                ->whereNotNull('completed_at')
                                ->count();

        $inProgressCourses = $user->enrollments()
                                 ->whereNull('completed_at')
                                 ->count();

        $followingTeachers = $user->following()
                                 ->where('role', 'teacher')
                                 ->count();

        $recentCourses = Course::where('status', 'published')
                              ->with(['teacher', 'category'])
                              ->latest()
                              ->limit(4)
                              ->get();

        return view('student.dashboard', compact(
            'enrolledCourses',
            'completedCourses', 
            'inProgressCourses',
            'followingTeachers',
            'recentCourses'
        ));
    }
}