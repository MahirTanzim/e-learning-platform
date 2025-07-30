<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $enrolledCourses = Enrollment::where('student_id', $user->id)
            ->with(['course.teacher', 'course.category'])
            ->latest()
            ->take(4)
            ->get();

        $totalCourses = Enrollment::where('student_id', $user->id)->count();
        $completedCourses = Enrollment::where('student_id', $user->id)
            ->where('progress', 100)
            ->count();

        $recommendedCourses = Course::where('status', 'published')
            ->with(['teacher', 'category'])
            ->latest()
            ->take(4)
            ->get();

        return view('student.dashboard', compact(
            'enrolledCourses', 
            'totalCourses', 
            'completedCourses', 
            'recommendedCourses'
        ));
    }
}