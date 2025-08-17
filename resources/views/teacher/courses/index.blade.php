@extends('layouts.student')

@section('title', 'My Courses')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">My Courses</h1>
        <a href="{{ route('teacher.courses.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Create New Course
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($courses->count() > 0)
        <div class="row">
            @foreach($courses as $course)
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
                                <span class="badge bg-{{ $course->status === 'published' ? 'success' : 'warning' }}">
                                    {{ ucfirst($course->status) }}
                                </span>
                            </div>

                            <p class="card-text text-muted flex-grow-1">
                                {{ Str::limit($course->description, 100) }}
                            </p>

                            <div class="course-stats mb-3">
                                <div class="row text-center">
                                    <div class="col-4">
                                        <div class="text-primary fw-bold">{{ $course->enrollments_count }}</div>
                                        <small class="text-muted">Students</small>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-success fw-bold">${{ number_format($course->price, 2) }}</div>
                                        <small class="text-muted">Price</small>
                                    </div>
                                    <div class="col-4">
                                        <div class="text-info fw-bold">{{ $course->category->name }}</div>
                                        <small class="text-muted">Category</small>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-group w-100" role="group">
                                <a href="{{ route('teacher.courses.show', $course) }}"
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>View
                                </a>
                                <a href="{{ route('teacher.courses.edit', $course) }}"
                                   class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                                <button type="button" class="btn btn-outline-danger btn-sm"
                                        onclick="deleteCourse({{ $course->id }})">
                                    <i class="fas fa-trash me-1"></i>Delete
                                </button>
                            </div>


                        </div>
                    </div>
                </div>
            @endforeach
        </div>


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

.course-stats {
    border-top: 1px solid #eee;
    padding-top: 1rem;
}
</style>
@endsection
