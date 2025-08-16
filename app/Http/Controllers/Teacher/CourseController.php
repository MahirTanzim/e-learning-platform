<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\Category;
use App\Models\CourseModule;
use App\Models\Video;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizAnswer;
use App\Models\Assignment;

class CourseController extends Controller
{
    public function index()
    {
        $courses = auth()->user()->courses()
                                ->with(['category'])
                                ->withCount(['enrollments'])
                                ->latest()
                                ->paginate(10);

        return view('teacher.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('teacher.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'level' => 'required|in:beginner,intermediate,advanced',
            'prerequisites' => 'nullable|string',
            'certificate_available' => 'boolean',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('course-thumbnails', 'public');
        }

        $course = auth()->user()->courses()->create([
            'title' => $request->title,
            'slug' => Str::slug($request->title . '-' . time()),
            'description' => $request->description,
            'thumbnail' => $thumbnailPath,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'level' => $request->level,
            'prerequisites' => $request->prerequisites,
            'certificate_available' => $request->boolean('certificate_available'),
            'status' => 'draft',
        ]);

        return redirect()->route('teacher.courses.show', $course)
                        ->with('success', 'Course created successfully!');
    }

    public function show(Course $course)
    {
        $course->load(['modules.videos', 'quizzes.questions', 'assignments']);
        return view('teacher.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $categories = Category::all();
        return view('teacher.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'level' => 'required|in:beginner,intermediate,advanced',
            'status' => 'required|in:draft,published,archived',
            'prerequisites' => 'nullable|string',
            'certificate_available' => 'boolean',
        ]);

        $thumbnailPath = $course->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($thumbnailPath) {
                Storage::disk('public')->delete($thumbnailPath);
            }
            $thumbnailPath = $request->file('thumbnail')->store('course-thumbnails', 'public');
        }

        $course->update([
            'title' => $request->title,
            'description' => $request->description,
            'thumbnail' => $thumbnailPath,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'level' => $request->level,
            'status' => $request->status,
            'prerequisites' => $request->prerequisites,
            'certificate_available' => $request->boolean('certificate_available'),
        ]);

        return redirect()->route('teacher.courses.show', $course)
                        ->with('success', 'Course updated successfully!');
    }

    public function destroy(Course $course)
    {
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }

        $course->delete();

        return redirect()->route('teacher.courses.index')
                        ->with('success', 'Course deleted successfully!');
    }

}
