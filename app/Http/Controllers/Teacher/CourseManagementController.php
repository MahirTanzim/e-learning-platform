<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use App\Models\CourseModule;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CourseManagementController extends Controller
{
    public function index()
    {
        $courses = Course::where('teacher_id', Auth::id())
            ->with('category')
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
            'category_id' => 'required|exists:categories,id',
            'level' => 'required|in:beginner,intermediate,advanced',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('course-thumbnails', 'public');
        }

        $course = Course::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'description' => $request->description,
            'thumbnail' => $thumbnailPath,
            'price' => $request->price,
            'teacher_id' => Auth::id(),
            'category_id' => $request->category_id,
            'level' => $request->level,
            'status' => 'draft',
        ]);

        return redirect()->route('teacher.courses.show', $course)
            ->with('success', 'Course created successfully!');
    }

    public function show(Course $course)
    {
        $this->authorize('view', $course);
        
        $course->load(['modules.videos', 'category']);
        return view('teacher.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $this->authorize('update', $course);
        
        $categories = Category::all();
        return view('teacher.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        $this->authorize('update', $course);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'level' => 'required|in:beginner,intermediate,advanced',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:draft,published,archived',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('course-thumbnails', 'public');
            $course->thumbnail = $thumbnailPath;
        }

        $course->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'level' => $request->level,
            'price' => $request->price,
            'status' => $request->status,
        ]);

        return redirect()->route('teacher.courses.show', $course)
            ->with('success', 'Course updated successfully!');
    }

    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);
        
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }
        
        $course->delete();
        
        return redirect()->route('teacher.courses.index')
            ->with('success', 'Course deleted successfully!');
    }

    public function addModule(Request $request, Course $course)
    {
        $this->authorize('update', $course);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $lastOrder = CourseModule::where('course_id', $course->id)->max('order') ?? 0;

        CourseModule::create([
            'course_id' => $course->id,
            'title' => $request->title,
            'description' => $request->description,
            'order' => $lastOrder + 1,
        ]);

        return back()->with('success', 'Module added successfully!');
    }

    public function addVideo(Request $request, CourseModule $module)
    {
        $this->authorize('update', $module->course);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video' => 'required|mimes:mp4,mov,avi,wmv|max:102400', // 100MB max
        ]);

        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('course-videos', 'public');
        }

        $lastOrder = Video::where('module_id', $module->id)->max('order') ?? 0;

        Video::create([
            'module_id' => $module->id,
            'title' => $request->title,
            'description' => $request->description,
            'video_url' => $videoPath,
            'order' => $lastOrder + 1,
        ]);

        return back()->with('success', 'Video added successfully!');
    }
}