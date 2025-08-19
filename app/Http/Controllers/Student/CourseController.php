<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Video;
use App\Models\UserVideoProgress;
use App\Models\Review;

class CourseController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $enrolledCourses = $user->enrolledCourses()
                               ->with(['teacher', 'category'])
                               ->paginate(12);

        return view('student.courses.index', compact('enrolledCourses'));
    }

    public function preview(Course $course)
    {
        $course->load(['teacher', 'category', 'modules.videos']);
        
        $user = auth()->user();
        $isEnrolled = $user->isEnrolledIn($course->id);
        $enrollment = null;
        
        if ($isEnrolled) {
            $enrollment = $user->enrollments()->where('course_id', $course->id)->first();
        }

        return view('student.courses.preview', compact('course', 'isEnrolled', 'enrollment'));
    }

    public function enroll(Course $course)
    {
        $user = auth()->user();

        if ($user->isEnrolledIn($course->id)) {
            return back()->with('error', 'You are already enrolled in this course.');
        }

        $user->enrollments()->create([
            'course_id' => $course->id,
            'enrolled_at' => now(),
        ]);

        return back()->with('success', 'Successfully enrolled in the course!');
    }

    public function show(Course $course)
    {
        $course->load(['teacher', 'modules.videos', 'quizzes', 'assignments']);
        
        $user = auth()->user();
        $enrollment = $user->enrollments()->where('course_id', $course->id)->first();

        if (!$enrollment) {
            return redirect()->route('courses.show', $course->slug)
                           ->with('error', 'You must be enrolled to access this content.');
        }

        return view('student.courses.show', compact('course', 'enrollment'));
    }

    public function watchVideo(Course $course, Video $video)
    {
        $user = auth()->user();
        
        if (!$user->isEnrolledIn($course->id)) {
            abort(403, 'You must be enrolled to watch this video.');
        }

        $progress = UserVideoProgress::firstOrCreate([
            'user_id' => $user->id,
            'video_id' => $video->id,
        ]);

        return view('student.courses.watch', compact('course', 'video', 'progress'));
    }

    public function updateVideoProgress(Request $request, Video $video)
    {
        $request->validate([
            'watched_duration' => 'required|integer|min:0',
        ]);

        $user = auth()->user();
        
        $progress = UserVideoProgress::updateOrCreate(
            [
                'user_id' => $user->id,
                'video_id' => $video->id,
            ],
            [
                'watched_duration' => $request->watched_duration,
                'is_completed' => $request->watched_duration >= $video->duration * 0.9, // 90% completion
                'last_watched_at' => now(),
            ]
        );

        return response()->json(['success' => true, 'progress' => $progress]);
    }

    public function submitReview(Request $request, Course $course)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $user = auth()->user();

        if (!$user->isEnrolledIn($course->id)) {
            return back()->with('error', 'You must be enrolled to review this course.');
        }

        Review::updateOrCreate(
            [
                'course_id' => $course->id,
                'student_id' => $user->id,
            ],
            [
                'rating' => $request->rating,
                'review' => $request->review,
            ]
        );

        return back()->with('success', 'Review submitted successfully!');
    }
}