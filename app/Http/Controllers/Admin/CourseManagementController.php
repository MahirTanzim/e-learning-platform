<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with(['teacher', 'category']);

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $courses = $query->latest()->paginate(15);

        return view('admin.courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $course->load(['teacher', 'category', 'modules.videos', 'enrollments.student', 'reviews.student']);
        return view('admin.courses.show', compact('course'));
    }

    public function updateStatus(Request $request, Course $course)
    {
        $request->validate([
            'status' => 'required|in:draft,published,archived',
        ]);

        $course->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Course status updated successfully!');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        
        return redirect()->route('admin.courses.index')
            ->with('success', 'Course deleted successfully!');
    }
}