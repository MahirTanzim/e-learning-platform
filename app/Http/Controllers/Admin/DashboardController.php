<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Complaint;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic statistics
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalEnrollments = Enrollment::count();
        $pendingComplaints = Complaint::where('status', 'pending')->count();
        
        // User statistics by role
        $studentCount = User::where('role', 'student')->count();
        $teacherCount = User::where('role', 'teacher')->count();
        $adminCount = User::where('role', 'admin')->count();
        
        // Recent activity
        $recentUsers = User::latest()->limit(5)->get();
        $recentCourses = Course::with('teacher')->latest()->limit(5)->get();
        $recentEnrollments = Enrollment::with(['student', 'course'])->latest()->limit(5)->get();
        $recentComplaints = Complaint::with('complainant')->latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalCourses',
            'totalEnrollments',
            'pendingComplaints',
            'studentCount',
            'teacherCount',
            'adminCount',
            'recentUsers',
            'recentCourses',
            'recentEnrollments',
            'recentComplaints'
        ));
    }
}