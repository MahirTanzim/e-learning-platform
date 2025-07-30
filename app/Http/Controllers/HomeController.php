<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCourses = Course::where('status', 'published')
            ->with(['teacher', 'category'])
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::withCount('courses')->take(8)->get();
        
        $latestBlogs = BlogPost::where('status', 'published')
            ->with('teacher')
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact('featuredCourses', 'categories', 'latestBlogs'));
    }
}