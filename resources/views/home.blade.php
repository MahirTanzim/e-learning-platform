@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Learn Without Limits</h1>
                <p class="lead mb-4">
                    Discover thousands of courses from expert instructors. 
                    Start learning today and advance your career.
                </p>
                <div class="d-flex gap-3">
                    <a href="{{ route('courses.index') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-play me-2"></i>Start Learning
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-user-plus me-2"></i>Join Free
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/img1.png') }}" 
                     alt="E-Learning" class="img-fluid rounded">
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 col-6">
                <div class="mb-3">
                    <i class="fas fa-book fa-3x text-primary"></i>
                </div>
                <h3 class="fw-bold">1000+</h3>
                <p class="text-muted">Courses</p>
            </div>
            <div class="col-md-3 col-6">
                <div class="mb-3">
                    <i class="fas fa-users fa-3x text-primary"></i>
                </div>
                <h3 class="fw-bold">50K+</h3>
                <p class="text-muted">Students</p>
            </div>
            <div class="col-md-3 col-6">
                <div class="mb-3">
                    <i class="fas fa-chalkboard-teacher fa-3x text-primary"></i>
                </div>
                <h3 class="fw-bold">500+</h3>
                <p class="text-muted">Instructors</p>
            </div>
            <div class="col-md-3 col-6">
                <div class="mb-3">
                    <i class="fas fa-certificate fa-3x text-primary"></i>
                </div>
                <h3 class="fw-bold">10K+</h3>
                <p class="text-muted">Certificates</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Courses -->
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6">
                <h2 class="fw-bold">Featured Courses</h2>
                <p class="text-muted">Discover our most popular and highly-rated courses</p>
            </div>
            <div class="col-lg-6 text-lg-end">
                <a href="{{ route('courses.index') }}" class="btn btn-outline-primary">
                    View All Courses <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        
        <div class="row">
            @forelse($featuredCourses as $course)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card course-card h-100">
                        <img src="{{ $course->thumbnail_url }}" class="card-img-top" 
                             alt="{{ $course->title }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-primary mb-2 align-self-start">{{ $course->category->name }}</span>
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text text-muted flex-grow-1">
                                {{ Str::limit($course->description, 100) }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i>{{ $course->teacher->name }}
                                </small>
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>{{ $course->duration }} min
                                </small>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    @if($course->price > 0)
                                        <span class="h5 text-primary mb-0">${{ $course->price }}</span>
                                    @else
                                        <span class="h5 text-success mb-0">Free</span>
                                    @endif
                                </div>
                                <div>
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $course->average_rating)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                    <small class="text-muted ms-1">({{ $course->total_students }})</small>
                                </div>
                            </div>
                            <a href="{{ route('courses.show', $course->slug) }}" 
                               class="btn btn-primary mt-3">View Course</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-book fa-3x text-muted mb-3"></i>
                        <h4>No courses available</h4>
                        <p class="text-muted">Check back later for new courses!</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Categories -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Explore Categories</h2>
            <p class="text-muted">Choose from a wide range of learning categories</p>
        </div>
        
        <div class="row">
            @foreach($categories as $category)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card text-center h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <img src="{{ $category->image_url }}" alt="{{ $category->name }}" 
                                 class="mb-3" style="width: 60px; height: 60px; object-fit: cover;">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <p class="text-muted">{{ $category->courses_count }} courses</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Top Teachers -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Meet Our Top Instructors</h2>
            <p class="text-muted">Learn from industry experts and experienced professionals</p>
        </div>
        
        <div class="row">
            @foreach($topTeachers as $teacher)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-center border-0 shadow-sm">
                        <div class="card-body">
                            <img src="{{ $teacher->avatar_url }}" alt="{{ $teacher->name }}" 
                                 class="rounded-circle mb-3" style="width: 80px; height: 80px; object-fit: cover;">
                            <h5 class="card-title">{{ $teacher->name }}</h5>
                            <p class="text-muted mb-1">{{ $teacher->courses_count }} Courses</p>
                            @if($teacher->profile && $teacher->profile->specialization)
                                <p class="text-muted small">{{ $teacher->profile->specialization }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Recent Blog Posts -->
@if($recentBlogs->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6">
                <h2 class="fw-bold">Latest from Blog</h2>
                <p class="text-muted">Stay updated with the latest educational content and tips</p>
            </div>
            <div class="col-lg-6 text-lg-end">
                <a href="{{ route('blog.index') }}" class="btn btn-outline-primary">
                    View All Posts <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        
        <div class="row">
            @foreach($recentBlogs as $post)
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <img src="{{ $post->featured_image_url }}" class="card-img-top" 
                             alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ Str::limit($post->title, 60) }}</h5>
                            <p class="card-text text-muted">
                                {{ Str::limit(strip_tags($post->content), 100) }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i>{{ $post->teacher->name }}
                                </small>
                                <small class="text-muted">{{ $post->created_at->format('M d, Y') }}</small>
                            </div>
                            <a href="{{ route('blog.show', $post->slug) }}" 
                               class="btn btn-outline-primary btn-sm mt-3">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Ready to Start Learning?</h2>
        <p class="lead mb-4">Join millions of learners worldwide and advance your skills today</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                <i class="fas fa-rocket me-2"></i>Get Started Free
            </a>
            <a href="{{ route('courses.index') }}" class="btn btn-outline-light btn-lg">
                <i class="fas fa-search me-2"></i>Browse Courses
            </a>
        </div>
    </div>
</section>
@endsection