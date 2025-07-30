<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Complaint;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalStudents = User::where('role', 'student')->count();
        $totalTeachers = User::where('role', 'teacher')->count();
        $totalCourses = Course::count();
        $publishedCourses = Course::where('status', 'published')->count();
        $totalEnrollments = Enrollment::count();
        $pendingComplaints = Complaint::where('status', 'pending')->count();

        $recentUsers = User::latest()->take(5)->get();
        $recentCourses = Course::with('teacher')->latest()->take(5)->get();
        $recentComplaints = Complaint::with('complainant')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalStudents',
            'totalTeachers',
            'totalCourses',
            'publishedCourses',
            'totalEnrollments',
            'pendingComplaints',
            'recentUsers',
            'recentCourses',
            'recentComplaints'
        ));
    }
}