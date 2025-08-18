@extends('layouts.app')

@section('title', $course->title)

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Course Header -->
            <div class="course-header mb-4">
                <h1 class="display-5 fw-bold mb-3">{{ $course->title }}</h1>
                <p class="lead text-muted mb-4">{{ $course->description }}</p>
                
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ $course->teacher->avatar_url }}" alt="{{ $course->teacher->name }}" 
                         class="rounded-circle me-3" style="width: 50px; height: 50px;">
                    <div>
                        <h6 class="mb-0">{{ $course->teacher->name }}</h6>
                        <small class="text-muted">Instructor</small>
                    </div>
                </div>
                
                <div class="course-meta d-flex gap-4 mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-clock text-primary me-2"></i>
                        <span>{{ $course->duration }} hours</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users text-primary me-2"></i>
                        <span>{{ $course->enrollments()->count() }} students enrolled</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-star text-warning me-2"></i>
                        <span>{{ number_format($course->reviews()->avg('rating'), 1) }} ({{ $course->reviews()->count() }} reviews)</span>
                    </div>
                </div>
                
                @if($course->thumbnail)
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                         alt="{{ $course->title }}" class="img-fluid rounded mb-4">
                @endif
            </div>
            <!-- hgfht -->
            <!-- Course Content -->
            <div class="course-content">
                <h3 class="mb-4">What you'll learn</h3>
                <div class="row mb-5">
                    @foreach(explode("\n", $course->learning_outcomes) as $outcome)
                        @if(trim($outcome))
                            <div class="col-md-6 mb-2">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-check text-success me-2 mt-1"></i>
                                    <span>{{ trim($outcome) }}</span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                
                <!-- Course Modules -->
                <h3 class="mb-4">Course Content</h3>
                <div class="accordion" id="courseModules">
                    @foreach($course->modules as $index => $module)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="module{{ $module->id }}">
                                <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" 
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $module->id }}">
                                    <div class="d-flex justify-content-between align-items-center w-100 me-3">
                                        <span>{{ $module->title }}</span>
                                        <small class="text-muted">{{ $module->videos->count() }} lectures</small>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse{{ $module->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" 
                                 data-bs-parent="#courseModules">
                                <div class="accordion-body">
                                    <div class="list-group list-group-flush">
                                        @foreach($module->videos as $video)
                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-play-circle text-primary me-3"></i>
                                                    <div>
                                                        <h6 class="mb-1">{{ $video->title }}</h6>
                                                        <small class="text-muted">{{ $video->duration }} minutes</small>
                                                    </div>
                                                </div>
                                                @if($isEnrolled)
                                                    <a href="{{ route('student.courses.videos.watch', [$course, $video]) }}" 
                                                       class="btn btn-sm btn-outline-primary">Watch</a>
                                                @else
                                                    <span class="badge bg-secondary">Preview not available</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Requirements -->
                @if($course->requirements)
                    <div class="mt-5">
                        <h3 class="mb-4">Requirements</h3>
                        <ul class="list-unstyled">
                            @foreach(explode("\n", $course->requirements) as $requirement)
                                @if(trim($requirement))
                                    <li class="mb-2">
                                        <i class="fas fa-arrow-right text-primary me-2"></i>
                                        {{ trim($requirement) }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <!-- Reviews -->
                <div class="mt-5">
                    <h3 class="mb-4">Student Reviews</h3>
                    @forelse($course->reviews()->with('student')->latest()->limit(5)->get() as $review)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $review->student->avatar_url }}" alt="{{ $review->student->name }}" 
                                             class="rounded-circle me-2" style="width: 30px; height: 30px;">
                                        <h6 class="mb-0">{{ $review->student->name }}</h6>
                                    </div>
                                    <div class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p class="mb-0">{{ $review->comment }}</p>
                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-star fa-2x text-muted mb-3"></i>
                            <p class="text-muted">No reviews yet. Be the first to review this course!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Course Card -->
            <div class="card course-card sticky-top" style="top: 20px;">
                <div class="card-body">
                    @if($course->thumbnail)
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                             alt="{{ $course->title }}" class="img-fluid rounded mb-3">
                    @endif
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">${{ number_format($course->price, 2) }}</h4>
                        @if($course->original_price && $course->original_price > $course->price)
                            <span class="text-muted text-decoration-line-through">${{ number_format($course->original_price, 2) }}</span>
                        @endif
                    </div>
                    
                    @if($isEnrolled)
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>You are enrolled in this course
                        </div>
                        <a href="{{ route('student.courses.show', $course) }}" class="btn btn-primary w-100 mb-2">
                            Continue Learning
                        </a>
                    @else
                        <form action="{{ route('student.courses.enroll', $course) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100 mb-2">
                                Enroll Now
                            </button>
                        </form>
                    @endif
                    
                    <div class="course-features">
                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-play-circle me-2"></i>Videos</span>
                            <span>{{ $course->modules->sum(function($module) { return $module->videos->count(); }) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-clock me-2"></i>Duration</span>
                            <span>{{ $course->duration }} hours</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-download me-2"></i>Downloads</span>
                            <span>{{ $course->modules->sum(function($module) { return $module->videos->where('has_download', true)->count(); }) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-infinity me-2"></i>Access</span>
                            <span>Lifetime</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span><i class="fas fa-mobile-alt me-2"></i>Access on</span>
                            <span>Mobile & TV</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span><i class="fas fa-certificate me-2"></i>Certificate</span>
                            <span>Yes</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.course-card {
    border: none;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.course-features {
    border-top: 1px solid #eee;
    padding-top: 1rem;
    margin-top: 1rem;
}

.accordion-button:not(.collapsed) {
    background-color: #f8f9fa;
    color: #667eea;
}

.accordion-button:focus {
    box-shadow: none;
    border-color: #667eea;
}
</style>
@endsection 