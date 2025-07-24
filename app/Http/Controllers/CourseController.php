<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function mathematics()
{
    $courses = Course::all();

    return view('courses.mathematics', compact('courses'));
}

    public function showBySubject($subject)
{
    $courses = Course::where('subject', $subject)->get();
    return view('courses.subject', compact('courses', 'subject'));
}

}
