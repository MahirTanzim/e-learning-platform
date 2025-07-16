<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// ...existing code...

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

// ...existing code...
// Show login form
Route::get('/login', function () {
    return view('login');
})->name('login');

// Handle login POST
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }
    return back()->with('error', 'Invalid credentials.');
});

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $user = \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);

    Auth::login($user);
    $request->session()->regenerate();

    return redirect()->intended('/');
});
Route::get('/become-a-teacher', function () {
    return view('become-teacher');
})->name('become.teacher');

Route::get('/courses/physics', function () {
    return view('courses.physics');
})->name('courses.physics');


Route::get('/courses/chemistry', function () {
    return view('courses.chemistry'); 
})->name('courses.chemistry');

Route::get('/courses/mathematics', function () {
    return view('courses.mathematics');
})->name('courses.mathematics');

Route::get('/courses/english', function () {
    return view('courses.english');
})->name('courses.english');

Route::get('/courses/biology', function () {
    return view('courses.biology');
})->name('courses.biology');

return view('student-portal', [
    'courses' => Auth::user()->courses, // or Course::all() for test
    'messages' => Message::where('user_id', Auth::id())->latest()->get(),
]);

use App\Http\Controllers\TeacherPortalController;

Route::middleware(['auth'])->group(function () {
    Route::get('/teacher-portal', [TeacherPortalController::class, 'index'])->name('teacher.portal');
});
