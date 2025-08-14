@extends('layouts.student')

@section('title', 'Teacher Dashboard')

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
                            <p class="mb-0">Manage your courses and track student engagement.</p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <i class="fas fa-chalkboard-teacher fa-3x opacity-75"></i>
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
                                Total Courses
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCourses }}</div>
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
                                Total Students
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalStudents }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
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
                                Total Revenue
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($totalRevenue, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
                                Blog Posts
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBlogPosts }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- My Courses -->
    <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">My Courses</h6>
                    <a href="{{ route('teacher.courses.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus me-1"></i>Create Course
                    </a>
                </div>
                <div class="card-body">
                    @if($myCourses->count() > 0)
                        <div class="row">
                            @foreach($myCourses as $course)
                                <div class="col-lg-6 mb-4">
                                    <div class="card course-card h-100">
                                        @if($course->thumbnail)
                                            <img src="{{ asset('storage/' . $course->thumbnail) }}"
                                                 class="card-img-top" alt="{{ $course->title }}"
                                                 style="height: 150px; object-fit: cover;">
                                        @else
                                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                                 style="height: 150px;">
                                                <i class="fas fa-book fa-2x text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="card-body d-flex flex-column">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <h6 class="card-title mb-0">{{ $course->title }}</h6>
                                                <span class="badge bg-{{ $course->status === 'published' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($course->status) }}
                                                </span>
                                            </div>
                                            <p class="card-text text-muted flex-grow-1">
                                                {{ Str::limit($course->description, 80) }}
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <small class="text-muted">
                                                    <i class="fas fa-users me-1"></i>{{ $course->enrollments()->count() }} students
                                                </small>
                                                <small class="text-muted">${{ number_format($course->price, 2) }}</small>
                                            </div>
                                            <div class="btn-group w-100" role="group">
                                                <a href="{{ route('teacher.courses.show', $course) }}"
                                                   class="btn btn-outline-primary btn-sm">View</a>
                                                <a href="{{ route('teacher.courses.edit', $course) }}"
                                                   class="btn btn-outline-secondary btn-sm">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                            <h5>No courses created yet</h5>
                            <p class="text-muted">Start creating your first course to share your knowledge!</p>
                            <a href="{{ route('teacher.courses.create') }}" class="btn btn-primary">
                                Create Your First Course
                            </a>
                        </div>
                    @endif
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
