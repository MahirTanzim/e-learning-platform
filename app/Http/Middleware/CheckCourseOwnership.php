<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Course;

class CheckCourseOwnership
{
    public function handle(Request $request, Closure $next): Response
    {
        $course = $request->route('course');
        
        if ($course instanceof Course) {
            $teacherId = $course->teacher_id;
        } else {
            $course = Course::findOrFail($course);
            $teacherId = $course->teacher_id;
        }
        
        if (auth()->id() !== $teacherId) {
            abort(403, 'You can only manage your own courses.');
        }

        return $next($request);
    }
}