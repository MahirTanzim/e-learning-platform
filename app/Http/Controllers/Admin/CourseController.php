<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['teacher', 'category'])
                        ->withCount(['enrollments', 'reviews'])
                        ->latest()
                        ->paginate(15);

        return view('admin.courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $course->load([
            'teacher',
            'category',
            'modules.videos',
            'quizzes.questions',
            'assignments',
            'enrollments.student',
            'reviews.student'
        ]);

        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'status' => 'required|in:draft,published,archived',
        ]);

        $course->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.courses.show', $course)
                        ->with('success', 'Course status updated successfully!');
    }

    public function destroy(Course $course)
    {
        // Delete associated files
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }

        foreach ($course->videos as $video) {
            if ($video->video_url) {
                Storage::disk('public')->delete($video->video_url);
            }
        }

        foreach ($course->assignments as $assignment) {
            if ($assignment->attachment) {
                Storage::disk('public')->delete($assignment->attachment);
            }
        }

        $course->delete();

        return redirect()->route('admin.courses.index')
                        ->with('success', 'Course deleted successfully!');
    }

    public function archive(Course $course)
    {
        $course->update(['status' => 'archived']);

        return back()->with('success', 'Course archived successfully!');
    }

    public function publish(Course $course)
    {
        $course->update(['status' => 'published']);

        return back()->with('success', 'Course published successfully!');
    }
}