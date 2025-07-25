<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function biology()
    {
        $courses = Course::where('subject', 'biology')->get();
        return view('courses.biology', compact('courses'));
    }
    public function mathematics()
{
    $courses = Course::where('subject', 'mathematics')->get();

    return view('courses.mathematics', compact('courses'));
}
    public function physics()
{
    $courses = Course::where('subject', 'physics')->get();
    return view('courses.physics', compact('courses'));
}

    public function chemistry()
{
    $courses = Course::where('subject', 'chemistry')->get();
    return view('courses.chemistry', compact('courses'));
}

public function english()
{
    $courses = Course::where('subject', 'english')->get();
    return view('courses.english', compact('courses'));
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
