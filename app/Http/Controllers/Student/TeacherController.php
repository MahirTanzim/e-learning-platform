<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserFollow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function profile($id)
    {
        $teacher = User::where('id', $id)
            ->where('role', 'teacher')
            ->with(['courses' => function($query) {
                $query->where('status', 'published');
            }, 'blogPosts' => function($query) {
                $query->where('status', 'published')->latest()->take(3);
            }])
            ->firstOrFail();

        $isFollowing = false;
        if (Auth::check()) {
            $isFollowing = UserFollow::where('follower_id', Auth::id())
                ->where('following_id', $teacher->id)
                ->exists();
        }

        $followersCount = UserFollow::where('following_id', $teacher->id)->count();

        return view('student.teachers.profile', compact('teacher', 'isFollowing', 'followersCount'));
    }

    public function follow(User $teacher)
    {
        if (!Auth::user()->isStudent()) {
            return back()->with('error', 'Only students can follow teachers.');
        }

        if (!$teacher->isTeacher()) {
            return back()->with('error', 'You can only follow teachers.');
        }

        $existingFollow = UserFollow::where('follower_id', Auth::id())
            ->where('following_id', $teacher->id)
            ->first();

        if ($existingFollow) {
            $existingFollow->delete();
            return back()->with('success', 'Unfollowed successfully!');
        } else {
            UserFollow::create([
                'follower_id' => Auth::id(),
                'following_id' => $teacher->id,
            ]);
            return back()->with('success', 'Following successfully!');
        }
    }
}