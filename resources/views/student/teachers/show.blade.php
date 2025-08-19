@extends('layouts.student')

@section('title', $teacher->name . ' - Teacher Profile')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Teacher Profile -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <img src="{{ $teacher->avatar_url }}" alt="{{ $teacher->name }}" 
                         class="rounded-circle mb-3" style="width: 150px; height: 150px;">
                    <h3 class="mb-2">{{ $teacher->name }}</h3>
                    <p class="text-muted mb-3">{{ $teacher->email }}</p>
                    
                    @if($teacher->profile && $teacher->profile->bio)
                        <p class="text-muted">{{ $teacher->profile->bio }}</p>
                    @endif
                    
                    <div class="row text-center mb-3">
                        <div class="col-6">
                            <h5 class="mb-1">{{ $teacher->courses_count }}</h5>
                            <small class="text-muted">Courses</small>
                        </div>
                        <div class="col-6">
                            <h5 class="mb-1">{{ $teacher->followers_count }}</h5>
                            <small class="text-muted">Followers</small>
                        </div>
                    </div>
                    
                    @if($teacher->profile)
                        <div class="row text-center mb-3">
                            @if($teacher->profile->phone)
                                <div class="col-6">
                                    <small class="text-muted">
                                        <i class="fas fa-phone me-1"></i>{{ $teacher->profile->phone }}
                                    </small>
                                </div>
                            @endif
                            @if($teacher->profile->website)
                                <div class="col-6">
                                    <small class="text-muted">
                                        <i class="fas fa-globe me-1"></i>
                                        <a href="{{ $teacher->profile->website }}" target="_blank">Website</a>
                                    </small>
                                </div>
                            @endif
                        </div>
                    @endif
                    
                    <!-- Follow/Unfollow Button -->
                    <form action="{{ route('student.teachers.follow', $teacher) }}" method="POST" class="d-inline">
                        @csrf
                        @if($isFollowing)
                            <button type="submit" class="btn btn-outline-secondary">
                                <i class="fas fa-user-minus me-2"></i>Unfollow
                            </button>
                        @else
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-user-plus me-2"></i>Follow
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <!-- Teacher Content -->
        <div class="col-lg-8">
            <!-- Teacher's Courses -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="mb-0">Courses by {{ $teacher->name }}</h5>
                </div>
                                 <div class="card-body">
                     @if($teacher->courses->count() > 0)
                        <div class="row">
                            @foreach($teacher->courses as $course)
                                <div class="col-md-6 mb-4">
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
                                            <h6 class="card-title">{{ $course->title }}</h6>
                                            <p class="card-text text-muted flex-grow-1">
                                                {{ Str::limit($course->description, 100) }}
                                            </p>
                                                                                         <div class="mt-auto">
                                                 <div class="d-flex justify-content-between align-items-center mb-2">
                                                     <span class="badge bg-primary">{{ $course->category->name }}</span>
                                                     <span class="fw-bold">${{ number_format($course->price, 2) }}</span>
                                                 </div>
                                                 <div class="d-flex justify-content-between align-items-center mb-2">
                                                     @if($course->status === 'published')
                                                         <span class="badge bg-success">Published</span>
                                                     @else
                                                         <span class="badge bg-warning">Draft</span>
                                                     @endif
                                                     <small class="text-muted">{{ $course->reviews->count() }} reviews</small>
                                                 </div>
                                                 <a href="{{ route('courses.show', $course->slug) }}" 
                                                    class="btn btn-primary btn-sm w-100">View Course</a>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                            <h5>No courses available</h5>
                            <p class="text-muted">This teacher hasn't published any courses yet.</p>
                        </div>
                    @endif
                </div>
            </div>

                         <!-- Teacher's Blog Posts -->
             @if($teacher->blogPosts->count() > 0)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Recent Blog Posts</h5>
                    </div>
                    <div class="card-body">
                        @foreach($teacher->blogPosts as $post)
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <small class="text-muted">{{ $post->created_at->format('M d, Y') }}</small>
                                    @if($post->status === 'published')
                                        <span class="badge bg-success ms-2">Published</span>
                                    @else
                                        <span class="badge bg-warning ms-2">Draft</span>
                                    @endif
                                </div>
                                <h6 class="mb-1">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
                                        {{ $post->title }}
                                    </a>
                                </h6>
                                <p class="text-muted small mb-0">
                                    {{ Str::limit(strip_tags($post->content), 150) }}
                                </p>
                            </div>
                        @endforeach
                        
                        @if($teacher->blogPosts->count() > 5)
                            <div class="text-center">
                                <a href="{{ route('blog.index') }}?teacher={{ $teacher->id }}" 
                                   class="btn btn-outline-primary btn-sm">
                                    View All Posts
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Teacher Reviews -->
            @if($teacher->courses->sum('reviews_count') > 0)
                <div class="card shadow">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Student Reviews</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $allReviews = collect();
                            foreach($teacher->courses as $course) {
                                $allReviews = $allReviews->merge($course->reviews);
                            }
                            $recentReviews = $allReviews->sortByDesc('created_at')->take(5);
                        @endphp
                        
                        @foreach($recentReviews as $review)
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
                                        <small class="text-muted">Review for: {{ $review->course->title }}</small>
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
</style>
@endsection
