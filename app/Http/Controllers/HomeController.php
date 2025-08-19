<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\BlogPost;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCourses = Course::where('status', 'published')
                                ->with(['teacher', 'category'])
                                ->latest()
                                ->limit(6)
                                ->get();

        $categories = Category::withCount('courses')->limit(8)->get();
        
        $recentBlogs = BlogPost::where('status', 'published')
                               ->with('teacher')
                               ->latest()
                               ->limit(3)
                               ->get();

        $topTeachers = User::where('role', 'teacher')
                          ->where('status', 'active')
                          ->withCount('courses')
                          ->having('courses_count', '>', 0)
                          ->limit(4)
                          ->get();

        return view('home', compact('featuredCourses', 'categories', 'recentBlogs', 'topTeachers'));
    }

    public function courses()
    {
        $courses = Course::where('status', 'published')
                        ->with(['teacher', 'category'])
                        ->paginate(12);

        $categories = Category::all();

        return view('courses.index', compact('courses', 'categories'));
    }

    public function showCourse($slug)
    {
        $course = Course::where('slug', $slug)
                       ->where('status', 'published')
                       ->with(['teacher', 'category', 'modules.videos', 'reviews.student'])
                       ->firstOrFail();

        $isEnrolled = auth()->check() && auth()->user()->isEnrolledIn($course->id);

        return view('courses.show', compact('course', 'isEnrolled'));
    }

    public function blog()
    {
        $posts = BlogPost::where('status', 'published')
                        ->with('teacher')
                        ->latest()
                        ->paginate(10);

        return view('blog.index', compact('posts'));
    }

    public function showBlog($slug)
    {
        $post = BlogPost::where('slug', $slug)
                       ->where('status', 'published')
                       ->with(['teacher', 'comments.user', 'likes'])
                       ->firstOrFail();

        return view('blog.show', compact('post'));
    }
}