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

    // Module Management
    public function createModule(Course $course)
    {
        return view('teacher.courses.modules.create', compact('course'));
    }

    public function storeModule(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer|min:1',
        ]);

        $course->modules()->create([
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order,
        ]);

        return redirect()->route('teacher.courses.show', $course)
                        ->with('success', 'Module created successfully!');
    }

    public function editModule(Course $course, CourseModule $module)
    {
        return view('teacher.courses.modules.edit', compact('course', 'module'));
    }

    public function updateModule(Request $request, Course $course, CourseModule $module)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer|min:1',
        ]);

        $module->update([
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order,
        ]);

        return redirect()->route('teacher.courses.show', $course)
                        ->with('success', 'Module updated successfully!');
    }

    public function destroyModule(Course $course, CourseModule $module)
    {
        $module->delete();

        return redirect()->route('teacher.courses.show', $course)
                        ->with('success', 'Module deleted successfully!');
    }

    // Video Management
    public function createVideo(Course $course, CourseModule $module)
    {
        return view('teacher.courses.videos.create', compact('course', 'module'));
    }

    public function storeVideo(Request $request, Course $course, CourseModule $module)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video' => 'required|mimes:mp4,avi,mov,wmv|max:102400', // 100MB max
            'duration' => 'required|integer|min:1',
            'order' => 'required|integer|min:1',
            'is_free' => 'boolean',
        ]);

        $videoPath = $request->file('video')->store('course-videos', 'public');

        $module->videos()->create([
            'title' => $request->title,
            'description' => $request->description,
            'video_url' => $videoPath,
            'duration' => $request->duration,
            'order' => $request->order,
            'is_free' => $request->boolean('is_free'),
        ]);

        return redirect()->route('teacher.courses.show', $course)
                        ->with('success', 'Video uploaded successfully!');
    }

    public function editVideo(Course $course, CourseModule $module, Video $video)
    {
        return view('teacher.courses.videos.edit', compact('course', 'module', 'video'));
    }

    public function updateVideo(Request $request, Course $course, CourseModule $module, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video' => 'nullable|mimes:mp4,avi,mov,wmv|max:102400',
            'duration' => 'required|integer|min:1',
            'order' => 'required|integer|min:1',
            'is_free' => 'boolean',
        ]);

        $videoPath = $video->video_url;
        if ($request->hasFile('video')) {
            if ($videoPath) {
                Storage::disk('public')->delete($videoPath);
            }
            $videoPath = $request->file('video')->store('course-videos', 'public');
        }

        $video->update([
            'title' => $request->title,
            'description' => $request->description,
            'video_url' => $videoPath,
            'duration' => $request->duration,
            'order' => $request->order,
            'is_free' => $request->boolean('is_free'),
        ]);

        return redirect()->route('teacher.courses.show', $course)
                        ->with('success', 'Video updated successfully!');
    }

    public function destroyVideo(Course $course, CourseModule $module, Video $video)
    {
        if ($video->video_url) {
            Storage::disk('public')->delete($video->video_url);
        }
        
        $video->delete();

        return redirect()->route('teacher.courses.show', $course)
                        ->with('success', 'Video deleted successfully!');
    }

    // Quiz Management
    public function createQuiz(Course $course)
    {
        return view('teacher.courses.quizzes.create', compact('course'));
    }

    public function storeQuiz(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'time_limit' => 'nullable|integer|min:1',
            'total_marks' => 'required|integer|min:1',
            'passing_marks' => 'required|integer|min:1',
        ]);

        $quiz = $course->quizzes()->create([
            'title' => $request->title,
            'description' => $request->description,
            'time_limit' => $request->time_limit,
            'total_marks' => $request->total_marks,
            'passing_marks' => $request->passing_marks,
        ]);

        return redirect()->route('teacher.courses.quizzes.show', [$course, $quiz])
                        ->with('success', 'Quiz created successfully!');
    }

    public function showQuiz(Course $course, Quiz $quiz)
    {
        $quiz->load('questions.answers');
        return view('teacher.courses.quizzes.show', compact('course', 'quiz'));
    }

    public function editQuiz(Course $course, Quiz $quiz)
    {
        return view('teacher.courses.quizzes.edit', compact('course', 'quiz'));
    }

    public function updateQuiz(Request $request, Course $course, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'time_limit' => 'nullable|integer|min:1',
            'total_marks' => 'required|integer|min:1',
            'passing_marks' => 'required|integer|min:1',
        ]);

        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
            'time_limit' => $request->time_limit,
            'total_marks' => $request->total_marks,
            'passing_marks' => $request->passing_marks,
        ]);

        return redirect()->route('teacher.courses.show', $course)
                        ->with('success', 'Quiz updated successfully!');
    }

    public function destroyQuiz(Course $course, Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('teacher.courses.show', $course)
                        ->with('success', 'Quiz deleted successfully!');
    }

    // Assignment Management
    public function createAssignment(Course $course)
    {
        return view('teacher.courses.assignments.create', compact('course'));
    }

    public function storeAssignment(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date|after:now',
            'total_marks' => 'required|integer|min:1',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,txt|max:10240',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('assignment-files', 'public');
        }

        $course->assignments()->create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'total_marks' => $request->total_marks,
            'attachment' => $attachmentPath,
        ]);

        return redirect()->route('teacher.courses.show', $course)
                        ->with('success', 'Assignment created successfully!');
    }

    public function editAssignment(Course $course, Assignment $assignment)
    {
        return view('teacher.courses.assignments.edit', compact('course', 'assignment'));
    }

    public function updateAssignment(Request $request, Course $course, Assignment $assignment)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'total_marks' => 'required|integer|min:1',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,txt|max:10240',
        ]);

        $attachmentPath = $assignment->attachment;
        if ($request->hasFile('attachment')) {
            if ($attachmentPath) {
                Storage::disk('public')->delete($attachmentPath);
            }
            $attachmentPath = $request->file('attachment')->store('assignment-files', 'public');
        }

        $assignment->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'total_marks' => $request->total_marks,
            'attachment' => $attachmentPath,
        ]);

        return redirect()->route('teacher.courses.show', $course)
                        ->with('success', 'Assignment updated successfully!');
    }

    public function destroyAssignment(Course $course, Assignment $assignment)
    {
        if ($assignment->attachment) {
            Storage::disk('public')->delete($assignment->attachment);
        }
        
        $assignment->delete();

        return redirect()->route('teacher.courses.show', $course)
                        ->with('success', 'Assignment deleted successfully!');
    }
}