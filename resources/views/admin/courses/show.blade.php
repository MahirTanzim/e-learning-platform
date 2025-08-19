@extends('layouts.admin')

@section('title', 'Course Details')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Course Details</h1>
                <div>
                    <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-primary me-2">
                        <i class="fas fa-edit me-2"></i>Edit Course
                    </a>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Courses
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <!-- Course Information -->
                <div class="col-lg-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Course Information</h6>
                        </div>
                        <div class="card-body">
                            @if($course->thumbnail)
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                                     alt="{{ $course->title }}" class="img-fluid rounded mb-3">
                            @endif
                            
                            <h4 class="mb-2">{{ $course->title }}</h4>
                            <p class="text-muted mb-3">{{ $course->description }}</p>
                            
                            <div class="row text-center mb-3">
                                <div class="col-6">
                                    <h5 class="mb-1">
                                        @if($course->status === 'published')
                                            <span class="badge bg-success">Published</span>
                                        @else
                                            <span class="badge bg-warning">Draft</span>
                                        @endif
                                    </h5>
                                    <small class="text-muted">Status</small>
                                </div>
                                <div class="col-6">
                                    <h5 class="mb-1">${{ number_format($course->price, 2) }}</h5>
                                    <small class="text-muted">Price</small>
                                </div>
                            </div>
                            
                            <hr>
                            <div class="row text-center">
                                <div class="col-6">
                                    <h5 class="mb-1">{{ $course->category->name }}</h5>
                                    <small class="text-muted">Category</small>
                                </div>
                                <div class="col-6">
                                    <h5 class="mb-1">{{ $course->created_at->format('M d, Y') }}</h5>
                                    <small class="text-muted">Created</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Teacher Information -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Teacher Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $course->teacher->avatar_url }}" alt="{{ $course->teacher->name }}" 
                                     class="rounded-circle me-3" style="width: 60px; height: 60px;">
                                <div>
                                    <h6 class="mb-1">{{ $course->teacher->name }}</h6>
                                    <small class="text-muted">{{ $course->teacher->email }}</small>
                                </div>
                            </div>
                            <a href="{{ route('admin.users.show', $course->teacher) }}" class="btn btn-outline-primary btn-sm">
                                View Teacher Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Course Content -->
                <div class="col-lg-8">
                    <!-- Course Statistics -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Course Statistics</h6>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-3 mb-3">
                                    <div class="border rounded p-3">
                                        <h4 class="mb-1 text-primary">{{ $course->enrollments->count() }}</h4>
                                        <p class="text-muted mb-0">Enrolled Students</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border rounded p-3">
                                        <h4 class="mb-1 text-success">{{ $course->modules->count() }}</h4>
                                        <p class="text-muted mb-0">Modules</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border rounded p-3">
                                        <h4 class="mb-1 text-info">{{ $course->modules->sum(function($module) { return $module->videos->count(); }) }}</h4>
                                        <p class="text-muted mb-0">Videos</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="border rounded p-3">
                                        <h4 class="mb-1 text-warning">{{ $course->reviews->count() }}</h4>
                                        <p class="text-muted mb-0">Reviews</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course Modules -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Course Modules</h6>
                        </div>
                        <div class="card-body">
                            @if($course->modules->count() > 0)
                                @foreach($course->modules as $module)
                                    <div class="border-bottom pb-3 mb-3">
                                        <h6 class="mb-2">{{ $module->title }}</h6>
                                        <p class="text-muted mb-2">{{ $module->description }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">{{ $module->videos->count() }} videos</small>
                                            <small class="text-muted">{{ $module->order }} of {{ $course->modules->count() }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted">No modules created yet.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Enrollments -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Recent Enrollments</h6>
                        </div>
                        <div class="card-body">
                            @if($course->enrollments->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Student</th>
                                                <th>Enrolled</th>
                                                <th>Progress</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($course->enrollments->take(10) as $enrollment)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ $enrollment->student->avatar_url }}" 
                                                                 alt="{{ $enrollment->student->name }}" 
                                                                 class="rounded-circle me-2" style="width: 30px; height: 30px;">
                                                            <span>{{ $enrollment->student->name }}</span>
                                                        </div>
                                                    </td>
                                                    <td>{{ $enrollment->enrolled_at->format('M d, Y') }}</td>
                                                    <td>
                                                        <div class="progress" style="height: 6px;">
                                                            <div class="progress-bar" role="progressbar" 
                                                                 style="width: {{ $enrollment->progress ?? 0 }}%;"></div>
                                                        </div>
                                                        <small class="text-muted">{{ $enrollment->progress ?? 0 }}%</small>
                                                    </td>
                                                    <td>
                                                        @if($enrollment->completed_at)
                                                            <span class="badge bg-success">Completed</span>
                                                        @else
                                                            <span class="badge bg-info">In Progress</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted">No enrollments yet.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Course Reviews -->
                    @if($course->reviews->count() > 0)
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Course Reviews</h6>
                            </div>
                            <div class="card-body">
                                @foreach($course->reviews->take(5) as $review)
                                    <div class="border-bottom pb-3 mb-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <img src="{{ $review->student->avatar_url }}" 
                                                         alt="{{ $review->student->name }}" 
                                                         class="rounded-circle me-2" style="width: 30px; height: 30px;">
                                                    <h6 class="mb-0">{{ $review->student->name }}</h6>
                                                </div>
                                                <div class="mb-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                                    <span class="ms-2 text-muted">{{ $review->rating }}/5</span>
                                                </div>
                                                <p class="mb-1">{{ $review->comment }}</p>
                                            </div>
                                            <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
