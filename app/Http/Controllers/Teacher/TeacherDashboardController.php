<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\BlogPost;
use App\Models\UserFollow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $totalCourses = Course::where('teacher_id', $user->id)->count();
        $publishedCourses = Course::where('teacher_id', $user->id)
            ->where('status', 'published')
            ->count();
        
        $totalStudents = Enrollment::whereHas('course', function($query) use ($user) {
            $query->where('teacher_id', $user->id);
        })->distinct('student_id')->count();

        $totalFollowers = UserFollow::where('following_id', $user->id)->count();

        $recentCourses = Course::where('teacher_id', $user->id)
            ->with('category')
            ->latest()
            ->take(5)
            ->get();

        $recentEnrollments = Enrollment::whereHas('course', function($query) use ($user) {
            $query->where('teacher_id', $user->id);
        })
        ->with(['student', 'course'])
        ->latest()
        ->take(5)
        ->get();

        return view('teacher.dashboard', compact(
            'totalCourses',
            'publishedCourses', 
            'totalStudents',
            'totalFollowers',
            'recentCourses',
            'recentEnrollments'
        ));
    }
}