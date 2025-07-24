<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function mathematics()
{
    $courses = Course::where('subject', 'mathematics')->get();

    return view('courses.mathematics', compact('courses'));
}

    public function showSubject($subject)
{
    $courses = Course::where('subject', ucfirst($subject))->get();
    return view('courses.subject', compact('courses', 'subject'));
}

public function purchase($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.purchase', compact('course'));
    }

}
