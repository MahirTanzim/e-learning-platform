<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('welcome');
});

// Public routes
Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/become-a-teacher', function () {
    return view('become-teacher');
})->name('become.teacher');

// Course routes (public)
Route::get('/courses/mathematics', [CourseController::class, 'mathematics'])->name('courses.mathematics');
Route::get('/courses/physics', [CourseController::class, 'physics'])->name('courses.physics');
Route::get('/courses/chemistry', [CourseController::class, 'chemistry'])->name('courses.chemistry');
Route::get('/courses/biology', [CourseController::class, 'biology'])->name('courses.biology');
Route::get('/courses/english', [CourseController::class, 'english'])->name('courses.english');

// Purchase routes
Route::get('/courses/{id}/purchase', [CourseController::class, 'purchase'])->name('courses.purchase');
Route::get('/purchase-success', function () {
    return view('purchase-success');
})->name('purchase.success');

// Authentication routes
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    $role = $request->input('role');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Check if the user's role matches the selected role
        if (($user->role ?? '') !== $role) {
            Auth::logout();
            return back()->with('error', 'Invalid role selected for this account.');
        }

        $request->session()->regenerate();

        // Redirect based on role
        switch ($user->role ?? '') {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'teacher':
                return redirect()->route('teacher.dashboard');
            case 'student':
                return redirect()->route('student.dashboard');
            default:
                return redirect()->intended('/');
        }
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
        'role' => 'required|in:student,teacher',
    ]);

    $user = \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'role' => $validated['role'],
    ]);

    Auth::login($user);
    $request->session()->regenerate();

    // Redirect based on role
    switch ($user->role) {
        case 'teacher':
            return redirect()->route('teacher.dashboard');
        case 'student':
            return redirect()->route('student.dashboard');
        default:
            return redirect()->intended('/');
    }
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Protected routes
Route::middleware(['auth'])->group(function () {
    
    // Student routes
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class.':student'])->group(function () {
        Route::get('/student/dashboard', function () {
            return view('courses.student');
        })->name('student.dashboard');
    });
    
    // Teacher routes
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class.':teacher'])->group(function () {
        Route::get('/teacher/dashboard', function () {
            return view('teacher');
        })->name('teacher.dashboard');
    });
    
    // Admin routes
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class.':admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });
});
