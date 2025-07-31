@extends('layouts.student')

@section('title', 'Student Dashboard')

@section('content')
<div class="container-fluid py-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-2">Welcome back, {{ auth()->user()->name }}!</h2>
                            <p class="mb-0">Continue your learning journey and track your progress.</p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <i class="fas fa-graduation-cap fa-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Enrolled Courses
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $enrolledCourses->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Completed Courses
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $completedCourses }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                In Progress
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $inProgressCourses }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Following Teachers
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $followingTeachers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enrolled Courses -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">My Enrolled Courses</h6>
                    <a href="{{ route('student.courses.index') }}" class="btn btn-sm btn-primary">
                        View All Courses
                    </a>
                </div>
                <div class="card-body">
                    @if($enrolledCourses->count() > 0)
                        <div class="row">
                            @foreach($enrolledCourses as $course)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="card course-card h-100">
                                        @if($course->thumbnail)
                                            <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                                                 class="card-img-top" alt="{{ $course->title }}" 
                                                 style="height: 200px; object-fit: cover;">
                                        @else
                                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                                 style="height: 200px;">
                                                <i class="fas fa-book fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $course->title }}</h5>
                                            <p class="card-text text-muted flex-grow-1">
                                                {{ Str::limit($course->description, 100) }}
                                            </p>
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <small class="text-muted">Progress</small>
                                                    <small class="text-muted">{{ $course->pivot->progress ?? 0 }}%</small>
                                                </div>
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar" role="progressbar" 
                                                         style="width: {{ $course->pivot->progress ?? 0 }}%"></div>
                                                </div>
                                            </div>
                                            <a href="{{ route('student.courses.show', $course) }}" 
                                               class="btn btn-primary">Continue Learning</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                            <h5>No enrolled courses yet</h5>
                            <p class="text-muted">Start your learning journey by enrolling in a course!</p>
                            <a href="{{ route('courses.index') }}" class="btn btn-primary">
                                Browse Courses
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Courses & Quick Actions -->
    <div class="row">
        <!-- Recent Courses -->
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recently Added Courses</h6>
                </div>
                <div class="card-body">
                    @if($recentCourses->count() > 0)
                        <div class="row">
                            @foreach($recentCourses as $course)
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex">
                                        @if($course->thumbnail)
                                            <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                                                 alt="{{ $course->title }}" class="rounded me-3" 
                                                 style="width: 80px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" 
                                                 style="width: 80px; height: 60px;">
                                                <i class="fas fa-book text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $course->title }}</h6>
                                            <small class="text-muted">{{ $course->teacher->name }}</small>
                                            <div class="mt-2">
                                                <span class="badge bg-primary me-1">{{ $course->category->name }}</span>
                                                <span class="text-muted">${{ number_format($course->price, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-muted">No recent courses available.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('courses.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-search me-3 text-primary"></i>
                            Browse All Courses
                        </a>
                        <a href="{{ route('student.teachers.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-chalkboard-teacher me-3 text-primary"></i>
                            Find Teachers
                        </a>
                        <a href="{{ route('blog.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-newspaper me-3 text-primary"></i>
                            Read Blog Posts
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-certificate me-3 text-primary"></i>
                            View Certificates
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.border-left-primary {
    border-left: 0.25rem solid #667eea !important;
}

.border-left-success {
    border-left: 0.25rem solid #28a745 !important;
}

.border-left-info {
    border-left: 0.25rem solid #17a2b8 !important;
}

.border-left-warning {
    border-left: 0.25rem solid #ffc107 !important;
}

.course-card {
    transition: transform 0.2s;
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.course-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.progress-bar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
</style>
@endsection 