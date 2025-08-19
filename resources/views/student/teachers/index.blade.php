@extends('layouts.student')

@section('title', 'Browse Teachers')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Browse Teachers</h1>
            
            @if($teachers->count() > 0)
                <div class="row">
                    @foreach($teachers as $teacher)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card teacher-card h-100">
                                <div class="card-body text-center">
                                    <img src="{{ $teacher->avatar_url }}" alt="{{ $teacher->name }}" 
                                         class="rounded-circle mb-3" style="width: 120px; height: 120px;">
                                    <h5 class="card-title mb-2">{{ $teacher->name }}</h5>
                                    <p class="text-muted mb-3">{{ $teacher->email }}</p>
                                    
                                    @if($teacher->profile && $teacher->profile->bio)
                                        <p class="text-muted small mb-3">{{ Str::limit($teacher->profile->bio, 100) }}</p>
                                    @endif
                                    
                                    <div class="row text-center mb-3">
                                        <div class="col-6">
                                            <h6 class="mb-1">{{ $teacher->courses_count }}</h6>
                                            <small class="text-muted">Courses</small>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="mb-1">{{ $teacher->followers_count }}</h6>
                                            <small class="text-muted">Followers</small>
                                        </div>
                                    </div>
                                    
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('student.teachers.show', $teacher) }}" 
                                           class="btn btn-primary">
                                            <i class="fas fa-user me-2"></i>View Profile
                                        </a>
                                        
                                        @if($teacher->courses_count > 0)
                                            <a href="{{ route('courses.index') }}?teacher={{ $teacher->id }}" 
                                               class="btn btn-outline-primary">
                                                <i class="fas fa-book me-2"></i>View Courses
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $teachers->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-chalkboard-teacher fa-3x text-muted mb-3"></i>
                    <h4>No teachers available</h4>
                    <p class="text-muted">There are currently no teachers registered on the platform.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.teacher-card {
    transition: transform 0.2s;
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.teacher-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}
</style>
@endsection
