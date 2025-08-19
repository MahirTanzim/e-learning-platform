@extends('layouts.student')

@section('title', $course->title)

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-8">
            <!-- Course Header -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
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
                        <div>
                            <h2 class="mb-1">{{ $course->title }}</h2>
                            <p class="text-muted mb-0">by {{ $course->teacher->name }}</p>
                        </div>
                    </div>
                    
                    <div class="course-meta d-flex gap-4 mb-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clock text-primary me-2"></i>
                            <span>{{ $course->duration ?? 0 }} hours</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-users text-primary me-2"></i>
                            <span>{{ $course->enrollments()->count() }} students</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-star text-warning me-2"></i>
                            <span>{{ number_format($course->reviews()->avg('rating'), 1) }} ({{ $course->reviews()->count() }} reviews)</span>
                        </div>
                    </div>
                    
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar" role="progressbar" 
                             style="width: {{ $enrollment->progress ?? 0 }}%"></div>
                    </div>
                    <small class="text-muted">Progress: {{ $enrollment->progress ?? 0 }}%</small>
                </div>
            </div>

            <!-- Course Content -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Course Content</h5>
                </div>
                <div class="card-body">
                    @if($course->modules->count() > 0)
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
                                                                <small class="text-muted">{{ $video->duration ?? 0 }} minutes</small>
                                                            </div>
                                                        </div>
                                                        <a href="{{ route('student.courses.videos.watch', [$course, $video]) }}" 
                                                           class="btn btn-sm btn-outline-primary">Watch</a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-video fa-2x text-muted mb-3"></i>
                            <p class="text-muted">No content available yet. Check back later!</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Course Description -->
            @if($course->description)
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">About This Course</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $course->description }}</p>
                    </div>
                </div>
            @endif

            <!-- Learning Outcomes -->
            @if($course->learning_outcomes)
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">What You'll Learn</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
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
                    </div>
                </div>
            @endif

            <!-- Requirements -->
            @if($course->requirements)
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">Requirements</h5>
                    </div>
                    <div class="card-body">
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
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <!-- Enrollment/Payment Card -->
            @if(!auth()->user()->isEnrolledIn($course->id))
                <div class="card mb-4 border-success">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-lock me-2"></i>Enroll in This Course</h5>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h4 class="text-success mb-2">${{ number_format($course->price, 2) }}</h4>
                                <p class="mb-3">Get access to all course content, quizzes, and assignments</p>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-check text-success me-2"></i>Lifetime access to course content</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Interactive quizzes and assignments</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Certificate upon completion</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Direct access to instructor</li>
                                </ul>
                            </div>
                            <div class="col-md-4 text-center">
                                <a href="{{ route('student.courses.payment', $course) }}" class="btn btn-success btn-lg w-100">
                                    <i class="fas fa-credit-card me-2"></i>Enroll Now
                                </a>
                                <small class="text-muted d-block mt-2">Secure payment processing</small>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card mb-4 border-primary">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-check-circle me-2"></i>You're Enrolled!</h5>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h6 class="mb-2">Welcome to the course!</h6>
                                <p class="mb-2">You have full access to all course content.</p>
                                <div class="progress mb-2" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: {{ $enrollment->progress ?? 0 }}%"></div>
                                </div>
                                <small class="text-muted">Progress: {{ $enrollment->progress ?? 0 }}%</small>
                            </div>
                            <div class="col-md-4 text-center">
                                <span class="badge bg-success fs-6">Enrolled</span>
                                <small class="text-muted d-block mt-2">Keep learning!</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Course Info Card -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Course Information</h5>
                    <div class="mb-3">
                        <strong>Category:</strong> {{ $course->category->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Level:</strong> {{ ucfirst($course->level) }}
                    </div>
                    <div class="mb-3">
                        <strong>Duration:</strong> {{ $course->duration ?? 0 }} hours
                    </div>
                    <div class="mb-3">
                        <strong>Modules:</strong> {{ $course->modules->count() }}
                    </div>
                    <div class="mb-3">
                        <strong>Videos:</strong> {{ $course->modules->sum(function($m) { return $m->videos->count(); }) }}
                    </div>
                    @if($course->certificate_available)
                        <div class="alert alert-info">
                            <i class="fas fa-certificate me-2"></i>Certificate available upon completion
                        </div>
                    @endif
                </div>
            </div>

            <!-- Instructor Info -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Instructor</h5>
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $course->teacher->avatar_url }}" alt="{{ $course->teacher->name }}" 
                             class="rounded-circle me-3" style="width: 50px; height: 50px;">
                        <div>
                            <h6 class="mb-1">{{ $course->teacher->name }}</h6>
                            <small class="text-muted">Instructor</small>
                        </div>
                    </div>
                    <a href="{{ route('student.teachers.show', $course->teacher) }}" class="btn btn-outline-primary btn-sm">
                        View Profile
                    </a>
                </div>
            </div>

            <!-- Course Reviews -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Student Reviews</h5>
                </div>
                <div class="card-body">
                    @if($course->reviews()->count() > 0)
                        @foreach($course->reviews()->with('student')->latest()->limit(3)->get() as $review)
                            <div class="mb-3">
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
                                <p class="mb-0">{{ Str::limit($review->comment, 100) }}</p>
                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">No reviews yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.accordion-button:not(.collapsed) {
    background-color: #f8f9fa;
    color: #667eea;
}

.accordion-button:focus {
    box-shadow: none;
    border-color: #667eea;
}

.progress-bar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.card {
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>
@endsection 