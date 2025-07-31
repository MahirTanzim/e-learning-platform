<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\CourseController as StudentCourseController;
use App\Http\Controllers\Student\TeacherController as StudentTeacherController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController;
use App\Http\Controllers\Teacher\BlogController as TeacherBlogController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/courses', [HomeController::class, 'courses'])->name('courses.index');
Route::get('/course/{slug}', [HomeController::class, 'showCourse'])->name('courses.show');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [HomeController::class, 'showBlog'])->name('blog.show');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    
    // Student Routes
    Route::middleware(['role:student'])->prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        
        // Course Routes
        Route::get('/courses', [StudentCourseController::class, 'index'])->name('courses.index');
        Route::post('/courses/{course}/enroll', [StudentCourseController::class, 'enroll'])->name('courses.enroll');
        Route::get('/courses/{course}', [StudentCourseController::class, 'show'])
             ->middleware('course.enrolled')
             ->name('courses.show');
        Route::get('/courses/{course}/videos/{video}', [StudentCourseController::class, 'watchVideo'])
             ->middleware('course.enrolled')
             ->name('courses.videos.watch');
        Route::post('/videos/{video}/progress', [StudentCourseController::class, 'updateVideoProgress'])
             ->name('videos.progress');
        Route::post('/courses/{course}/review', [StudentCourseController::class, 'submitReview'])
             ->name('courses.review');
        
        // Teacher Routes
        Route::get('/teachers', [StudentTeacherController::class, 'index'])->name('teachers.index');
        Route::get('/teachers/{teacher}', [StudentTeacherController::class, 'show'])->name('teachers.show');
        Route::post('/teachers/{teacher}/follow', [StudentTeacherController::class, 'follow'])->name('teachers.follow');
    });

    // Teacher Routes
    Route::middleware(['role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
        Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');
        
        // Course Management Routes - Create and Index outside middleware
        Route::get('/courses', [TeacherCourseController::class, 'index'])->name('courses.index');
        Route::get('/courses/create', [TeacherCourseController::class, 'create'])->name('courses.create');
        Route::post('/courses', [TeacherCourseController::class, 'store'])->name('courses.store');
        
        // Course Management Routes - Protected by ownership
        Route::middleware(['course.owner'])->group(function () {
            Route::get('/courses/{course}', [TeacherCourseController::class, 'show'])->name('courses.show');
            Route::get('/courses/{course}/edit', [TeacherCourseController::class, 'edit'])->name('courses.edit');
            Route::patch('/courses/{course}', [TeacherCourseController::class, 'update'])->name('courses.update');
            Route::delete('/courses/{course}', [TeacherCourseController::class, 'destroy'])->name('courses.destroy');
            
            // Module Routes
            Route::get('/courses/{course}/modules/create', [TeacherCourseController::class, 'createModule'])->name('courses.modules.create');
            Route::post('/courses/{course}/modules', [TeacherCourseController::class, 'storeModule'])->name('courses.modules.store');
            Route::get('/courses/{course}/modules/{module}/edit', [TeacherCourseController::class, 'editModule'])->name('courses.modules.edit');
            Route::patch('/courses/{course}/modules/{module}', [TeacherCourseController::class, 'updateModule'])->name('courses.modules.update');
            Route::delete('/courses/{course}/modules/{module}', [TeacherCourseController::class, 'destroyModule'])->name('courses.modules.destroy');
            
            // Video Routes
            Route::get('/courses/{course}/modules/{module}/videos/create', [TeacherCourseController::class, 'createVideo'])->name('courses.videos.create');
            Route::post('/courses/{course}/modules/{module}/videos', [TeacherCourseController::class, 'storeVideo'])->name('courses.videos.store');
            Route::patch('/courses/{course}/modules/{module}/videos/{video}', [TeacherCourseController::class, 'updateVideo'])->name('courses.videos.update');
            Route::delete('/courses/{course}/modules/{module}/videos/{video}', [TeacherCourseController::class, 'destroyVideo'])->name('courses.videos.destroy');
            
            // Quiz Routes
            Route::get('/courses/{course}/quizzes/create', [TeacherCourseController::class, 'createQuiz'])->name('courses.quizzes.create');
            Route::post('/courses/{course}/quizzes', [TeacherCourseController::class, 'storeQuiz'])->name('courses.quizzes.store');
            Route::get('/courses/{course}/quizzes/{quiz}', [TeacherCourseController::class, 'showQuiz'])->name('courses.quizzes.show');
            Route::get('/courses/{course}/quizzes/{quiz}/edit', [TeacherCourseController::class, 'editQuiz'])->name('courses.quizzes.edit');
            Route::patch('/courses/{course}/quizzes/{quiz}', [TeacherCourseController::class, 'updateQuiz'])->name('courses.quizzes.update');
            Route::delete('/courses/{course}/quizzes/{quiz}', [TeacherCourseController::class, 'destroyQuiz'])->name('courses.quizzes.destroy');
            
            // Assignment Routes
            Route::get('/courses/{course}/assignments/create', [TeacherCourseController::class, 'createAssignment'])->name('courses.assignments.create');
            Route::post('/courses/{course}/assignments', [TeacherCourseController::class, 'storeAssignment'])->name('courses.assignments.store');
            Route::get('/courses/{course}/assignments/{assignment}/edit', [TeacherCourseController::class, 'editAssignment'])->name('courses.assignments.edit');
            Route::patch('/courses/{course}/assignments/{assignment}', [TeacherCourseController::class, 'updateAssignment'])->name('courses.assignments.update');
            Route::delete('/courses/{course}/assignments/{assignment}', [TeacherCourseController::class, 'destroyAssignment'])->name('courses.assignments.destroy');
        });
        
        // Blog Routes
        Route::resource('blog', TeacherBlogController::class);
        Route::post('/blog/{post}/like', [TeacherBlogController::class, 'toggleLike'])->name('blog.like');
        Route::post('/blog/{post}/comment', [TeacherBlogController::class, 'storeComment'])->name('blog.comment');
        Route::delete('/blog/{post}/comment/{comment}', [TeacherBlogController::class, 'destroyComment'])->name('blog.comment.destroy');
    });

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // User Management
        Route::resource('users', AdminUserController::class);
        Route::patch('/users/{user}/suspend', [AdminUserController::class, 'suspend'])->name('users.suspend');
        Route::patch('/users/{user}/activate', [AdminUserController::class, 'activate'])->name('users.activate');
        
        // Course Management
        Route::resource('courses', AdminCourseController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
        Route::patch('/courses/{course}/archive', [AdminCourseController::class, 'archive'])->name('courses.archive');
        Route::patch('/courses/{course}/publish', [AdminCourseController::class, 'publish'])->name('courses.publish');
        
        // Complaint Management
        Route::resource('complaints', AdminComplaintController::class)->only(['index', 'show', 'update', 'destroy']);
    });
});

// API Routes for AJAX calls
Route::middleware(['auth'])->prefix('api')->group(function () {
    Route::post('/blog/{post}/like', [TeacherBlogController::class, 'toggleLike'])->name('api.blog.like');
});