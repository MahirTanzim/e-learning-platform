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
     <!-- Recent Enrollments -->
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Enrollments</h6>
                    <a href="{{ route('teacher.courses.index') }}" class="btn btn-sm btn-primary">
                        View All Courses
                    </a>
                </div>
                <div class="card-body">
                    @if($recentEnrollments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Course</th>
                                        <th>Enrolled</th>
                                        <th>Progress</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentEnrollments as $enrollment)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $enrollment->student->avatar_url }}"
                                                         alt="{{ $enrollment->student->name }}"
                                                         class="rounded-circle me-2" style="width: 30px; height: 30px;">
                                                    <span>{{ $enrollment->student->name }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $enrollment->course->title }}</td>
                                            <td>{{ $enrollment->enrolled_at->diffForHumans() }}</td>
                                            <td>
                                                <div class="progress" style="height: 6px; width: 100px;">
                                                    <div class="progress-bar" role="progressbar"
                                                         style="width: {{ $enrollment->progress ?? 0 }}%"></div>
                                                </div>
                                                <small class="text-muted">{{ $enrollment->progress ?? 0 }}%</small>
                                            </td>
                                            <td>
                                                <a href="{{ route('teacher.courses.show', $enrollment->course) }}"
                                                   class="btn btn-sm btn-outline-primary">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-users fa-2x text-muted mb-3"></i>
                            <p class="text-muted">No recent enrollments.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    <!-- My Courses & Quick Actions -->
    <div class="row">
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

        <!-- Quick Actions -->
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('teacher.courses.create') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-plus me-3 text-primary"></i>
                            Create New Course
                        </a>
                        <a href="{{ route('teacher.blog.create') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-edit me-3 text-primary"></i>
                            Write Blog Post
                        </a>
                        <a href="{{ route('teacher.blog.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-newspaper me-3 text-primary"></i>
                            Manage Blog Posts
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-chart-bar me-3 text-primary"></i>
                            View Analytics
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-cog me-3 text-primary"></i>
                            Settings
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Blog Posts -->
            <div class="card shadow mt-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Blog Posts</h6>
                </div>
                <div class="card-body">
                    @if($recentBlogPosts->count() > 0)
                        @foreach($recentBlogPosts as $post)
                            <div class="mb-3">
                                <h6 class="mb-1">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
                                        {{ Str::limit($post->title, 40) }}
                                    </a>
                                </h6>
                                <small class="text-muted">{{ $post->created_at->format('M d, Y') }}</small>
                                <div class="mt-1">
                                    <small class="text-muted">
                                        <i class="fas fa-heart me-1"></i>{{ $post->likes()->count() }}
                                        <i class="fas fa-comment ms-2 me-1"></i>{{ $post->comments()->count() }}
                                    </small>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-3">
                            <p class="text-muted">No blog posts yet.</p>
                            <a href="{{ route('teacher.blog.create') }}" class="btn btn-sm btn-primary">
                                Write First Post
                            </a>
                        </div>
                    @endif
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
