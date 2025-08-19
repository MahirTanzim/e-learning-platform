<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('profile')
                    ->withCount(['courses', 'enrollments', 'blogPosts'])
                    ->latest()
                    ->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load([
            'profile',
            'courses' => function($query) {
                $query->withCount('enrollments');
            },
            'enrollments.course',
            'blogPosts',
            'reviews.course',
            'complaints'
        ]);

        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $user->load('profile');
        return view('admin.users.edit', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:student,teacher,admin',
            'status' => 'required|in:active,inactive,suspended',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'status' => $request->status,
            'avatar' => $avatarPath,
        ]);

        return redirect()->route('admin.users.show', $user)
                        ->with('success', 'User created successfully!');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:student,teacher,admin',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.users.show', $user)
                        ->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'Cannot delete admin users.');
        }

        // Delete associated files
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Delete course thumbnails and videos if user is a teacher
        if ($user->role === 'teacher') {
            foreach ($user->courses as $course) {
                if ($course->thumbnail) {
                    Storage::disk('public')->delete($course->thumbnail);
                }
                
                foreach ($course->videos as $video) {
                    if ($video->video_url) {
                        Storage::disk('public')->delete($video->video_url);
                    }
                }
            }

            // Delete blog images
            foreach ($user->blogPosts as $post) {
                if ($post->featured_image) {
                    Storage::disk('public')->delete($post->featured_image);
                }
            }
        }

        $user->delete();

        return redirect()->route('admin.users.index')
                        ->with('success', 'User deleted successfully!');
    }

    public function suspend(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'Cannot suspend admin users.');
        }

        $user->update(['status' => 'suspended']);

        return back()->with('success', 'User suspended successfully!');
    }

    public function activate(User $user)
    {
        $user->update(['status' => 'active']);

        return back()->with('success', 'User activated successfully!');
    }
}