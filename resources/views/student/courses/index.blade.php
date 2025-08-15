@extends('layouts.student')

@section('title', 'My Enrolled Courses')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">My Enrolled Courses</h1>
        <a href="{{ route('courses.index') }}" class="btn btn-primary">
            <i class="fas fa-search me-2"></i>Browse More Courses
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

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
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0">{{ $course->title }}</h5>
                                <span class="badge bg-primary">{{ $course->category->name }}</span>
                            </div>
                            
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
                            
                            <div class="course-meta mb-3">
                                <div class="row text-center">
                                    <div class="col-4">
                                        <div class="text-primary fw-bold">{{ $course->modules->count() }}</div>
                                        <small class="text-muted">Modules</small>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-success fw-bold">{{ $course->modules->sum(function($m) { return $m->videos->count(); }) }}</div>
                                        <small class="text-muted">Videos</small>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-info fw-bold">{{ $course->teacher->name }}</div>
                                        <small class="text-muted">Instructor</small>
                                    </div>
                                </div>
                            </div>
                            
                            <a href="{{ route('student.courses.show', $course) }}" class="btn btn-primary">
                                <i class="fas fa-play me-2"></i>Continue Learning
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-center">
            {{ $enrolledCourses->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
            <h4>No enrolled courses yet</h4>
            <p class="text-muted">Start your learning journey by enrolling in a course!</p>
            <a href="{{ route('courses.index') }}" class="btn btn-primary">
                Browse Courses
            </a>
        </div>
    @endif
</div>

<style>
.course-card {
    transition: transform 0.2s;
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.course-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.course-meta {
    border-top: 1px solid #eee;
    padding-top: 1rem;
}

.progress-bar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
</style>
@endsection 