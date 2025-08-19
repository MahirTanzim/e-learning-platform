<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', 'teacher')
                       ->where('status', 'active')
                       ->with(['profile', 'courses' => function($query) {
                           $query->where('status', 'published');
                       }])
                       ->withCount(['courses' => function($query) {
                           $query->where('status', 'published');
                       }])
                       ->paginate(12);

        return view('student.teachers.index', compact('teachers'));
    }

    public function show(User $teacher)
    {
        if ($teacher->role !== 'teacher') {
            abort(404);
        }

        $teacher->load([
            'profile',
            'courses' => function($query) {
                $query->with(['category', 'reviews'])->orderBy('created_at', 'desc');
            },
            'blogPosts' => function($query) {
                $query->latest()->limit(5);
            }
        ]);

        $teacher->loadCount([
            'courses',
            'followers',
            'blogPosts'
        ]);

        $isFollowing = auth()->check() && auth()->user()->isFollowing($teacher->id);

        return view('student.teachers.show', compact('teacher', 'isFollowing'));
    }

    public function follow(User $teacher)
    {
        $user = auth()->user();

        if ($teacher->role !== 'teacher') {
            return back()->with('error', 'Invalid teacher.');
        }

        if ($user->isFollowing($teacher->id)) {
            $user->following()->detach($teacher->id);
            $message = 'Unfollowed successfully!';
        } else {
            $user->following()->attach($teacher->id);
            $message = 'Following successfully!';
        }

        return back()->with('success', $message);
    }
}