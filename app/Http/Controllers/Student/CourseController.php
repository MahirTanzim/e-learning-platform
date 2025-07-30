<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::where('status', 'published')
            ->with(['teacher', 'category']);

        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('level') && $request->level) {
            $query->where('level', $request->level);
        }

        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $courses = $query->paginate(12);
        $categories = \App\Models\Category::all();

        return view('student.courses.index', compact('courses', 'categories'));
    }

    public function show($slug)
    {
        $course = Course::where('slug', $slug)
            ->where('status', 'published')
            ->with(['teacher', 'category', 'modules.videos', 'reviews.student'])
            ->firstOrFail();

        $isEnrolled = false;
        $enrollment = null;

        if (Auth::check() && Auth::user()->isStudent()) {
            $enrollment = Enrollment::where('student_id', Auth::id())
                ->where('course_id', $course->id)
                ->first();
            $isEnrolled = $enrollment !== null;
        }

        return view('student.courses.show', compact('course', 'isEnrolled', 'enrollment'));
    }

    public function enroll(Course $course)
    {
        if (!Auth::user()->isStudent()) {
            return back()->with('error', 'Only students can enroll in courses.');
        }

        $existingEnrollment = Enrollment::where('student_id', Auth::id())
            ->where('course_id', $course->id)
            ->first();

        if ($existingEnrollment) {
            return back()->with('error', 'You are already enrolled in this course.');
        }

        Enrollment::create([
            'student_id' => Auth::id(),
            'course_id' => $course->id,
            'enrolled_at' => now(),
        ]);

        return back()->with('success', 'Successfully enrolled in the course!');
    }

    public function myCourses()
    {
        $enrollments = Enrollment::where('student_id', Auth::id())
            ->with(['course.teacher', 'course.category'])
            ->latest()
            ->paginate(10);

        return view('student.courses.my-courses', compact('enrollments'));
    }

    public function watch(Course $course)
    {
        $enrollment = Enrollment::where('student_id', Auth::id())
            ->where('course_id', $course->id)
            ->firstOrFail();

        $course->load(['modules.videos']);

        return view('student.courses.watch', compact('course', 'enrollment'));
    }

    public function review(Request $request, Course $course)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $enrollment = Enrollment::where('student_id', Auth::id())
            ->where('course_id', $course->id)
            ->firstOrFail();

        Review::updateOrCreate(
            [
                'course_id' => $course->id,
                'student_id' => Auth::id(),
            ],
            [
                'rating' => $request->rating,
                'review' => $request->review,
            ]
        );

        return back()->with('success', 'Review submitted successfully!');
    }
}