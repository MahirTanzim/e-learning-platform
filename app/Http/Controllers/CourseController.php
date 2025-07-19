<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function mathematics()
    {
        $courses = Course::where('category', 'Mathematics')->get();
        return view('courses.mathematics', compact('courses'));
    }
}
