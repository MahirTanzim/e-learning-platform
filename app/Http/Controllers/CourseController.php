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

}
