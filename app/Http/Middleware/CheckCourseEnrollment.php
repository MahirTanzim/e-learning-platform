<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Course;

class CheckCourseEnrollment
{
    public function handle(Request $request, Closure $next): Response
    {
        $course = $request->route('course');
        
        if ($course instanceof Course) {
            $courseId = $course->id;
        } else {
            $courseId = $course;
        }
        
        $user = auth()->user();
        
        if (!$user->isEnrolledIn($courseId)) {
            return redirect()->route('courses.show', $courseId)
                           ->with('error', 'You must be enrolled to access this content.');
        }

        return $next($request);
    }
}